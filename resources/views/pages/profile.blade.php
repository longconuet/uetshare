@extends('layouts.index')

@section('content')

	<div class="main-content">
		<div class="row">

			<!-- Main content -->
			<div class="col-md-4 col-md-offset-4">
				<h1 style="text-align: center; padding-bottom: 20px; color: #2ecc71">Thông tin người dùng</h1>

				@if (session('noti'))
                    <div class="alert alert-success">{{ session('noti') }}</div>
                @endif

				<form action="{{ url('profile') }}" method="POST">
		            <input type="hidden" name="_token" value="{{ csrf_token() }}">
		            <div class="form-group">
		                <label>Tên đăng nhập</label>
		                <input class="form-control" name="name" value="{{ $user->username }}" readonly="" />
		            </div>
		            <div class="form-group">
		                <label>Email</label>
		                <input class="form-control" readonly="" name="name" value="{{ $user->email }}" />
		            </div>

                    <div class="form-group">
                    	<label><input type="checkbox" name="changePass" id="changePass">  Thay đổi mật khẩu</label>
                        <input type="password" class="form-control password" disabled="" name="newPassword" placeholder="Mật khẩu mới" />
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control password" disabled="" name="reNewPassword" placeholder="Nhập lại mật khẩu mới" />
                    </div>
		            
		            <button type="submit" class="btn btn-success">Sửa thông tin</button>
		        <form>
			</div>
			<!-- End main content -->
		</div>
	</div>

@stop

@section('script')
    <script>
        $(document).ready(function() {
            $('#changePass').change(function() {
                if ($(this).is(':checked')) {
                    $('.password').removeAttr('disabled');
                }
                else {
                    $('.password').attr('disabled', '');
                }
            });
        });
    </script>
@stop