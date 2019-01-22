@extends('admin.layouts.app')
@section('title', '广告管理')
@section('subtitle', '广告列表')
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <a href="{{ url("ad/add") }}">
                <button type="button" class="btn btn-sm btn-info btn-flat">添加广告</button>
            </a>
        </div>
        <div class="box-body no-padding table-responsive">
            <div class="table table-hover">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th style="width: 40px;">
                            <label>
                                <input type="checkbox">
                            </label>
                        </th>
                        <th style="width: 150px;">名称</th>
                        <th>描述</th>
                        <th style="width: 150px;">状态</th>
                        <th style="width: 270px;">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($adList as $index => $ad)
                        <tr>
                            <td>
                                <label>
                                    <input type="checkbox">
                                </label>
                            </td>
                            <td>{{$ad->name}}</td>
                            <td>{{$ad->content}}</td>
                            <td>
                                @if($ad->state)
                                    已启用
                                @else
                                    已禁用
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-info btn-flat">修改</button>
                                <button type="button"
                                        class="btn {{$ad->state==0? 'btn-success':'btn-warning'}} btn-flat"
                                        onclick="changeState({{$index}})">
                                    @if($ad->state)
                                        禁用
                                    @else
                                        启用
                                    @endif
                                </button>
                                <button type="button" class="btn btn-danger  btn-flat">删除</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="box-footer"></div>

    </div>
    <script type="text/javascript">
        function changeState(index) {
            let adList = "{{$adList}}";
            let ad = adList[index];
            let data={
                adId : ad.id,
                // type: ad.state?
            }
            $.ajax({
                url:"{{url("")}}"
            })
        }
    </script>
@endsection
