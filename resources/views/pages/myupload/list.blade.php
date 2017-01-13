<style>
	.my-upload-button a button{
		width: 80px;
		margin: 0 10px;
	}
	.created_at {
		color: blue;
	}
	.other-content {
		margin-bottom: 40px;
	}
	.other-content:hover {
		background-color: #ecf0f1;
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
						<span>Các tài liệu của bạn đã tải lên</span>
					</div>
					
					@foreach($documents as $document)
						<div class="col-md-4">
							<div class="row">
								<p align="center" class="create_at">{{ $document->created_at }}</p>
								<div class="other-content" style="height: 450px;">								
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
									<center class="my-upload-button">
										<a href="{{ url('my-upload/edit/'.$document->id) }}"><button class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span> </button></a>
	                        			<a href="#myModal" data-toggle="modal" data-whatever="{{ $document->id }}"><button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button></a>
									</center>
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

				<!-- Modal delete -->
		        <div class="container">
		            <div class="modal fade" id="myModal" role="dialog">
		                <div class="modal-dialog">
		                    
		                    <!-- Modal content-->
		                    <div class="modal-content">
		                        <div class="modal-header">
		                            <button type="button" class="close" data-dismiss="modal">&times;</button>
		                            <h4 class="modal-title">Thông báo</h4>
		                        </div>
		                        <div class="modal-body">
		                            <p>Bạn có chắc chắn muốn xóa tài liệu này?</p>
		                        </div>
		                        <div class="modal-footer">
		                            <a href="" class="btn btn-danger">Xóa</a>
		                            <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
		                        </div>
		                    </div>
		                    
		                </div>
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
            $('#myModal').on('show.bs.modal', function (event) {
                var link = $(event.relatedTarget);
                var id = link.data('whatever');
                var modal = $(this);
                var url = "my-upload/delete/" + id;
                modal.find('.modal-footer a').attr('href', url);
            });
        });
    </script>

@stop