<div class="header">
	<div class="container">
		<div class="row">
			<div class="menu">
				<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
					<div class="container">
						<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand" href="{{ url('/') }}" style="color: #2ecc71; font-size: 28px">UET Share</a>
						</div>

						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav">
								<li><a href="{{ url('about') }}">Giới thiệu</a></li>
							</ul>

							<form class="navbar-form navbar-left" role="search" action="{{ url('search') }}" method="post">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<div class="form-group">
									<input type="text" class="form-control" name="keyword" placeholder="Nhập...">
								</div>
								<button type="submit" class="btn btn-primary">Tìm kiếm</button>
							</form>

							<ul class="nav navbar-nav navbar-right account">
								@if (!(Auth::check() && Auth::user()->active == 1))
									<li><a href="{{ url('signup') }}">Đăng ký</a></li>
			                    	<li><a href="{{ url('login') }}">Đăng nhập</a></li>
			                    @else
			                    	<li><a href="{{ url('upload-file') }}"><span class="glyphicon glyphicon-open"></span> Tải lên</a></li>
			                    	<li><a href="{{ url('my-upload/list') }}"><span class="glyphicon glyphicon-folder-open"></span> Tài liệu của tôi</a></li>
			                    	<li><a href="{{ url('profile') }}"><span class="glyphicon glyphicon-user"></span> {{ Auth::user()->username }}</a></li>

			                    	@if (Auth::user()->is_admin == 1)
			                    		<li><a href="{{ url('admin/document/list') }}"><span class="glyphicon glyphicon-globe"></span> Quản trị</a></li>
			                    	@endif

			                    	<li><a href="{{ url('logout') }}"><span class="glyphicon glyphicon-log-out"></span> Đăng xuất</a></li>
								@endif	                   
							</ul>
						</div>
					</div>
				</nav>
			</div>
		</div>
	</div>
</div>