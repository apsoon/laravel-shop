@extends('admin.layouts.app')
@section('title', '商品管理')
@section('subtitle','添加商品')
@section('content')
    <div class="container">
        <div class="box box-primary">
            <div class="box-body">
                <form role="form" action="{{url("goods/create")}}" method="post">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label>商品名称<b class="text-red">*</b></label>
                        <input class="form-control" id="goods-name" name="name" placeholder="请输入商品名称">
                    </div>
                    <div class="form-group">
                        <label>简要描述</label>
                        <input class="form-control" id="goods-brief" name="brief" placeholder="请输入简要描述">
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label>商品原价</label>
                            <input class="form-control" type="number" id="goods-origin-price" name="originPrice"
                                   placeholder="请输入商品编号">
                        </div>
                        <div class="form-group col-md-3">
                            <label>商品现价<b class="text-red">*</b></label>
                            <input class="form-control" type="number" id="goods-price" name="price"
                                   placeholder="请输入商品现价">
                        </div>
                        <div class="form-group  col-md-3">
                            <label>商品数量<b class="text-red">*</b></label>
                            <input class="form-control" type="number" id="goods-id" name="number" placeholder="请输入商品数量">
                        </div>
                        <div class="form-group  col-md-3">
                            <label>数量单位<b class="text-red">*</b></label>
                            <input class="form-control" id="goods-unit" name="unit" placeholder="请输入数量单位">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>选择分类<b class="text-red">*</b></label>
                        <select></select>
                    </div>
                    <div class="form-group">
                        <label>选择品牌<b class="text-red">*</b></label>
                        <select></select>
                    </div>
                    <div class="form-group">
                        <label>添加图片<b class="text-red">*</b></label>
                        <input type="file" id="logo" accept="image/gif, image/png, image/jpeg, image/jpg" name="cover">
                        <p class="help-block">图片大小120px*60px 小于5M</p>
                    </div>
                    <div class="form-group">
                        <label>商品描述<b class="text-red">*</b></label>
                        <div id="editor">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>商品状态</label>
                        <label class="col-md-1">
                            <input type="radio" name="state" id="goods-state-on" value="1" checked>开启
                        </label>
                        <label class="col-md-1">
                            <input type="radio" name="state" id="goods-state-off" value="0">关闭
                        </label>
                    </div>
                    <div class="box-footer">
                        <button type="submit" id="goods-submit" class="btn btn-primary">提交</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript"
            src="{{ asset("lib/wangEditor/wangEditor.min.js") }}"></script>
    <script type="text/javascript">
        var E = window.wangEditor
        var editor = new E('#editor')
        // 或者 var editor = new E( document.getElementById('editor') )
        editor.create()
    </script>
@endsection
