<div class="col-md-3 menu-sidebar">
	<ul class="nav nav-pills nav-stacked nav-menu">
		<li><a href="{{ url('/') }}" id="title-nav"><span class="glyphicon glyphicon-list"></span> Tài liệu các môn học</a></li>
		
		@foreach($subjects as $subject)
			{{-- @if (count($subject->document) > 0) --}}
				<li>
					<a href="{{ url('subject/'.$subject->id.'/'.$subject->name_without_sign) }}">{{ $subject->name }}<span class="badge" style="float: right; color: white; background-color: #95a5a6">{{ count($subject->document) }}</span>
					</a>
				</li>
			{{-- @endif --}}
		@endforeach
	</ul>
</div>