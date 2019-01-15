@extends('admin.layouts.app')
@section('title', '帮助文档')
@section('subtitle', '首页')
@section('content')
    <div class="container">
        <div>
            第一步：添加一个分类

            第二步：给分类添加所属规格

            第三步：给规格设置一系列选项

            第四步：添加一个SPU并设置SPU下的一组轮播图片

            第五步：添加一个SKU，添加SKU的时候根据选择的不同SPU自动列出对应的规格和规格选项供勾选(只能单选)，并且列出SPU下的一组轮播图片供SKU挑选
        </div>
        <br>
        <div>
            第一步：添加一个分类

            第二步：给分类添加属性组

            第三步：给属性组添加属性

            第四步：给属性添加属性参数

            第五步：添加SPU时，列出SPU对应分类下的所有属性组、属性、属性参数供勾选(可多选)
        </div>
        <br>
        <div>
            第一步：SPU编辑界面上传详情图片
        </div>
    </div>
@endsection
