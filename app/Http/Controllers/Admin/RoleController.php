<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleController extends Controller {

    /**
     * 显示角色列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index() {
        return view('admin.role.index');
    }

    /**
     * 获取角色内容
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(Request $request) {
        $sql = "select * from roles";
        $sqlCount = "select count(*) as total from roles";
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
        $listResult= DB::select($sql);
        $totalCount= DB::selectOne($sqlCount);
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
     * 添加创建新角色
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create() {
        return view('admin.role.create');
    }

    /**
     * 添加角色
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) {
        $name = $request->input('name');
        $data = ['name' => $name];
        if(Role::create($data)){
            return redirect()->to(route('admin.role'))->with(['status' => '添加角色成功']);
        }else{
            return redirect()->to(route('admin.role'))->withErrors(['status' => '系统错误']);
        }
    }

    /**
     * 编辑角色
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id) {
        $role = Role::findOrFail($id);
        return view('admin.role.edit',compact('role'));
    }

    /**
     * 更新角色
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $data = ['name' => $request->input('name')];

        if ($role->update($data)){
            return redirect()->to(route('admin.role'))->with(['status'=>'更新角色成功']);
        }
        return redirect()->to(route('admin.role'))->withErrors('系统错误');
    }

    /**
     * 删除用户
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request) {
        $ids = $request->get('ids');

        if (empty($ids)){
            return response()->json(['code'=>1,'msg'=>'请选择删除项']);
        }
        if (Role::destroy($ids)){
            return response()->json(['code'=>0,'msg'=>'删除成功']);
        }
        return response()->json(['code'=>1,'msg'=>'删除失败']);
    }

    /**
     * 编辑角色的权限
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function permission(Request $request, $id) {
        $role = Role::findOrFail($id);
        $permissions = $this->tree();

        foreach ($permissions as $key1 => $item1){
            $permissions[$key1]['own'] = $role->hasPermissionTo($item1['id']) ? 'checked' : false ;
            if (isset($item1['_child'])){
                foreach ($item1['_child'] as $key2 => $item2){
                    $permissions[$key1]['_child'][$key2]['own'] = $role->hasPermissionTo($item2['id']) ? 'checked' : false ;
                    if (isset($item2['_child'])){
                        foreach ($item2['_child'] as $key3 => $item3){
                            $permissions[$key1]['_child'][$key2]['_child'][$key3]['own'] = $role->hasPermissionTo($item3['id']) ? 'checked' : false ;
                        }
                    }
                }
            }

        }

        return view('admin.role.permission',compact('role','permissions'));
    }

    /**
     * 更新角色的权限
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function assignPermission(Request $request, $id) {
        $role = Role::findOrFail($id);
        $permissions = $request->get('permissions');
        if(empty($permissions)) {
            $role->permissions()->detach();
            return redirect()->to(route('admin.role'))->with(['status'=>'已更新角色权限1']);
        }else{
            $role->syncPermissions($permissions);
            return redirect()->to(route('admin.role'))->with(['status'=>'已更新角色权限2']);
        }
    }
}
