@extends('admin.layouts.app')
@section('title', '商品管理')
@section('subtitle', '商品列表')
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <a href="{{ url("goods/add") }}">
                <button type="button" class="btn btn-sm btn-info btn-flat">添加商品</button>
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
                    <th style="width: 250px;">订单编号</th>
                    <th>总价</th>
                    <th>优惠</th>
                    <th style="width: 150px;">订单时间</th>
                    <th>状态</th>
                    <th style="width: 270px">操作</th>
                </tr>
                @foreach($orderList as $order)
                    <tr role="row">
                        <td>{{ $order->order_sn }}</td>
                        <td>{{ $order->price }}</td>
                        <td>{{ $order->discount }}</td>
                        <td>{{ $order->created_at }}</td>
                        <td>{{ $order->state }}</td>
                        <td>
                            <a href="{{ url("order/detail?order_id=")}}{{$goods->id}}">
                                <button type="button"
                                        class="btn btn-success btn-flat">详情
                                </button>
                            </a>
                            <button type="button" class="btn btn-info btn-flat">发货</button>
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
