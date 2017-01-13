<style>
	.comment {
		background-color: #bdc3c7;
		padding: 10px;
		margin: 20px 0;
		border-radius: 10px;
	}
	.view-comment .view, .view-comment .cmt {
		color: #bdc3c7;
		margin: 0 30px;
		font-size: 14px;
	}
	.iother-content {
		background-color: #ecf0f1;
		padding: 0 15px 10px 15px;
	}
	.del-cmt a {
		color: red;
		float: right;
	}
</style>

@extends('layouts.index')

@section('content')
	
	<div class="body-container">
		<div class="row">
			<div class="col-md-8">
				<div class="main_detail">
					<h1>{{ $document->name }}</h1>
					<p></p>
					<div class="posted">
						<p>Đăng bởi: <span style="color: blue">{{ $document->user->username }}</span></p>
					</div>
					<p><span class="glyphicon glyphicon-time"></span> {{ $document->created_at }}</p>

					@if ($document->description != "")
						<p class="alert alert-info">{{ $document->description }}</p>
					@endif

					<hr>
					<div class="img-document">
						@if ($document->extension == 'jpg' || $document->extension == 'png')							
							<img width="100%" src="public/upload/{{ $document->path }}" alt="">
						@elseif ($document->extension == 'pdf')
							<iframe src="public/upload/{{ $document->path }}" width="90%" height="800px" frameborder="0"></iframe>
						@else
							<p style="height: 200px">Không hỗ trợ hiển thị định dạng file này. Vui lòng tải xuống để xem chi tiết.</p>					
						@endif
					</div>

					<a href="{{ url('download/'.$document->id) }}"><button class="btn btn-lg btn-primary btn-download">Download</button></a>
					<hr>

					<!-- Form Comments -->
					@if (Auth::check() && Auth::user()->active == 1)
						<div class="comment">
							<h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
							<form role="form" action="{{ url('comment/'.$document->id.'/'.$document->name_without_sign) }}" method="post">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<div class="form-group">
									<textarea class="form-control" rows="3" name="content"></textarea>
								</div>
								<button type="submit" class="btn btn-primary">Gửi</button>
							</form>
						</div>
					@endif
					<!-- Posted Comments -->
				</div>
				

				<!-- Comment -->
				<div class="cmt">
					<h3>Bình luận</h3><hr>
					
					@foreach($comments as $comment)
						<div class="row cmt-item">

							<div class="img-user-cmt col-md-1">
								<img src="public/images/user.png" class="img-circle" width="60px" alt="">
							</div>

							<div class="content-cmt col-md-11">
								<h4 class="media-heading"><a href="#">{{ $comment->user->username }} 
									@if ($comment->user->is_admin == 1)
										{{ "(Admin)" }}
									@endif
									</a>
									<br><small>{{ $comment->created_at }}</small>
								</h4>
								{{ $comment->content }}

								@if (Auth::check() && ($comment->id_user == Auth::user()->id))
									<span class="del-cmt"><a href="{{ url('delete-comment/'.$comment->id.'/'.$document->id) }}">Xóa</a></span>
								@endif
								
							</div>

						</div>
						<hr>
					@endforeach
					
				</div>
			</div>

			<!-- Tài liệu liên quan -->
			<div class="col-md-4">
				<div class="right_detail">
					<h3 style="text-align: center">Tài liệu liên quan</h3>

					@foreach($relatedDocs as $related)
						<div class="col-md-8 col-md-offset-3">
							<div class="row">
								<hr>
								<div class="iother-content">
									<a href="{{ url('document/'.$related->id.'/'.$related->name_without_sign) }}">
										<br>
										@if ($related->extension == 'jpg' || $related->extension == 'png')
											<img src="public/upload/{{ $related->path }}" alt="" class="img-responsive">
										@elseif ($related->extension == 'pdf')
											<img src="public/images/pdf-logo.png" alt="" class="img-responsive">
										@elseif ($related->extension == 'doc' || $related->extension == 'docx')
											<img src="public/images/word-logo.png" alt="" class="img-responsive">
										@endif
									</a>
									<br>
									<p align="center">{{ $related->name }}</p>
									<p align="center" class="view-comment">
										<span class="view"><span class="glyphicon glyphicon-eye-open"></span> {{ $related->view }} </span>
										<span class="cmt"><span class="glyphicon glyphicon-comment"></span> {{ count($related->comment) }} </span>
									</p>
								</div>
							</div>
						</div>
					@endforeach

				</div>
			</div>
		</div>
	</div>

@stop