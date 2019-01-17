@extends('admin.layouts.app')
@section('title', '规格管理')
@section('subtitle', '规格列表')
@section('content')
    <div class="content">
        {{--<div class="col-xs-12">--}}
        <div class="box table-primary">
            <div class="box-header with-border">
                <a href="{{ url("specification/add") }}">
                    <button type="button" class="btn btn-sm btn-success btn-flat">添加规格</button>
                </a>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <td>规格名称</td>
                        <td>可选值</td>
                        <th style="width: 270px">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($specifications as $specification)
                        <tr>
                            <td class="sorting_1">{{ $specification->name }}</td>
                            <td>

                            </td>
                            <td>
                                <button type="button" class="btn btn-success btn-flat">详情</button>
                                <button type="button" class="btn btn-info btn-flat">修改</button>
                                <button type="button" class="btn btn-warning  btn-flat">下架</button>
                                <button type="button" class="btn btn-danger  btn-flat">删除</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="box-footer">

            </div>
        </div>
    </div>
    {{--</div>--}}
@endsection
