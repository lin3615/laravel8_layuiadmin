<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CategoryController extends Controller
{
    public function index() {
        return view('admin.category.index');
    }

    /**
     * 获取对应的分类数据
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(Request $request) {
        $model = Category::query();
        if ($request->get('name')){
            $model = $model->where('name','like','%'.$request->get('name').'%');
        }
        if ($request->get('name_cn')){
            $model = $model->where('phone','like','%'.$request->get('phone').'%');
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

    /**
     * 添加新类目
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create() {
        $categories = $this->getCateList();
        return view('admin.category.create',compact('categories'));
    }

    public function store(Request $request) {
        $data_input = $request->all();
        $name = $data_input['name'];
        $name_cn = $data_input['name_cn'];
        $parent_id = $data_input['parent_id'];
        $userInfo = Auth::user();
        $request->validate([
            'name' => 'required|max:50',
            'name_cn' => 'required|max:255',
        ]);

        $data = ['name' => $name,
                'author' => $userInfo->name,
                'name_cn' => $name_cn,
                'parent_id' => $parent_id,
            ];
        if(Category::create($data)) {
            return redirect()->to(route('admin.category'))->with(['status' => '添加分类成功']);
        }
        return redirect()->to(route('admin.category'))->withErrors(['status' => '系统错误']);
    }

    public function edit($id) {
        $category = Category::findOrFail($id);
        $categories = $this->getCateList();
        return view('admin.category.edit',compact('category','categories'));
    }

    public function update(Request $request, $id) {
        $data = $request->only(['name','name_cn','parent_id']);
        $category = Category::findOrFail($id);

        if ($category->update($data)){
            return redirect()->to(route('admin.category'))->with(['status'=>'更新成功']);
        }
        return redirect()->to(route('admin.category'))->withErrors('系统错误');
    }

    public function destroy(Request $request) {
        $ids = $request->get('ids');

        if (empty($ids)){
            return response()->json(['code'=>1,'msg'=>'请选择删除项']);
        }
        if (Category::destroy($ids)){
            return response()->json(['code'=>0,'msg'=>'删除成功']);
        }
        return response()->json(['code'=>1,'msg'=>'删除失败']);
    }
}
