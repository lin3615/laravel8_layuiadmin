@extends('admin.base')

@section('content')
<div class="layui-card">
    <div class="layui-card-header layuiadmin-card-header-auto">
        <div class="layui-btn-group">
            @can('admin.role.create')
            <a class="layui-btn layui-btn-sm" href="{{ route('admin.role.create') }}">添 加</a>
            @endcan
        </div>
    </div>
    <div class="layui-card-body">
        <table id="dataTable" lay-filter="dataTable"></table>
        <script type="text/html" id="options">
            <div class="layui-btn-group">
                @can('admin.role.edit')
                <a class="layui-btn layui-btn-sm" lay-event="edit">编辑</a>
                @endcan
                @can('admin.role.assignPermission')
                <a class="layui-btn layui-btn-sm" lay-event="permission">权限</a>
                @endcan
                @can('admin.role.destroy')
                <a class="layui-btn layui-btn-danger layui-btn-sm" lay-event="del">删除</a>
                @endcan
            </div>
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
            ,height: 600
            ,url: "{{ route('admin.role.data') }}" //数据接口
            ,page: true //开启分页
            ,cols: [[ //表头
                {checkbox: true,fixed: true}
                ,{field: 'id', title: 'ID', sort: true,width:80}
                ,{field: 'name', title: '角色名称'}
                ,{field: 'created_at', title: '创建时间'}
                ,{field: 'updated_at', title: '更新时间'}
                ,{fixed: 'right', width: 260, align:'center', toolbar: '#options'}
            ]]
        });

        //监听工具条
        table.on('tool(dataTable)', function(obj){ //注：tool是工具条事件名，dataTable是table原始容器的属性 lay-filter="对应的值"
            var data = obj.data //获得当前行数据
                ,layEvent = obj.event; //获得 lay-event 对应的值
            if(layEvent === 'del'){
                layer.confirm('确认删除吗？', function(index){
                    $.post("{{ route('admin.role.destroy') }}",{_method:'delete',ids:[data.id]},function (result) {
                        if (result.code==0){
                            obj.del(); //删除对应行（tr）的DOM结构
                        }
                        layer.close(index);
                        layer.msg(result.msg,{icon:6})
                    });
                });
            } else if(layEvent === 'edit'){
                location.href = '/admin/role/'+data.id+'/edit';
            } else if (layEvent === 'permission'){
                location.href = '/admin/role/'+data.id+'/permission';
            }
        });


    })
</script>
@endsection
