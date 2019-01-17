@extends('admin.layouts.app')
@section('title', '规格管理')
@section('subtitle', '规格列表')
@section('content')
    <div class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <a href="{{ url("specification/add") }}">
                    <button type="button" class="btn btn-sm btn-success btn-flat">添加规格</button>
                </a>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <td style="width: 150px">规格名称</td>
                        <td style="width: 150px">分类</td>
                        <td>可选项</td>
                        <th style="width: 270px">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($specifications as $specification)
                        <tr>
                            <td>{{ $specification->name }}</td>
                            <td>{{ $specification->category_id }}</td>
                            <td>
                            </td>
                            <td>
                                <button type="button" class="btn btn-success btn-flat">添加选项</button>
                                <button type="button" class="btn btn-info btn-flat">修改</button>
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
@endsection
