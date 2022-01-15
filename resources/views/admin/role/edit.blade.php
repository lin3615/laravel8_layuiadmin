@extends('admin.base')

@section('content')
<div class="layui-card">
    <div class="layui-card-header layuiadmin-card-header-auto">
        <h2>更新角色</h2>
    </div>
    <div class="layui-card-body">
        <form class="layui-form" action="{{route('admin.role.update',['id'=>$role->id])}}" method="post">
            <input type="hidden" name="id" value="{{$role->id}}">
            {{method_field('put')}}
            @include('admin.role._form')
        </form>
    </div>
</div>
@endsection


