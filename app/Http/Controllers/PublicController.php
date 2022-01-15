<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PublicController extends Controller {
    public function uploadImg(Request $request) {
        $data = ['state'=>'fail', 'msg'=>'上传失败', 'url'=>'','title' => '','original','type' => '','size' => 0];
        if ($request->hasFile('upfile')) {
            $picture = $request->file('upfile');
            if (!$picture->isValid()) {
                $data['msg'] = '无效的上传文件';
                return response()->json($data);
            }
            // 文件扩展名
            $ext = $picture->extension();
            //支持的上传图片类型
            $allowed_extensions = ["png", "jpg", "gif","jpeg"];
            if (!in_array(strtolower($ext),$allowed_extensions)){
                $data['msg'] = "请上传".implode(",",$allowed_extensions)."格式的图片";
                $data['type'] = $ext;
                return response()->json($data);
            }
            // 生成新的统一格式的文件名
            $newFileName = date('YmdHis',time()) . mt_rand(1, 9999999) . '.' . $ext;

            // 日期目录
            $date_dir = date('Ymd',time());
            // 保存目录
            $storePublicDir = 'images/' . $date_dir;
            // 图片保存路径
            $savePath = 'images/' . $date_dir . '/' . $newFileName;
            // Web 访问路径
            $webPath = '/storage/' . $savePath;
            // 将文件保存到本地 storage/app/public/images 目录下，先判断同名文件是否已经存在
            if (Storage::disk('public')->has($savePath)) {
                $data['msg'] = '网络异常,上传失败，请重试!';
                return response()->json($data);
            }
            // 否则执行保存操作，保存成功将访问路径返回给调用方
            if ($picture->storePubliclyAs($storePublicDir, $newFileName, ['disk' => 'public'])) {
                $data['state'] = 'SUCCESS';
                $data['sing_url'] = substr($webPath,1);
                $data['url'] = $webPath;
                $data['msg'] = "上传成功";
                return response()->json($data);
            }
            $data['msg'] = '文件上传失败';
            return response()->json($data);
        } else {
            $data['msg'] = '请选择要上传的文件';
            return response()->json($data);
        }

    }

    /**
     * 检测指定的目录是否存在，不存在，则创建
     * @param string $dir_path
     * @param string $root_dir
     * @return bool
     */
    private function checkAndCreateDir($dir_path = '') {
        if($dir_path) {
            if(!is_dir($dir_path)) {
                return mkdir ($dir_path,0777,true);
            }else {
                return true;
            }
        }
    }
}
