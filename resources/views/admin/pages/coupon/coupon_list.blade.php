@extends('admin.layouts.app')
@section('title', '优惠券管理')
@section('subtitle', '优惠券列表')
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <a href="{{ url("coupon/add") }}">
                <button type="button" class="btn btn-sm btn-info btn-flat">添加优惠券</button>
            </a>
            <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">&laquo;</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">&raquo;</a></li>
            </ul>
        </div>
        <div class="box-body no-padding table-responsive">
            <table class="table table-hover">
                <tr>
                    <th style="width: 40px;">
                        <label>
                            <input type="checkbox">
                        </label>
                    </th>
                    <th style="width: 150px;">名称</th>
                    <th>名称</th>
                    <th style="width: 150px;">数量</th>
                    <th style="width: 150px;"></th>
                    <th style="width: 270px">操作</th>
                </tr>
                @foreach($goodsList as $goods)
                    <tr role="row">
                        <td>
                            <label>
                                <input type="checkbox">
                            </label>
                        </td>
                        <td>{{ $goods->category_id }}</td>
                        <td>{{ $goods->name }}</td>
                        <td>{{ $goods->brand_id }}</td>
                        <td>
                            <a href="{{ url("goods/detail?goods_id=")}}{{$goods->id}}">
                                <button type="button"
                                        class="btn btn-success btn-flat">详情
                                </button>
                            </a>
                            <button type="button" class="btn btn-info btn-flat">修改</button>
                            <button type="button" class="btn btn-danger  btn-flat">删除</button>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>

    </div>
    <script type="text/javascript">
        function navigateToDetail(goodsId, url) {
            console.info(goodsId, url);
        }
    </script>
@endsection
