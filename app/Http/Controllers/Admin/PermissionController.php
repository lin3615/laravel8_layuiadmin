<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    /**
     * 展示权限列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('admin.permission.index');
    }

    /**
     * 获取列表数据
     * @param Request $request
     */
    public function data(Request $request) {

        $parent_id = $request->get('parent_id',0);
        if(intval($parent_id) < 0) {
            $parent_id = 0;
        }else{
            $parent_id = intval($parent_id);
        }
        $sql = "select * from permissions where parent_id = :parent_id ";
        $sqlCount = "select count(*) as total from permissions where parent_id = :parent_id ";
        $whereField = ['parent_id' => $parent_id];

        $page = 1;
        $pagesize = 10;
        if($request->get('page')){
            $page = intval($request->get('page'));
            if($page < 1){
                $page = 1;
            }
        }

        if($request->get('limit')){
            $pagesize = $request->get('limit');
            if($pagesize < 1) {
                $pagesize = 10;
            }
        }
        $start_num = ($page - 1) * $pagesize;
        $sql .= " limit {$start_num},{$pagesize}";
        if($whereField) {
            $listResult= DB::select($sql,$whereField);
            $totalCount = DB::selectOne($sqlCount,$whereField);
        }else{
            $listResult= DB::select($sql);
            $totalCount = DB::selectOne($sqlCount);
        }


        $listData = [];
        foreach ($listResult as $data_row) {
            $listData[] = $data_row;
        }
        $data = [
            'code' => 0,
            'msg' => '正在请求中...',
            'count' => $totalCount->total,
            'data' => $listData
        ];
        return response()->json($data);
    }

    /**
     * 添加权限功能
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create() {
        $permissions = $this->tree();
        return view('admin.permission.create',compact('permissions'));
    }

    /**
     * 处理新增加的权限功能
     * @param PermissionCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) {
        $name = $request->input('name');
        $display_name = $request->input('display_name');
        $parent_id = $request->input('parent_id');
        $data = ['name' => $name,'display_name' => $display_name,
            'parent_id' => $parent_id];
        if(Permission::create($data)){
            return redirect()->to(route('admin.permission'))->with(['status' => '添加权限成功']);
        }else{
            return redirect()->to(route('admin.permission'))->withErrors(['status' => '系统错误']);
        }
    }

    /**
     * 编辑权限
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id) {
        $permission = Permission::findOrFail($id);
        $permissions = $this->tree();
        return view('admin.permission.edit',compact('permissions','permission'));
    }

    /**
     * 保存权限修改
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);
        $data = [];
        $name = $request->get('name');
        $display_name = $request->get('display_name');
        $parent_id = $request->get('parent_id');
        $data['name'] = $name;
        $data['display_name'] = $display_name;
        $data['parent_id'] = $parent_id;
        if ($permission->update($data)){
            return redirect()->to(route('admin.permission'))->with(['status'=>'更新成功']);
        }
        return redirect()->to(route('admin.permission'))->withErrors('系统错误');
    }

    /**
     * 删除对应的权限
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request) {
        $ids = $request->get('ids');

        if (empty($ids)){
            return response()->json(['code'=>1,'msg'=>'请选择删除项']);
        }
        if (Permission::destroy($ids)){
            return response()->json(['code'=>0,'msg'=>'删除成功']);
        }
        return response()->json(['code'=>1,'msg'=>'删除失败']);
    }

    public function permission(Request $request, $id) {

    }
    public function assignPermission(Request $request, $id) {

    }
}
