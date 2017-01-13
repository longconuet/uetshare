<style>
	.view-comment .view, .view-comment .cmt {
		color: #bdc3c7;
		margin: 0 30px;
		font-size: 14px;
	}
	.other-content:hover {
		background-color: #ecf0f1;
		box-shadow: 2px 2px 2px #888888;
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
					<span>Tài liệu mới nhất</span>
				</div>

				@foreach($documents as $document)
					<div class="col-md-4">
						<div class="row">
							<div class="other-content" style="">
								<a href="{{ url('document/'.$document->id.'/'.$document->name_without_sign) }}">
									<br>
									@if ($document->extension == 'jpg' || $document->extension == 'png')
										<img src="public/upload/{{ $document->path }}" alt="" class="img-responsive">
									@elseif ($document->extension == 'pdf')
										<img src="public/images/pdf-logo.png" alt="" class="img-responsive">
									@elseif ($document->extension == 'doc' || $document->extension == 'docx')
										<img src="public/images/word-logo.png" alt="" class="img-responsive">
									@endif
									
								</a>
								<br>
								<p align="center">{{ $document->name }}</p>
								<p align="center" class="view-comment">
									<span class="view"><span class="glyphicon glyphicon-eye-open"></span> {{ $document->view }} </span>
									<span class="cmt"><span class="glyphicon glyphicon-comment"></span> {{ count($document->comment) }} </span>
								</p>
							</div>
						</div>
					</div>
				@endforeach	

			</div>
			<div class="row text-center">
				<div class="col-xs-12">
					{{ $documents->links() }}
				</div>
			</div>
		</div>
		<!-- End main content -->
	</div>
</div>

@stop