@extends('admin.layouts.app')
@section('title', '商品管理')
@section('subtitle','添加产品')
@section('content')
    <div class="box box-primary">
        <form role="form" action="{{url("product/create")}}" method="post">
            <div class="box-header with-border">
                <h3 class="box-title">产品表单</h3>
            </div>
            <div class="box-body">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label>产品名称<b class="text-red">*</b></label>
                    <input class="form-control" id="product-name" name="name" placeholder="请输入产品名称">
                </div>
                <div class="row">
                    <div class="form-group col-md-3">
                        <label>产品原价</label>
                        <input class="form-control" type="number" id="product-origin-price" name="originPrice"
                               placeholder="请输入产品原价">
                    </div>
                    <div class="form-group col-md-3">
                        <label>产品现价<b class="text-red">*</b></label>
                        <input class="form-control" type="number" id="product-price" name="price"
                               placeholder="请输入产品现价">
                    </div>
                    <div class="form-group col-md-3">
                        <label>产品数量<b class="text-red">*</b></label>
                        <input class="form-control" type="number" id="product-id" name="number"
                               placeholder="请输入产品数量">
                    </div>
                </div>
                <div>

                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="col-xs-1">是否上架</label>
                        <label class="col-md-1">
                            <input type="radio" name="state" id="product-state-on" value="0"
                                   checked><label style="margin-left: 10px;">暂不上架</label></label>
                        <label class="col-md-1">
                            <input style="margin-left: 10px;" type="radio" name="state" id="product-state-off"
                                   value="1"><label style="margin-left: 10px;">立即上架</label>
                        </label>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" id="product-submit" class="btn btn-primary">提交</button>
            </div>
        </form>
    </div>
@endsection
