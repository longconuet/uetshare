<style>
	.form-upload-file {
		margin: 20px;
		padding: 20px;
	}
	.validation-message {
        color: red;
        font-weight: normal;
    }
</style>

@extends('layouts.index')

@section('content')

	<div class="body-container">
		<div class="row">
			<!-- Menu -->
			@include('layouts.menu')
			<!-- End menu -->

			<!-- Main content -->
			<div class="col-xs-12 col-md-9">
				<div class="main-content">
					<div class="title">
						<span>Tải lên tài liệu của bạn</span>
					</div>
					
					<div class="col-md-10 form-upload-file">
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

				        @if (session('alert'))
				            <div class="alert alert-danger">
				                {{ session('alert') }}
				            </div>
				        @endif
				        
				        <form action="{{ url('upload-file') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
				            <input type="hidden" name="_token" value="{{ csrf_token() }}">
				            <div class="form-group">
				                <label>Tên</label>
				                <input class="form-control" name="name" placeholder="Nhập tên tài liệu" />
				            </div>
				            <div class="form-group">
				                <label>Môn học</label>
				                <select class="form-control" name="id_subject">
				                    @foreach($subjects as $subject)
				                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
				                    @endforeach
				                </select>
				            </div>
				            <div class="form-group">
				                <label>Mô tả</label>
				                <textarea class="form-control" rows="3" name="description"></textarea>
				            </div>                   
				            <div class="form-group">
				                <label>File đính kèm</label>
				                <input type="file" name="file" class="form-control">
				            </div>
				            <button type="submit" class="btn btn-primary">Tải lên</button>
				            <button type="reset" class="btn btn-default">Làm mới</button>
				        <form>
					</div>
				</div>
			</div>
			<!-- End main content -->
		</div>
	</div>

@stop

@section('script')
    <script>
        $(document).ready(function() {
        	$('#uploadForm').validate({
                rules: {
                    name: {
                        required: true,   
                        minlength: 6
                    },
                    file: {
					    required: true,
					    extension: "doc|docx|pdf|png|jpg"
					}
                },
                messages: {
                	name: {
	                    required: "<span class='validation-message'>Bạn phải nhập tên tài liệu</span>",
	                    minlength: "<span class='validation-message'>Tiêu đề ít nhất 6 ký tự</span>"
	                },
	                file: {
	                    required: "<span class='validation-message'>Bạn chưa chọn tài liệu upload</span>",
	                    extension: "<span class='validation-message'>Bạn chỉ được upload file jpg, png, doc, docx, pdf</span>"
	                }
                }
            }); 

            jQuery.validator.setDefaults({
			  	debug: true,
			  	success: "valid"
			});          
        });
                
    </script>
@stop