@extends('admin.layouts.app')
@section('title', '属性列表')
@section('content')
    <div class="container">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">属性列表</h3>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>名称</th>
                            <th>操作</th>
                        </tr>
                        @foreach($attributes as $attribute)
                            <tr role="row">
                                <td class="sorting_1">{{ $attribute->name }}</td>
                                <td>编辑 删除</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
