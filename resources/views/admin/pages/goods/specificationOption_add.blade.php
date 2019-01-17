@extends('admin.layouts.app')
@section('title', '规格管理')
@section('subtitle','添加规格选项')
@section('content')
    <div class="content">
        <div class="box box-primary">
            <form role="form" action="{{url("specificationGroup/create")}}" method="post">
                <div class="box-footer">
                    <button type="button" id="add-option" class="btn btn-info btn-flat">添加选项</button>
                </div>
                <div class="box-body">
                    <label>规格值<b class="text-red">*</b></label>
                    <div class="row col-md-12" id="option-list">
                        <div class="form-group col-md-2">
                            <input class="form-control" id="option-name" name="name" placeholder="请输入规格值">
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" id="option-submit" class="btn btn-primary btn-flat">提交</button>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">

        $('#add-option').click(function () {
            $('#option-list').append("<div class=\"form-group col-md-2\">\n" +
                "                        <input class=\"form-control\" id=\"option-name\" name=\"name\" placeholder=\"请输入名称\">\n" +
                "                    </div>");
        });
    </script>
@endsection
