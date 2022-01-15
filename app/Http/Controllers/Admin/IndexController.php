<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller {
    public function layout() {
        $userInfo = Auth::user();
        $user['id'] = $userInfo->id;
        $user['name'] = $userInfo->name;
         return view('admin.layout',compact('user'));
    }

    public function index() {
        return view('admin.index.index');
    }

    public function index1() {
        return view('admin.index.index1');
    }

    public function index2() {
        return view('admin.index.index2');
    }
}
