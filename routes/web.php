<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');
//
//require __DIR__.'/auth.php';

// 登陆使用
Route::group(['prefix' => 'admin'],function() {
    // 登陆页面
    Route::get('/login',[App\Http\Controllers\Admin\LoginController::class, 'showLoginForm'])
        ->name('admin.loginForm');

    // 登陆提交页面
    Route::post('/login',[App\Http\Controllers\Admin\LoginController::class, 'login'])->name('admin.login');

    // 退出登陆
    Route::get('/logout',[App\Http\Controllers\Admin\LoginController::class, 'logout'])->name('admin.logout');

});



// 后台布局
Route::group(['prefix' => 'admin','middleware'=>'auth'], function() {

    // 后台首页
    Route::get('/',[App\Http\Controllers\Admin\IndexController::class, 'layout'])->name('admin.layout');

    // layuiadmin原模板模块 - 控制台
    Route::get('/index',[App\Http\Controllers\Admin\IndexController::class, 'index'])->name('admin.index');

    // layuiadmin原模板模块 - 主页一
    Route::get('/index1',[App\Http\Controllers\Admin\IndexController::class, 'index1'])->name('admin.index1');

    // layuiadmin原模板模块 - 主页二
    Route::get('/index2',[App\Http\Controllers\Admin\IndexController::class, 'index2'])->name('admin.index2');

});

// 系统管理
Route::group(['prefix' => 'admin','middleware' => ['auth','permission:system.manage']],function() {

    Route::group(['middleware' => ['permission:admin.user']], function() {
        // 系统用户列表
        Route::get('/user',[App\Http\Controllers\Admin\UserController::class, 'index'])
            ->name('admin.user');
        //添加系统用户
        Route::get('/create',[App\Http\Controllers\Admin\UserController::class, 'create'])
            ->name('admin.user.create')->middleware('permission:admin.user.create');
        // 获取系统用户列表
        Route::get('/data',[App\Http\Controllers\Admin\UserController::class, 'data'])
            ->name('admin.data');
        //删除系统用户
        Route::delete('user/destroy',[App\Http\Controllers\Admin\UserController::class, 'destroy'])
            ->name('admin.user.destroy')->middleware('permission:admin.user.destroy');
        //保存用户
        Route::post('/store',[App\Http\Controllers\Admin\UserController::class, 'store'])
            ->name('admin.user.store')->middleware('permission:admin.user.create');
        //编辑用户
        Route::get('user/{id}/edit',[App\Http\Controllers\Admin\UserController::class, 'edit'])
            ->name('admin.user.edit')->middleware('permission:admin.user.edit');
        // 保存编辑用户
        Route::put('user/{id}/update',[App\Http\Controllers\Admin\UserController::class, 'update'])
            ->name('admin.user.update')->middleware('permission:admin.user.edit');
        // 给人员分配角色
        Route::get('user/{id}/role',[App\Http\Controllers\Admin\UserController::class, 'role'])
            ->name('admin.user.role')->middleware('permission:admin.user.assignRole');
        Route::put('user/{id}/assignRole',[App\Http\Controllers\Admin\UserController::class, 'assignRole'])
            ->name('admin.user.assignRole')->middleware('permission:admin.user.assignRole');
        // 给人员分配权限
        Route::get('user/{id}/permission',[App\Http\Controllers\Admin\UserController::class, 'permission'])
            ->name('admin.user.permission')->middleware('permission:admin.user.assignPermission');
        Route::put('user/{id}/assignPermission',[App\Http\Controllers\Admin\UserController::class, 'assignPermission'])
            ->name('admin.user.assignPermission')->middleware('permission:admin.user.assignPermission');
    });


});

