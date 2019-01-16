@extends('admin.layouts.app')
@section('title', '属性列表')
@section('content')
    <div class="content">
        <div class="col-xs-12">
            <div class="box table-striped">
                <div class="box-header">
                    <a href="{{ url("attributeGroup/add") }}">
                        <button type="button" class="btn btn-sm btn-success btn-flat">添加属性组</button>
                    </a>
                    <a href="{{ url("attribute/add") }}">
                        <button type="button" class="btn btn-sm btn-success btn-flat">添加属性</button>
                    </a>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th style="width: 40px;">
                                <label>
                                    <input type="checkbox">
                                </label>
                            </th>
                            <th>名称</th>
                            <th>属性组</th>
                            <th style="width: 270px">操作</th>
                        </tr>
                        @foreach($attributes as $attribute)
                            <tr role="row">
                                <td>
                                    <label>
                                        <input type="checkbox">
                                    </label>
                                </td>
                                <td class="sorting_1">{{ $attribute->name }}</td>
                                <td class="sorting_1">{{ $attribute->attribute_group_id}}</td>
                                <td>
                                    {{--<div class="btn-group">--}}
                                    <button type="button" class="btn btn-info btn-flat">修改</button>
                                    {{--<button type="button" class="btn btn-warning  btn-flat">下架</button>--}}
                                    <button type="button" class="btn btn-danger  btn-flat">删除</button>
                                    {{--</div>--}}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
