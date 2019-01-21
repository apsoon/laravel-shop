@extends('admin.layouts.app')
@section('title', '规格管理')
@section('subtitle','添加规格选项')
@section('content')
    <div class="box box-primary">
        <form id="option-form" role="form" action="{{url("specificationOption/create")}}" method="post">
            <div class="box-header with-border">
                <button type="button" id="add-option" class="btn btn-info btn-flat">添加选项</button>
            </div>
            <div class="box-body">
                {!! csrf_field() !!}
                <label>规格值<b class="text-red">*</b></label>
                <div class="row col-md-12" id="option-list">
                    <div class="form-group col-md-2">
                        <input class="form-control" id="option-name" name="option1" placeholder="请输入规格值">
                    </div>
                </div>
                <input id="url" type="hidden" name="url" value="{{url("specificationOption/create")}}">
            </div>
            <div class="box-footer">
                <button type="button" id="option-submit" class="btn btn-primary btn-flat">提交</button>
            </div>
        </form>
    </div>
    <script type="text/javascript">
        let count = 1;
        $('#add-option').click(function () {
            count += 1;
            $('#option-list').append("<div class=\"form-group col-md-2\">\n" +
                "                        <input class=\"form-control\" id=\"option-name\" name=\"option" + count + "\" placeholder=\"请输入名称\">\n" +
                "                    </div>");
        });

        // 提交表单
        $('#option-submit').click(function () {
            // let data = {},
            let forms = $("form").serializeArray(),
                url = "{{url("specificationOption/create")}}";
            let data = {
                options: [],
                specification_id: "{{$specification_id}}",
            }
            for (let item of forms) {
                if (item.name.indexOf("option") >= 0 && item.value) {
                    data.options.push(item.value);
                } else if (item.name === "_token") {
                    data._token = item.value;
                }
            }
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                success: res => {
                    window.location = res;
                }
            });
        });
    </script>
@endsection
