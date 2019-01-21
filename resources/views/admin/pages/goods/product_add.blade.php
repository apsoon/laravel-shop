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
                    <input class="form-control" id="product-name" name="product-name" placeholder="请输入产品名称">
                </div>
                <div class="row">
                    <div class="form-group col-md-3">
                        <label>产品原价</label>
                        <input class="form-control" type="number" id="origin-price" name="originPrice"
                               placeholder="请输入产品原价">
                    </div>
                    <div class="form-group col-md-3">
                        <label>产品现价<b class="text-red">*</b></label>
                        <input class="form-control" type="number" id="product-price" name="price"
                               placeholder="请输入产品现价">
                    </div>
                    <div class="form-group col-md-3">
                        <label>产品数量<b class="text-red">*</b></label>
                        <input class="form-control" type="number" id="product-number" name="number"
                               placeholder="请输入产品数量">
                    </div>
                </div>
                <div class="row">
                    @foreach($specificationList as $index =>$specification)
                        <div class="form-group col-md-2">
                            <label>{{$specification->name}}</label>
                            <label>
                                <select class="form-control select2-container" name="option{{$index}}">
                                    @foreach($specification->options as $option)
                                        <option value="{{$specification->id}}-{{$option->id}}">{{$option->name}}</option>
                                    @endforeach
                                </select>
                            </label>
                        </div>
                    @endforeach
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
                <button type="button" id="product-submit" class="btn btn-primary">提交</button>
            </div>
        </form>
    </div>
    <script type="text/javascript">
        $("#product-submit").click(function () {
            let data = {},
                formValue = $("form").serializeArray();
            data._token = formValue._token;
            data.name = $("#product-name").val();
            data.originPrice = $("#origin-price").val();
            data.price = $("#product-price").val();
            data.number = $("#product-number").val();
            data.goodsId = "{{$goods_id}}";
            data.options = [];
            console.info("form =====", formValue);
            for (let item of formValue) {
                if (item.name.indexOf("option")>=0) {
                    let ops = item.value.split("-");
                    data.options.push({
                        specification_id: ops[0],
                        option_id: ops[1]
                    });
                } else if (item.name.indexOf("_token") >= 0) {
                    data._token = item.value;
                }
            }
            console.info(data);
            $.ajax({
                type: "POST",
                url: "{{url("product/create")}}",
                data: data,
                success: res => {

                }
            });
        });
    </script>
@endsection
