{{csrf_field()}}

<div class="layui-form-item">
    <label for="" class="layui-form-label">英文名称</label>
    <div class="layui-input-inline">
        <input type="text" name="name" value="{{ $category->name ?? old('name') }}" lay-verify="required" placeholder="请输入英文名称" class="layui-input" >
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">中文名称</label>
    <div class="layui-input-inline">
        <input type="text" name="name_cn" value="{{ $category->name_cn ?? old('name_cn') }}" lay-verify="required" placeholder="请输入中文名称" class="layui-input" >
    </div>
</div>


<div class="layui-form-item">
    <label for="" class="layui-form-label">所属分类</label>
    <div class="layui-input-block">
        <select name="parent_id" lay-search>
            <option value="0">顶级类目</option>
            @forelse($categories as $row_category)
            <option value="{{$row_category->id}}"
                    @if(isset($category->parent_id) && $category->parent_id== $row_category->id) selected @endif>
                {{$row_category->name_cn}} - {{$row_category->name}}
            </option>
            @empty
            @endforelse
        </select>
    </div>
</div>



<div class="layui-form-item">
    <div class="layui-input-block">
        <button type="submit" class="layui-btn" lay-submit="" lay-filter="formDemo">确 认</button>
        <a  class="layui-btn" href="{{route('admin.category')}}" >返 回</a>
    </div>
</div>
