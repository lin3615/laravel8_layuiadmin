<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller {

    use AuthenticatesUsers;
    /**
     * 登陆页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showLoginForm() {
        return view('admin.login_register.login');
    }

    /**
     * 设置登陆成功后的跳转页
     * @return string
     */
    public function redirectTo(){
        return route('admin.layout');
    }

    /**
     * 设置登陆字段
     * @return string
     */
    public function username()
    {
        return 'name';
    }

    /**
     * 登陆退出
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(Request $request) {
        $this->guard()->logout();
        $request->session()->invalidate();
        return redirect(route('admin.loginForm'));
    }
}
