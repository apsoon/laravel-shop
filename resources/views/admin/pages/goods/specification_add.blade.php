@extends('admin.layouts.app')
@section('title', '规格管理')
@section('subtitle','添加规格')
@section('content')
    <div class="content">
        <div class="box box-primary">
            <form role="form" action="{{url("specification/create")}}" method="post">
                <div class="box-body">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label>规格名称<b class="text-red">*</b></label>
                        <input class="form-control" id="specification-name" name="name" placeholder="请输入名称">
                    </div>
                    <div class="form-group">
                        <label>选择分类<b class="text-red">*</b></label>
                        <label>
                            <select class="form-control select2" name="category_id">
                                <option value="0">未选择</option>
                                @foreach($categoryList as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </label>
                    </div>
                    <div class="box-footer">
                        <button type="submit" id="goods-submit" class="btn btn-primary">提交</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
