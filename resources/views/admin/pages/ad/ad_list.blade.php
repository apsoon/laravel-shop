@extends('admin.layouts.app')
@section('title', '广告管理')
@section('subtitle', '广告列表')
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <a href="{{ url("ad/add") }}">
                <button type="button" class="btn btn-sm btn-info btn-flat">添加广告</button>
            </a>
        </div>
        <div class="box-body no-padding table-responsive">
            <div class="table table-hover">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th style="width: 150px;">名称</th>
                        <th>描述</th>
                        <th style="width: 150px;">状态</th>
                        <th style="width: 270px;">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($adList as $ad)
                        <tr>
                            <td>{{$ad->name}}</td>
                            <td>{{$ad->content}}</td>
                            <td>{{$ad->state}}</td>
                            <td>
                                <button type="button" class="btn btn-info btn-flat">修改</button>
                                @if($ad->state==0)
                                    <button type="button" class="btn btn-success btn-flat">启用</button>
                                @else
                                    <button type="button" class="btn btn-warning  btn-flat">禁用</button>
                                @endif
                                <button type="button" class="btn btn-danger  btn-flat">删除</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="box-footer"></div>

    </div>
@endsection
