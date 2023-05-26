<div class="checkbox-group"> 
	<div class="checkbox-group__label field-group__label">Туристы</div>
	@if (count($tourists) > 0)
		<div class="checkbox-items">
			@foreach ($tourists as $tourist)
				<div class="checkbox">
					<label>
						<input class="checkbox__input" type="checkbox" name="tourist" checked>
						<span class="checkbox__label">
							{{$tourist->tourist_surname ?: ''}}
							{{$tourist->tourist_name ?: ''}}
							{{$tourist->tourist_patronymic ?: ''}}
						</span>
					</label>
				</div>
			@endforeach
		</div>
	@else
		<div class="text-danger">
			В заявке нет туристов, для которых может быть оказана услуга	
		</div> 
	@endif
</div>