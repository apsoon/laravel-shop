@extends('admin.layouts.app')
@section('title', '分类管理')
@section('title', '分类列表')
@section('content')
    <div class="content">
        <div class="col-xs-12">
            <div class="box table-striped">
                <div class="box-header">
                    <a href="{{ url("category/add") }}">
                        <button type="button" class="btn btn-sm btn-success btn-flat">添加分类</button>
                    </a>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        {{--<tr>--}}
                        {{--<th>--}}
                        {{--<label>--}}
                        {{--<input type="checkbox">--}}
                        {{--</label>--}}
                        {{--</th>--}}
                        {{--<th>编号</th>--}}
                        {{--<th>分类</th>--}}
                        {{--<th>名称</th>--}}
                        {{--<th>原价格</th>--}}
                        {{--<th>现价</th>--}}
                        {{--<th>地区</th>--}}
                        {{--<th>状态</th>--}}
                        {{--<th>操作</th>--}}
                        {{--</tr>--}}
                        @foreach($categories as $category)
                            <tr role="row">
                                <td class="sorting_1">{{ $category->name }}</td>
                                {{--                <td>{{ $category->describe }}</td>--}}
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
