@extends('admin.layouts.app')
@section('title', '属性管理')
@section('subtitle', '添加属性')
@section('content')
    <form role="form" action="{{url("attribute/create")}}" method="post">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">广告表单</h3>
            </div>
            <div class="box-body with-border">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label>广告名称</label>
                    <input class="form-control" id="name" name="name" placeholder="请输入广告名称">
                </div>
                <div class="form-group">
                    <label>广告描述</label>
                    <input class="form-control" id="content" name="content" placeholder="请输入广告描述">
                </div>
                <div class="form-group">
                    <label>添加图片<b class="text-red">*</b></label>
                    <input class="file" type="file" id="image-url" accept="image/gif, image/png, image/jpeg, image/jpg"
                           name="image_url">
                    <p class="help-block">图片大小120px*60px 小于5M</p>
                </div>
                <div class="row">
                    <div class="form-group col-md-3">
                        <label>选择属性组<b class="text-red">*</b></label>
                        <label>
                            <select class="form-control select2" id="position-id" name="position_id">
                                @foreach($positionList as $position)
                                    <option value="{{$position->id}}">{{$position->name}}</option>
                                @endforeach
                            </select>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label>排序<b class="text-red">*</b></label>
                    <input class="form-control" id="sort-order" name="sort_order" type="number" placeholder="请输入排序优先级">
                    <p class="help-block">根据数字大小，正序排列</p>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="col-xs-1">是否启用</label>
                        <label class="col-md-1">
                            <input type="radio" name="state" id="state-on" value="0"
                                   checked><label style="margin-left: 10px;">禁用</label></label>
                        <label class="col-md-1">
                            <input type="radio" name="state" id="state-off" value="1"
                                   style="margin-left: 10px;"><label style="margin-left: 10px;">启用</label>
                        </label>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button id="ad-submit" type="button" class="btn btn-primary">提交</button>
            </div>
        </div>
    </form>
    <script type="text/javascript">

        $("#ad-submit").click(function () {
            let formValue = $("form").serializeArray();
            let data = {
                positionId: $("#position-id").val(),
                name: $("#name").val(),
                content: $("#content").val(),
                sortOrder: $("#sort-order").val(),
            };
            for (let item of formValue) {
                if (item.name === "state") {
                    data.state = item.value;
                    break;
                } else if (item.name === "_token") {
                    data._token = item.value;
                }
            }
            $.ajax({
                url: "{{url("ad/create")}}",
                type: "POST",
                data: data,
                success: res => {
                    window.location = res;
                }
            });
        });
    </script>
@endsection
