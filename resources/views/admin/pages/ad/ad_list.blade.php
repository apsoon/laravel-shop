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
                <table>
                    <thead>
                    <tr>

                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="box-footer"></div>

    </div>
@endsection
