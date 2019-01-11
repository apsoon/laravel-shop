@extends('admin.layouts.app')
@section('title', '品牌列表')
@section('content')
    <div class="container">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">品牌列表</h3>
            </div>
            <div id="brand-table-wrap" class="box-body">
                <div class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="brand-table" class="table table-bordered table-hover dataTable" role="grid"
                                   aria-describedby="brand-info">
                                <thead>
                                <tr role="row" tabindex="0">
                                    <th class="sorting" aria-controls="brand-table" rowspan="1" colspan="1">Logo</th>
                                    <th class="sorting" aria-controls="brand-table" rowspan="1" colspan="1">品牌名称</th>
                                    <th class="sorting" aria-controls="brand-table" rowspan="1" colspan="1">地区</th>
                                    <th class="sorting" aria-controls="brand-table" rowspan="1" colspan="1">描述</th>
                                    <th class="sorting" aria-controls="brand-table" rowspan="1" colspan="1">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($brands as $brand)
                                    <tr role="row">
                                        <td class="sorting_1">{{ $brand->name }}</td>
                                        <td>{{ $brand->reign }}</td>
                                        <td>{{ $brand->describe }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>

                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="row">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            $('#brand-table').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': true,
                'autoWidth': false
            })
        })
    </script>
@endsection
