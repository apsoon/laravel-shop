@extends('admin.layouts.app')
@section('title', '商品管理')
@section('subtitle','商品详情')
@section('content')
    <div class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">商品信息</h3>
            </div>
            <div class="box-body">
                <b>商品名称</b> {{$detail->name}}<br>
                <b>商品简述</b> {{$detail->brief}}<br>
                <b>品牌</b> {{$detail->brand_id}} <br>
                <b>分类</b> {{$detail->category_id}}<br>
                <!-- 产品列表 -->
                <div class="row">
                    <div class="col-sm-12 table-responsive">

                        <table class="table table-striped">
                            <thead>

                            </thead>
                            <tbody>
                            {{$detail}}
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- 商品描述 -->
                <div class="row">

                </div>
            </div>
            <div class="box-footer">

            </div>
        </div>
    </div>
@endsection
