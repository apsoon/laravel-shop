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
                        <label>商品名称</label>
                        <input class="form-control" id="goods-name" name="name" placeholder="请输入商品名称">
                    </div>
                    <div class="form-group">
                        <label>简要描述</label>
                        <input class="form-control" id="goods-id" name="id" placeholder="请输入简要描述">
                    </div>
                    <div class="form-group">
                        <label>商品原价</label>
                        <input class="form-control" id="goods-id" name="id" placeholder="请输入品牌编号">
                    </div>
                    <div class="form-group">
                        <label>商品现价</label>
                        <input class="form-control" id="goods-id" name="id" placeholder="请输入品牌编号">
                    </div>
                    <div class="form-group">
                        <label>商品数量</label>
                        <input class="form-control" id="goods-id" name="id" placeholder="请输入品牌编号">
                    </div>
                    <div class="form-group">
                        <label>数量单位</label>
                        <input class="form-control" id="gooods-id" name="id" placeholder="请输入品牌编号">
                    </div>

                    <div class="form-group">
                        <label>选择分类</label>
                        <input class="form-control" id="goods-region" name="region" placeholder="请输入品牌所属地区">
                    </div>
                    <div class="form-group">
                        <label>选择品牌</label>
                        <input class="form-control" id="goods-region" name="region" placeholder="请输入品牌所属地区">
                    </div>
                    <div class="form-group">
                        <label>添加图片</label>
                        <input class="form-control" id="gooods-region" name="region" placeholder="请输入品牌所属地区">
                    </div>
                    <div class="form-group">
                        <label>商品状态</label>
                        <input class="form-control" id="goods-region" name="region" placeholder="请输入品牌所属地区">
                    </div>
                    <div class="form-group">
                        <label>商品描述</label>
                        <div id="editor">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="brand-logo">品牌商标</label>
                        <input type="file" id="logo" name="logo">
                        <p class="help-block">图片大小120px*60px 小于5M</p>
                    </div>
                    <!-- radio -->
                    <div class="form-group">
                        <label>
                            <div class="radio">
                                <input type="radio" name="state" id="state-on" value="1" checked>
                                开启
                            </div>
                        </label><label>
                            <div class="radio">
                                <input type="radio" name="state" id="state-off" value="0">
                                关闭
                            </div>
                        </label>
                    </div>
                    <div class="box-footer">
                        <button type="submit" id="brand-submit" class="btn btn-primary">提交</button>
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
