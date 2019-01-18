@extends('admin.layouts.app')
@section('title', '品牌管理')
@section('subtitle','品牌列表')
@section('content')
    <div class="col-xs-12">
        <div class="box table-primary">
            <div class="box-header">
                <a href="{{ url("brand/add") }}">
                    <button type="button" class="btn btn-sm btn-success btn-flat">添加品牌</button>
                </a>
                <button type="button" class="btn btn-sm btn-danger  btn-flat">批量删除</button>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th style="width: 40px;">
                            <label>
                                <input type="checkbox">
                            </label>
                        </th>
                        <th>编号</th>
                        <th>品牌LOGO</th>
                        <th>名称</th>
                        <th>地区</th>
                        <th>状态</th>
                        <th style="width: 270px">操作</th>
                    </tr>
                    @foreach($brands as $brand)
                        <tr role="row">
                            <td>
                                <label>
                                    <input type="checkbox">
                                </label>
                            </td>
                            <td>{{ $brand->id}}</td>
                            <td>{{ $brand->logo }}</td>
                            <td>{{ $brand->name }}</td>
                            <td>{{ $brand->region }}</td>
                            <td>{{ $brand->state }}</td>
                            <td>
                                <button type="button" class="btn btn-success btn-flat">详情</button>
                                <button type="button" class="btn btn-info btn-flat">修改</button>
                                <button type="button" class="btn btn-warning  btn-flat">下架</button>
                                <button type="button" class="btn btn-danger  btn-flat">删除</button>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <!-- page -->
            {{--<div class="box-footer clearfix">--}}
            {{--<ul class="pagination pagination-sm no-margin pull-right">--}}
            {{--<li><a href="#">&laquo;</a></li>--}}
            {{--<li><a href="#">1</a></li>--}}
            {{--<li><a href="#">2</a></li>--}}
            {{--<li><a href="#">3</a></li>--}}
            {{--<li><a href="#">&raquo;</a></li>--}}
            {{--</ul>--}}
            {{--</div>--}}
        </div>
    </div>
@endsection
