<style>
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
						<span>Chỉnh sửa tài liệu</span>
					</div>

					<div class="col-xs-8">
					
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
					    
					    <form action="{{ url('my-upload/edit/'.$document->id) }}" method="POST" enctype="multipart/form-data" id="uploadForm">
					        <input type="hidden" name="_token" value="{{ csrf_token() }}">
					        <div class="form-group">
					            <label>Tên</label>
					            <input class="form-control" name="name" value="{{ $document->name }}" placeholder="Nhập tên tài liệu" />
					        </div>
					        <div class="form-group">
					            <label>Môn học</label>
					            <select class="form-control" name="id_subject">
					                @foreach($subjects as $subject)
					                    <option value="{{ $subject->id }}"
					                        @if ($subject->id == $document->subject->id)
					                            {{ "selected" }}
					                        @endif
					                    >{{ $subject->name }}</option>
					                @endforeach
					            </select>
					        </div>
					        <div class="form-group">
					            <label>Mô tả</label>
					            <textarea class="form-control" rows="3" name="description">{{ $document->description }}</textarea>
					        </div>                   
					        <div class="form-group">
					            <label>File đính kèm</label>
					            @if ($document->extension == 'jpg' || $document->extension == 'png')
					            	<p><img src="public/upload/{{ $document->path }}" width="300px" alt=""></p>
					            @endif					            
					            <p>{{ $document->path }}</p>
					            <input type="file" name="file" class="form-control">
					        </div>
					        <button type="submit" class="btn btn-success">Sửa</button>
					    </form>
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
                    }
                },
                messages: {
                	name: {
	                    required: "<span class='validation-message'>Bạn phải nhập tên tài liệu</span>",
	                    minlength: "<span class='validation-message'>Tiêu đề ít nhất 6 ký tự</span>"
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