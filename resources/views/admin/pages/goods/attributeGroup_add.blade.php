@extends('admin.layouts.app')
@section('title', '属性管理')
@section('subtitle', '添加属性组')
@section('content')
    <div class="content">
        <div class="box box-primary">
            <form role="form" action="{{url("attributeGroup/create")}}" method="post">
                <div class="box-header with-border">
                    <h3 class="box-title">属性组表单</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                        </button>
                        {{--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>--}}
                        {{--</button>--}}
                    </div>
                </div>
                <div class="box-body">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label>属性组名称</label>
                        <input class="form-control" id="attribute-name" name="name" placeholder="请输入属性组名称">
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label>选择分类</label>
                            <label>
                                <select class="form-control select2" name="category_id">
                                    <option value="0">未选择</option>
                                    @foreach($categoryList as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </label>
                            {{--<p class="help-block text-sm">默认为一级分类</p>--}}
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" id="attribute-submit" class="btn btn-primary">提交</button>
                </div>
            </form>
        </div>
    </div>
@endsection
