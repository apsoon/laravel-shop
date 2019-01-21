@extends('admin.layouts.app')
@section('title', '商品管理')
@section('subtitle','添加商品')
@section('content')
    <div class="box box-primary">
        <form id="goods-form" role="form" action="{{url("goods/create")}}" method="post">
            <div class="box-body">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label>商品名称<b class="text-red">*</b></label>
                    <input class="form-control" id="goods-name" name="name" placeholder="请输入商品名称">
                </div>
                <div class="form-group">
                    <label>简要描述</label>
                    <input class="form-control" id="goods-brief" name="brief" placeholder="请输入简要描述">
                </div>
                <div class="form-group">
                    <label>选择分类<b class="text-red">*</b></label>
                    <label>
                        <select class="form-control select2-container" name="category_id">
                            <option value="0">未选择</option>
                            @foreach($categoryList as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </label>
                </div>
                <div class="form-group">
                    <label>选择品牌<b class="text-red">*</b></label>
                    <label>
                        <select class="form-control select2-container" name="brand_id">
                            <option value="0">未选择</option>
                            @foreach($brandList as $brand)
                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                            @endforeach
                        </select>
                    </label>
                </div>
                <div class="form-group">
                    <label>添加图片<b class="text-red">*</b></label>
                    <input class="file" type="file" id="logo" accept="image/gif, image/png, image/jpeg, image/jpg"
                           name="cover">
                    <p class="help-block">图片大小120px*60px 小于5M</p>
                </div>
                <div class="form-group">
                    <label>商品描述<b class="text-red">*</b></label>
                    <div id="editor">
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" id="goods-submit" class="btn btn-primary">提交</button>
            </div>
        </form>
    </div>
    <script type="text/javascript"
            src="{{ asset("lib/wangEditor/wangEditor.min.js") }}"></script>
    <script type="text/javascript">
        var E = window.wangEditor
        var editor = new E('#editor')
        // 或者 var editor = new E( document.getElementById('editor') )
        editor.create()

        /**
         *  商品名称判空
         */
        $("#goods-name").blur(function (e) {
            let data = $("#goods-name").val();
            console.info(data);
            if (data == null || data === undefined || data === "") {
                $("#goods-name").attr('placeholder', "商品内容不能为空");
                $("#goods-name").addClass("border-danger")
            } else {
                $("#goods-name").removeClass("border-danger")
            }
        });

        $("#goods-form").submit(function (e) {
            let desc = editor.txt.html();

            // let data = $(this).serialize();    //序列化表单
            // console.log(data);                 //打印表单数据
            // console.log(e);                 //打印表单数据
            // e = e || window.event;
            // e.preventDefault();                //阻止表单提交
        });
    </script>
@endsection
