@extends('admin.base')

@section('content')
<div class="layui-card">

    <div class="layui-card-header layuiadmin-card-header-auto">
        <div class="layui-btn-group">
            @can('admin.products.destroy')
            <button class="layui-btn layui-btn-sm layui-btn-danger" id="listDelete">删 除</button>
            @endcan
            @can('admin.products.create')
            <a class="layui-btn layui-btn-sm" href="{{ route('admin.products.create') }}">添 加</a>
            @endcan
        </div>


        <div class="layui-form">
            <div class="layui-input-inline">
                <input type="text" name="title" id="title" placeholder="标题搜索" class="layui-input">
            </div>
            <div class="layui-input-inline">
                <input type="text" name="keywords" id="keywords" placeholder="关键词搜索" class="layui-input">
            </div>
            <div class="layui-input-inline">
                <input type="text" name="author" id="author" placeholder="添加人搜索" class="layui-input">
            </div>
            &nbsp;&nbsp;<button class="layui-btn layui-btn-sm" id="search">搜索</button>
        </div>
    </div>

    <div class="layui-card-body">
        <table id="dataTable" lay-filter="dataTable"></table>
        <script type="text/html" id="options">
            <div class="layui-btn-group">
                @can('admin.products.edit')
                <a class="layui-btn layui-btn-sm" lay-event="edit">编辑</a>
                @endcan
                @can('admin.products.destroy')
                <a class="layui-btn layui-btn-danger layui-btn-sm " lay-event="del">删除</a>
                @endcan
            </div>
        </script>
        <script type="text/html" id="thumb">
        <a href="/@{{d.thumb}}" title="点击查看" target="_blank"><img src="/@{{d.thumb}}" width="35" height="35" alt="" /></a>
        </script>


        <script type="text/html" id="flag">

            <input type="checkbox" name="flag" lay-skin="switch" lay-text="开启|关闭" lay-filter="switch-flag"
                   value="@{{ d.id }}" data-json="encodeURIComponent(JSON.stringify(d))" @{{ d.flag == 1 ? 'checked' : '' }}
            @if (!Auth::user()->can('admin.products.edit'))
                disabled
            @endif

        </script>

    </div>

</div>
@endsection

@section('script')

<script>
    layui.use(['layer','table','form'],function () {
        var layer = layui.layer;
        var form = layui.form;
        var table = layui.table;

        //用户表格初始化
        var dataTable = table.render({
            elem: '#dataTable'
            ,height: 700
            ,url: "{{ route('admin.products.data') }}" //数据接口
            ,page: true //开启分页
            ,cols: [[ //表头
                {checkbox: true,fixed: true}
                ,{field: 'id', title: 'ID', sort: true,width:80}
                ,{field: 'title', title: '标题'}
                ,{field: 'thumb', title: '缩略图',toolbar:'#thumb',width:80}
                ,{field: 'flag', title: '状态',toolbar:'#flag',width:100}
                ,{field: 'author', title: '添加人',width:80}
                ,{field: 'created_at', title: '创建时间',width:120}
                ,{fixed: 'right', width: 120, align:'center', toolbar: '#options'}
            ]]
        });

        /* 监听指定开关 */
        form.on('switch(switch-flag)', function(){
            var pid = this.value;
            if(this.checked) {
                var flag = 1;
            }else {
                var flag = 0;
            }
            var _token = $('meta[name="csrf-token"]').attr('content');
            layer.confirm('确认修改状态吗？', function(index){
                $.post("{{ route('admin.products.changeStatus') }}",{_method:'put',_token:_token,id:pid,flag:flag},function (result) {
                    layer.close(index);
                    layer.msg(result.msg,{icon:6})
                    // 修改失败
                    if(result.code === 1) {
                        window.location.href="";
                    }
                });
            });

        });

        //监听工具条
        table.on('tool(dataTable)', function(obj){ //注：tool是工具条事件名，dataTable是table原始容器的属性 lay-filter="对应的值"
            var data = obj.data //获得当前行数据
                ,layEvent = obj.event; //获得 lay-event 对应的值
            if(layEvent === 'del'){
                layer.confirm('确认删除吗？', function(index){
                    $.post("{{ route('admin.products.destroy') }}",{_method:'delete',ids:[data.id]},function (result) {
                        if (result.code==0){
                            obj.del(); //删除对应行（tr）的DOM结构
                        }
                        layer.close(index);
                        layer.msg(result.msg,{icon:6})
                    });
                });
            } else if(layEvent === 'edit'){
                location.href = '/admin/products/'+data.id+'/edit';
            }


        });

        //按钮批量删除
        $("#listDelete").click(function () {
            var ids = []
            var hasCheck = table.checkStatus('dataTable')
            var hasCheckData = hasCheck.data
            if (hasCheckData.length>0){
                $.each(hasCheckData,function (index,element) {
                    ids.push(element.id)
                })
            }
            if (ids.length>0){
                layer.confirm('确认删除吗？', function(index){
                    $.post("{{ route('admin.products.destroy') }}",{_method:'delete',ids:ids},function (result) {
                        if (result.code==0){
                            dataTable.reload()
                        }
                        layer.close(index);
                        layer.msg(result.msg,{icon:6})
                    });
                })
            }else {
                layer.msg('请选择删除项',{icon:5})
            }
        })

        // 搜索
        $("#search").click(function () {
            var title = $("#title").val();
            var author = $("#author").val();
            var keywords = $("#keywords").val();
            dataTable.reload({
                where:{title:title,author:author,keywords:keywords},
                page:{curr:1}
            })
        })
    })
</script>

@endsection

