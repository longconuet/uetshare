@extends('admin.layouts.index')

@section('title')
	Người dùng
@stop

@section('content')

<div class="col-md-6">
    <h1 class="page-header">Người dùng
        <small>Đổi quyền</small>
    </h1>

    <!-- notification -->
    @if (session('noti'))
        <div class="alert alert-success">
            {{ session('noti') }}
        </div>
    @endif

    <form action="{{ url('admin/user/edit/'.$user->id) }}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label>Quyền</label>
            <label class="radio-inline">
                <input name="is_admin" value="1" 
                    @if($user->is_admin == 1)
                        {{ "checked" }}
                    @endif
                type="radio">Admin
            </label>
            <label class="radio-inline">
                <input name="is_admin" value="0"  
                    @if($user->is_admin == 0)
                        {{ "checked" }}
                    @endif
                type="radio">Thành viên
            </label>
        </div>
        <button type="submit" class="btn btn-success">Đổi</button>
        <a href="{{ url('admin/user/list') }}"><button type="button" class="btn btn-default">Quay về Danh sách</button></a>
    <form>
</div>

@stop

@section('script')

    <script>
        $(document).ready(function() {
            $(".nav-menu li a[data=user]").parent('li').addClass('active');
        });
    </script>

@stop