@extends('admin.layouts.index')

@section('title')
	Môn học
@stop

@section('content')

    <div class="col-md-9">
        <h1 class="page-header">Môn học
            <small>Danh sách</small>
        </h1>
        <a href="{{ url('admin/subject/add') }}"><button class="btn btn-success btn-block"><span class ="glyphicon glyphicon-plus"></span> Thêm mới</button></a>
        <br>
        
        <!-- notification -->
        @if (session('noti'))
            <div class="alert alert-success">
                {{ session('noti') }}
            </div>
        @endif

        <em><p>Hiện có {{ $quantity }} môn học</p></em>
        
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Tên Không Dấu</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subjects as $subject)
                    <tr align="center">
                        <td>{{ $subject->id }}</td>
                        <td>{{ $subject->name }}</td>
                        <td>{{ $subject->name_without_sign }}</td>
                        <td><a href="{{ url('admin/subject/edit/'.$subject->id) }}"><button class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span></button></a></td>
                        <td><a href="#myModal" data-toggle="modal" data-whatever="{{ $subject->id }}"><button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button></a></td>                     
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="row text-center">
            <div class="col-xs-12">
                {{ $subjects->links() }}
            </div>
        </div>

        <!-- Modal delete -->
        {{-- <div class="container"> --}}
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                    
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Thông báo</h4>
                        </div>
                        <div class="modal-body">
                            <p>Bạn có chắc chắn muốn xóa môn học này?</p>
                        </div>
                        <div class="modal-footer">
                            <a href="" class="btn btn-danger">Xóa</a>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                        </div>
                    </div>
                    
                </div>
            </div>          
        {{-- </div> --}}
    </div>

@stop

@section('script')

    <script>
        $(document).ready(function() {
            $(".nav-menu li a[data=subject]").parent('li').addClass('active');

            $('#myModal').on('show.bs.modal', function (event) {
                var link = $(event.relatedTarget);
                var id = link.data('whatever');
                var modal = $(this);
                var url = "admin/subject/delete/" + id;
                modal.find('.modal-footer a').attr('href', url);
            });
        });
    </script>

@stop