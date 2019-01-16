@extends('admin.layouts.app')
@section('title', '首页')
@section('subtitle', '首页')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-8">


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
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">最新商品</h3>
                    </div>
                    <div class="box-body">
                        <ul class="products-list product-list-in-box">
                            <li class="item">
                                <div class="product-img">
                                    <img src="" alt="">
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-title">ProductA
                                        <span class="label label-warning pull-right">111</span>
                                    </a>
                                    <span class="product-description">Samsung 32" 1080p 60Hz LED Smart HDTV.</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="box-footer text-center">
                        <a href="#" class="uppercase">查看所有商品</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
