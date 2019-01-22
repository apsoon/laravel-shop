@extends('admin.layouts.app')
@section('title', '广告管理')
@section('subtitle', '广告位置列表')
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">

        </div>
        <div class="box-body table-responsive no-padding">
            <div class="table-responsive table-hover">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th style="width: 150px;">关键字</th>
                        <th style="width: 250px;">名称</th>
                        <th>描述</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($positionList as $position)
                        <tr>
                            <td>{{$position->key}}</td>
                            <td>{{$position->name}}</td>
                            <td>{{$position->content}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="box-footer"></div>

    </div>
@endsection
