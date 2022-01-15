<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index() {
        return view('admin.user.index');
    }

    /**
     * 获取用户列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(Request $request) {
        $sql = "select * from users where 1";
        $sqlCount = "select count(*) as total from users where 1";
        $whereField = [];
        if($request->get('name')){
            $sql .= " and name = :name";
            $sqlCount .= " and name = :name";
            $whereField['name'] = $request->get('name');
        }
        if($request->get('email')){
            $sql .= " and email = :email";
            $sqlCount .= " and email = :email";
            $whereField['email'] = $request->get('email');
        }
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
     * 添加新用户
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create() {
        return view('admin.user.create');
    }

    /**
     * 保存新增用户
     */
    public function store(Request $request) {
        $data_input = $request->all();

        $name = $data_input['name'];
        $password = bcrypt($data_input['password']);
        $email = $data_input['email'];
        $data = ['name' => $name,'password' => $password,'email' => $email];

        if(User::create($data)) {
            return redirect()->to(route('admin.user'))->with(['status' => '添加用户成功']);
        }
        return redirect()->to(route('admin.user'))->withErrors(['status' => '系统错误']);
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
        if (User::destroy($ids)){
            return response()->json(['code'=>0,'msg'=>'删除成功']);
        }
        return response()->json(['code'=>1,'msg'=>'删除失败']);

    }

    /**
     * 显示编辑用户
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id) {
        $user = User::findOrFail($id);
        return view('admin.user.edit',compact('user'));
    }

    /**
     * 保存编辑的用户
     * @param UserUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);

        $data = $request->except('password');
        if ($request->get('password')){
            $data['password'] = bcrypt($request->get('password'));
        }
        if ($user->update($data)){
            return redirect()->to(route('admin.user'))->with(['status'=>'更新用户成功']);
        }
        return redirect()->to(route('admin.user'))->withErrors('系统错误');
    }

    /**
     * 获取用户的角色
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function role(Request $request, $id) {
        $user = User::findOrFail($id);
        $roles = Role::get();
        foreach ($roles as $role) {
            $role->own = $user->hasRole($role) ? true : false;
        }
        return view('admin.user.role',compact('roles','user'));
    }

    /**
     * 处理编辑用户后的角色
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function assignRole(Request $request, $id) {
        $user = User::findOrFail($id);
        $roles = $request->get('roles',[]);
        if($user->syncRoles($roles)) {
            return redirect()->to(route('admin.user'))->with(['status'=>'更新用户角色成功']);
        }
        return redirect()->to(route('admin.user'))->withErrors(['status'=>'系统错误']);

    }

    /**
     * 获取用户拥有的权限
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function permission(Request $request, $id) {
        $user = User::findOrFail($id);
        $permissions = $this->tree();
        foreach ($permissions as $key1 => $item1){
            $permissions[$key1]['own'] = $user->hasDirectPermission($item1['id']) ? 'checked' : false ;
            if (isset($item1['_child'])){
                foreach ($item1['_child'] as $key2 => $item2){
                    $permissions[$key1]['_child'][$key2]['own'] = $user->hasDirectPermission($item2['id']) ? 'checked' : false ;
                    if (isset($item2['_child'])){
                        foreach ($item2['_child'] as $key3 => $item3){
                            $permissions[$key1]['_child'][$key2]['_child'][$key3]['own'] = $user->hasDirectPermission($item3['id']) ? 'checked' : false ;
                        }
                    }
                }
            }
        }
        return view('admin.user.permission',compact('user','permissions'));
    }

    /**
     * 处理编辑用户的权限
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function assignPermission(Request $request, $id) {
        $user = User::findOrFail($id);
        $permissions = $request->get('permissions');

        if (empty($permissions)){
            $user->permissions()->detach();
            return redirect()->to(route('admin.user'))->with(['status'=>'已更新用户直接权限']);
        }
        $user->syncPermissions($permissions);
        return redirect()->to(route('admin.user'))->with(['status'=>'已更新用户直接权限']);
    }


}
