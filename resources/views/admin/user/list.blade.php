@extends('admin.layouts.index')

@section('title')
	Người dùng
@stop

@section('content')

<div class="col-md-9">
    <h1 class="page-header">Người dùng - 
        <small>Danh sách</small>
    </h1>
    <br>
    <em><p>Hiện có {{ $quantity }} người dùng</p></em>
    
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Code</th>
                <th>Active</th>
                <th>Admin</th>
                <th>Đổi quyền</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr align="center">
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->code }}</td>
                    <td>{{ $user->active }}</td>
                    <td>{{ $user->is_admin }}</td>
                    <td><a href="{{ url('admin/user/edit/'.$user->id) }}"><button class="btn btn-warning"><span class="glyphicon glyphicon-refresh"></span></button></a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="row text-center">
        <div class="col-xs-12">
            {{ $users->links() }}
        </div>
    </div>
</div>

@stop

@section('script')

    <script>
        $(document).ready(function() {
            $(".nav-menu li a[data=user]").parent('li').addClass('active');
        });
    </script>

@stop