// 角色管理
Route::group(['prefix' => 'admin','middleware'=>['auth','permission:system.manage']],function() {

    Route::group(['middleware' => ['permission:admin.role']],function() {
        // 展示角色列表
        Route::get('role',[App\Http\Controllers\Admin\RoleController::class,'index'])
            ->name('admin.role');
        // 获取角色数据
        Route::get('role/data',[App\Http\Controllers\Admin\RoleController::class,'data'])
            ->name('admin.role.data');
        // 添加角色
        Route::get('role/create',[App\Http\Controllers\Admin\RoleController::class,'create'])
            ->name('admin.role.create')->middleware('permission:admin.role.create');
        // 保存添加的角色
        Route::post('role/store',[App\Http\Controllers\Admin\RoleController::class,'store'])
            ->name('admin.role.store')->middleware('permission:admin.role.create');
        //编辑角色
        Route::get('role/{id}/edit',[App\Http\Controllers\Admin\RoleController::class,'edit'])
            ->name('admin.role.edit')->middleware('permission:admin.role.edit');
        // 保存编辑
        Route::put('role/{id}/update',[App\Http\Controllers\Admin\RoleController::class,'update'])
            ->name('admin.role.update')->middleware('permission:admin.role.edit');
        //删除角色
        Route::delete('role/destroy',[App\Http\Controllers\Admin\RoleController::class, 'destroy'])
            ->name('admin.role.destroy')->middleware('permission:admin.role.destroy');

        //修改角色的拥有的权限
        Route::get('role/{id}/permission',[App\Http\Controllers\Admin\RoleController::class,'permission'])
            ->name('admin.role.permission')->middleware('permission:admin.role.assignPermission');
        // 保存角色修改的权限
        Route::put('role/{id}/assignPermission',[App\Http\Controllers\Admin\RoleController::class,'assignPermission'])
            ->name('admin.role.assignPermission')->middleware('permission:admin.role.assignPermission');
    });

});

// 权限管理
Route::group(['prefix' => 'admin','middleware'=>['auth','permission:system.manage']],function() {
    Route::group(['middleware' => ['permission:admin.permission']],function() {
        // 权限展示
        Route::get('permission', [App\Http\Controllers\Admin\PermissionController::class, 'index'])
            ->name('admin.permission');
        // 获取权限数据
        Route::get('permission/data', [App\Http\Controllers\Admin\PermissionController::class, 'data'])
            ->name('admin.permission.data');
        //创建权限
        Route::get('permission/create', [App\Http\Controllers\Admin\PermissionController::class, 'create'])
            ->name('admin.permission.create')->middleware('permission:admin.permission.create');
        // 保存新创建的权限
        Route::post('permission/store', [App\Http\Controllers\Admin\PermissionController::class, 'store'])
            ->name('admin.permission.store')->middleware('permission:admin.permission.create');
        //编辑权限
        Route::get('permission/{id}/edit', [App\Http\Controllers\Admin\PermissionController::class, 'edit'])
            ->name('admin.permission.edit')->middleware('permission:admin.permission.edit');
        // 保存编辑的权限
        Route::put('permission/{id}/update', [App\Http\Controllers\Admin\PermissionController::class, 'update'])
            ->name('admin.permission.update')->middleware('permission:admin.permission.edit');
        // 删除权限
        Route::delete('permission/destroy', [App\Http\Controllers\Admin\PermissionController::class, 'destroy'])
            ->name('admin.permission.destroy')->middleware('permission:admin.permission.destroy');
    });
});


