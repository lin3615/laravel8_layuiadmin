<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class PublicController extends Controller {

    public function uploadImg(Request $request) {
        $data = ['state'=>'fail', 'msg'=>'上传失败', 'url'=>'','title' => '','original','type' => '','size' => 0];
        if($request->hasFile('upfile') && $request->file('upfile')->isValid()) {
            $maxSize = 1024 * 1024;
            //支持的上传图片类型
            $allowed_extensions = ["png", "jpg", "gif","jpeg"];
            $file = $request->file('upfile');

            $ext = $file->extension();

            if (!in_array(strtolower($ext),$allowed_extensions)){
                $data['msg'] = "请上传".implode(",",$allowed_extensions)."格式的图片";
                $data['type'] = $ext;
                return response()->json($data);
            }
            // 检测大小
            $fileSize = $file->getSize();
            if($fileSize > $maxSize) {
                $data['msg'] = "图片大小限制1M，你的图片大小为 " . round($fileSize/$maxSize,2) . 'M';
                $data['size'] = round($fileSize/$maxSize,2);
                return response()->json($data);
            }
            $date_dir = date('Ymd',time());
            $image_path = 'public/images/' . $date_dir;
            $new_file_name = date('YmdHis') . date('YmdHis',time()). rand(1,9999999) . '.' . $ext;
            $store_result = $file->storeAs($image_path,$new_file_name);
            // 新建公共目录

            if($store_result){
                // 项目所在的根目录
                $root_dir = dirname(dirname(dirname(__DIR__)));
                // 图片存在的目录
                $pic_dir = $root_dir . '/public/images/' . $date_dir . '/';
                // 存放的相对路径
                $relative_path = 'images/' . $date_dir . '/' . $new_file_name;
                $this->checkAndCreateDir($pic_dir);
                $upload_file_ = $root_dir . '/storage/app/' . $image_path . '/' . $new_file_name;
                $copy_file = $pic_dir . $new_file_name;
                copy($upload_file_,$copy_file);
                $data['state'] = 'SUCCESS';
                $data['sing_url'] = $relative_path;
                $data['url'] = '/' . $relative_path;
                $data['msg'] = "上传成功";
                return response()->json($data);
            }
            return response()->json($data);
        }
        $data['msg'] = "未获取到上传文件或上传过程出错";
        return response()->json($data);

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
