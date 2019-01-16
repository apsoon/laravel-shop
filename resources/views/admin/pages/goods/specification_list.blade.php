@extends('admin.layouts.app')
@section('title', '规格管理')
@section('subtitle', '规格列表')
@section('content')
    <div class="content">
        <div class="col-xs-12">
            <div class="box table-striped">
                <div class="box-header">
                    <a href="{{ url("specification/add") }}">
                        <button type="button" class="btn btn-sm btn-success btn-flat">添加规格</button>
                    </a>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        @foreach($specifications as $specification)
                            <tr role="row">
                                <td class="sorting_1">{{ $specification->name }}</td>
                                {{--                <td>{{ $category->describe }}</td>--}}
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
