@extends('admin.layouts.index')

@section('title')
	Môn học
@stop

@section('content')

<div class="col-md-6">
    <h1 class="page-header">Môn học
        <small>Thêm</small>
    </h1>

    <!-- errors -->
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    @endif

    <!-- notification -->
    @if (session('noti'))
        <div class="alert alert-success">
            {{ session('noti') }}
        </div>
    @endif

    <form action="{{ url('admin/subject/add') }}" method="POST" id="form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label>Tên</label>
            <input class="form-control" name="name" placeholder="Nhập tên môn học" />
        </div>
        
        <button type="submit" class="btn btn-success">Thêm</button>
        <a href="{{ url('admin/subject/list') }}"><button type="button" class="btn btn-default">Quay về Danh sách</button></a>
    <form>
</div>

@stop

@section('script')

    <script>
        $(document).ready(function() {
            $(".nav-menu li a[data=subject]").parent('li').addClass('active');
        });
    </script>

@stop