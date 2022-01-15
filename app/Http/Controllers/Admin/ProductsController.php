<?php

namespace App\Http\Controllers\Admin;
use App\Models\Products;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProductsController extends Controller
{

    public function index() {
        return view('admin.products.index');
    }

    public function data(Request $request) {
        $model = Products::query();
        if ($request->get('title')){
            $model = $model->where('title','like','%'.$request->get('title').'%');
        }
        if ($request->get('author')){
            $model = $model->where('author','like','%'.$request->get('author').'%');
        }
        if ($request->get('keywords')){
            $model = $model->where('keywords','like','%'.$request->get('keywords').'%');
        }
        $res = $model->orderBy('created_at','desc')->paginate($request->get('limit',100))->toArray();
        $data = [
            'code' => 0,
            'msg'   => '正在请求中...',
            'count' => $res['total'],
            'data'  => $res['data']
        ];
        return response()->json($data);
    }

    public function changeStatus(Request $request) {
        $data = $request->only(['id','flag']);
        $products = Products::findOrFail($data['id']);
        unset($data['id']);
        if ($products->update($data)){
            $data = [
                'code' => 0,
                'msg'   => '修改成功'
            ];
            return response()->json($data);
        }
        $data = [
            'code' => 1,
            'msg'   => '修改失败',
        ];
        return response()->json($data);
    }
    public function create() {
        $categories = $this->getCateList();
        return view('admin.products.create',compact('categories'));
    }

    public function store(Request $request) {
        $data = $request->only(['category_id','title','keywords','description','content','thumb','flag']);
        if(isset($data['flag']) && $data['flag'] == 'on') {
            $data['flag'] = 1;
        }else {
            $data['flag'] = 0;
        }

        $userInfo = Auth::user();
        $data['author'] = $userInfo->name;
        $product = Products::create($data);
        if ($product ){
            return redirect(route('admin.products'))->with(['status'=>'添加成功']);
        }
        return redirect(route('admin.products'))->withErrors(['status'=>'添加失败']);
    }

    public function edit($id) {
        $products = Products::findOrFail($id);
        $categories = $this->getCateList();
        return view('admin.products.edit',compact('products','categories'));
    }

    public function update(Request $request, $id) {
        $data = $request->only(['category_id','title','keywords','description','flag','thumb','content']);
        $products = Products::findOrFail($id);
        if(isset($data['flag']) && $data['flag'] == 'on') {
            $data['flag'] = 1;
        }else{
            $data['flag'] = 0;
        }
        if ($products->update($data)){
            return redirect()->to(route('admin.products'))->with(['status'=>'更新成功']);
        }
        return redirect()->to(route('admin.products'))->withErrors('系统错误');
    }

    public function destroy(Request $request) {
        $ids = $request->get('ids');

        if (empty($ids)){
            return response()->json(['code'=>1,'msg'=>'请选择删除项']);
        }
        if (Products::destroy($ids)){
            return response()->json(['code'=>0,'msg'=>'删除成功']);
        }
        return response()->json(['code'=>1,'msg'=>'删除失败']);
    }
}