// 产品管理
Route::group(['prefix' => 'admin','middleware'=>['auth','permission:products.manage']],function() {
    // 产品列表管理
    Route::get('products/index',[App\Http\Controllers\Admin\ProductsController::class,'index'])
        ->name('admin.products')->middleware('permission:admin.products');
    // 获取产品列表数据
    Route::get('products/data', [App\Http\Controllers\Admin\ProductsController::class, 'data'])
        ->name('admin.products.data')->middleware('permission:admin.products');
    // 产品新增
    Route::get('products/create',[App\Http\Controllers\Admin\ProductsController::class,'create'])
        ->name('admin.products.create')->middleware('permission:admin.products.create');

    // 新增保存
    Route::post('products/store',[App\Http\Controllers\Admin\ProductsController::class,'store'])
        ->name('admin.products.store')->middleware('permission:admin.products.create');
    // 产品编辑
    Route::get('products/{id}/edit',[App\Http\Controllers\Admin\ProductsController::class,'edit'])
        ->name('admin.products.edit')->middleware('permission:admin.products.edit');
    // 产品编辑保存
    Route::put('products/{id}/update',[App\Http\Controllers\Admin\ProductsController::class,'update'])
        ->name('admin.products.update')->middleware('permission:admin.products.edit');
    // 产品删除
    Route::delete('products/destroy',[App\Http\Controllers\Admin\ProductsController::class,'destroy'])
        ->name('admin.products.destroy')->middleware('permission:admin.products.destroy');
    // 编辑产品状态
    Route::put('products/changeStatus',[App\Http\Controllers\Admin\ProductsController::class,'changeStatus'])
        ->name('admin.products.changeStatus')->middleware('permission:admin.products.edit');

    // 分类管理
    // 分类列表
    Route::get('category/index',[App\Http\Controllers\Admin\CategoryController::class,'index'])
        ->name('admin.category')->middleware('permission:admin.category');

    // 获取分类数据
    Route::get('category/data', [App\Http\Controllers\Admin\CategoryController::class, 'data'])
        ->name('admin.category.data')->middleware('permission:admin.category');
    // 分类新增
    Route::get('category/create',[App\Http\Controllers\Admin\CategoryController::class,'create'])
        ->name('admin.category.create')->middleware('permission:admin.category.create');
    // 新增分类保存
    Route::post('category/store',[App\Http\Controllers\Admin\CategoryController::class,'store'])
        ->name('admin.category.store')->middleware('permission:admin.category.create');
    // 分类编辑
    Route::get('category/{id}/edit',[App\Http\Controllers\Admin\CategoryController::class,'edit'])
        ->name('admin.category.edit')->middleware('permission:admin.category.edit');
    // 分类编辑保存
    Route::put('category/{id}/update',[App\Http\Controllers\Admin\CategoryController::class,'update'])
        ->name('admin.category.update')->middleware('permission:admin.category.edit');
    // 分类删除
    Route::delete('category/destroy',[App\Http\Controllers\Admin\CategoryController::class,'destroy'])
        ->name('admin.category.destroy')->middleware('permission:admin.category.destroy');
});


// 仓库管理
Route::group(['prefix' => 'admin','middleware'=>['auth','permission:warehouse.manage']],function() {
    // 仓库列表管理
    Route::get('warehouse/index',[App\Http\Controllers\Admin\WarehouseController::class,'index'])
        ->name('admin.warehouse')->middleware('permission:admin.warehouse');
    // 仓库库存管理
    Route::get('warehouse/stock',[App\Http\Controllers\Admin\warehouseController::class,'stock'])
        ->name('admin.warehouse.stock')->middleware('permission:admin.warehouse.stock');
});

// 订单管理
Route::group(['prefix' => 'admin','middleware'=>['auth','permission:orders.manage']],function() {
    // 订单列表管理
    Route::get('orders/index',[App\Http\Controllers\Admin\OrdersController::class,'index'])
        ->name('admin.orders')->middleware('permission:admin.orders');
    // 订单物流管理
    Route::get('logistic/index',[App\Http\Controllers\Admin\LogisticController::class,'index'])
        ->name('admin.logistic')->middleware('permission:admin.logistic');
});

// 采购管理
Route::group(['prefix' => 'admin','middleware'=>['auth','permission:purchase.manage']],function() {
    // 采购列表管理
    Route::get('purchase/index',[App\Http\Controllers\Admin\PurchaseController::class,'index'])
        ->name('admin.purchase')->middleware('permission:admin.purchase');
    // 供应商管理
    Route::get('purchase/suppliers',[App\Http\Controllers\Admin\PurchaseController::class,'suppliers'])
        ->name('admin.purchase.suppliers')->middleware('permission:admin.purchase.suppliers');
});
//文件上传接口
Route::post('uploadImg', [App\Http\Controllers\PublicController::class,'uploadImg'])->name('uploadImg');



