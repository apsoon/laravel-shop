@extends('admin.layouts.app')
@section('title', '主页')
@section('subtitle', '主页')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                                asdfasdf
                            </div>
                        @endif
                        You are logged in!
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
