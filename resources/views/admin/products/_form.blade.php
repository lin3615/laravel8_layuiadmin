{{csrf_field()}}
<div class="layui-form-item">
    <label for="" class="layui-form-label">分类</label>
    <div class="layui-input-inline">
        <select name="category_id" lay-verify="required">
            @forelse ( $categories as $category )
            <option value="{{$category->id}}"
                    @if(isset($products->category_id) && $products->category_id == $category->id)
                        selected
                    @endif
                >
                {{ $category->name_cn }} | {{ $category->name }}</option>
            @empty
            @endforelse
        </select>
    </div>
</div>


<div class="layui-form-item">
    <label for="" class="layui-form-label">标题</label>
    <div class="layui-input-block">
        <input type="text" name="title" value="{{ $products->title ?? old('title') }}" lay-verify="required" placeholder="请输入标题" class="layui-input" >
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">关键词</label>
    <div class="layui-input-block">
        <input type="text" name="keywords" value="{{ $products->keywords ?? old('keywords') }}" lay-verify="required" placeholder="请输入关键词" class="layui-input" >
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">描述</label>
    <div class="layui-input-block">
        <textarea name="description" placeholder="请输入描述" class="layui-textarea">{{ $products->description ?? old('description') }}</textarea>
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">状态</label>
    <div class="layui-input-block">
        <input type="checkbox" name="flag" id = "flag" lay-skin="switch"
               {{ isset($products->flag) && $products->flag == 1 ? 'checked': '' }}
        lay-text="开启|关闭">
    </div>
</div>


<div class="layui-form-item">
    <label for="" class="layui-form-label">缩略图</label>
    <div class="layui-input-block">
        <div class="layui-upload">
            <button type="button" class="layui-btn" id="uploadPic"><i class="layui-icon">&#xe67c;</i>图片上传</button>
            <div class="layui-upload-list" >
                <ul id="layui-upload-box" class="layui-clear">
                    @if(isset($products->thumb))
                    <li><img src="/{{ $products->thumb }}" /><p>上传成功</p></li>
                    @endif
                </ul>
                <img class="layui-upload-img" id="upload-normal-img">
                <input type="hidden" name="thumb" id="thumb" value="{{ $products->thumb ?? '' }}">
            </div>
        </div>
    </div>
</div>

@include('vendor.ueditor.assets')
<div class="layui-form-item">
    <label for="" class="layui-form-label">内容</label>
    <div class="layui-input-block">
        <script id="container" name="content" type="text/plain">
        {!! $products->content ??old('content') !!}
        </script>
    </div>
</div>


<div class="layui-form-item">
    <div class="layui-input-block">
        <button type="submit" class="layui-btn" lay-submit="" lay-filter="formDemo">确 认</button>
        <a  class="layui-btn" href="{{route('admin.products')}}" >返 回</a>
    </div>
</div>
