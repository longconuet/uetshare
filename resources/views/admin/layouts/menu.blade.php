<div class="col-md-2 menu">
	<ul class="nav nav-pills nav-stacked nav-menu">
		<li><a href="{{ url('/') }}"><span class="glyphicon glyphicon-home"></span> Trang chủ</a></li>
		<li><a data="subject" href="{{ url('admin/subject/list') }}"><span class="glyphicon glyphicon-list"></span> Môn học</a></li>
		<li><a data="document" href="{{ url('admin/document/list') }}"><span class="glyphicon glyphicon-book"></span> Tài liệu</a></li>
		<li><a data="user" href="{{ url('admin/user/list') }}"><span class="glyphicon glyphicon-user"></span> Người dùng</a></li>
	</ul>
</div>