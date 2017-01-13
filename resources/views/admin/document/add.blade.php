@extends('admin.layouts.index')

@section('title')
	Tài liệu
@stop

@section('content')

    <div class="col-md-6">
        <h1 class="page-header">Tài liệu
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

        @if (session('alert'))
            <div class="alert alert-danger">
                {{ session('alert') }}
            </div>
        @endif
        
        <form action="{{ url('admin/document/add') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
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
            <button type="submit" class="btn btn-success">Thêm</button>
            <a href="{{ url('admin/document/list') }}"><button type="button" class="btn btn-default">Quay về Danh sách</button></a>
        <form>
    </div>

@stop

@section('script')

    <script>
        $(document).ready(function() {
            $(".nav-menu li a[data=document]").parent('li').addClass('active');
        });

        $('#uploadForm').validate({
            rules: {
                name: {
                    required: true,   
                    minlength: 6
                },
                file: {
                    required: true,
                    extension: "doc|docx|pdf|jpg|png"
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
    </script>

@stop