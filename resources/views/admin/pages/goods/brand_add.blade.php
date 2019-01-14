@extends('admin.layouts.app')
@section('title', '添加品牌')
@section('content')
    <div class="container">
        <div class="box box-primary">
            <div class="box-body">
                <form role="form">
                    <div class="form-group">
                        <label>品牌名称</label>
                        <input class="form-control" id="brand-name" placeholder="请输入品牌名称">
                    </div>
                    <div class="form-group">
                        <label>品牌编号</label>
                        <input class="form-control" id="brand-id" placeholder="请输入品牌编号">
                    </div>
                    <div class="form-group">
                        <label>所属地区</label>
                        <input class="form-control" id="brand-reign" placeholder="请输入品牌所属地区">
                    </div>
                    <div class="form-group">
                        <label>品牌描述</label>
                        <textarea class="form-control" id="brand-desc" rows="3" placeholder="请输入商品描述"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="brand-logo">品牌商标</label>
                        <input type="file" id="brand-logo">
                        <p class="help-block">图片大小120px*60px 小于5M</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
