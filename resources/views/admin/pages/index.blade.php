@extends('admin.layouts.app')
@section('title', '首页')
@section('subtitle', '首页')
@section('content')
    <div class="content">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">最新订单</h3>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                        <tr>
                            订单编号
                        </tr>
                        <tr>
                            状态
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="box-footer clearfix">
                <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">所有订单</a>
            </div>
        </div>
    </div>
@endsection
