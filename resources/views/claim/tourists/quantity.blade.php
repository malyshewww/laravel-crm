@if ($claim->tourist)
	<ul class="tourists-list">
		@foreach ($claim->tourist as $tourist)
			<li data-bs-toggle="tooltip" data-bs-trigger="hover" title="{{$tourist->tourist_surname ?: ''}} {{$tourist->tourist_name ?: ''}} {{$tourist->tourist_patronymic ?: ''}}"> 
				<span>-</span><span><i class="fa-solid fa-user"></i></span>
			</li>
		@endforeach
	</ul>
@endif