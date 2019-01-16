@extends('admin.layouts.app')
@section('title', '分类管理')
@section('subtitle', '添加分类')
@section('content')
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <form role="form" action="{{url("category/create")}}" method="post">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label>分类名称<b class="text-red">*</b></label>
                        <input class="form-control" id="category-name" name="name" placeholder="请输入分类名称">
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label>选择上级分类</label>
                            <label>
                                <select class="form-control select2" name="parent_id">
                                    <option value="0">未选择</option>
                                    @foreach($categoryList as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </label>
                            <p class="help-block text-sm">默认为一级分类</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>添加图片</label>
                        <input type="file" id="category-image" accept="image/gif, image/png, image/jpeg, image/jpg"
                               name="image_url">
                        <p class="help-block text-sm">图片大小120px*60px 小于5M</p>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label>排序优先级</label>
                            <label>
                                <input class="form-control" id="category-name" name="sort_order" type="number"
                                       placeholder="请输入优先级">
                            </label>
                            <p class="help-block text-sm">数字越小优先级越高</p>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" id="category-submit" class="btn btn-primary">提交</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
