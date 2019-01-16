@extends('admin.layouts.app')
@section('title', '添加属性')
@section('content')
    <div class="container">
        <div class="box box-primary">
            <div class="box-body">
                <form role="form" action="{{url("attributeGroup/create")}}" method="post">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label>属性组名称</label>
                        <input class="form-control" id="attribute-name" name="name" placeholder="请输入属性组名称">
                    </div>
                    <div class="box-footer">
                        <button type="submit" id="attribute-submit" class="btn btn-primary">提交</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
