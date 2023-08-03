<div class="field-group">
	<div class="row">
		<div class="col-12">
			<div class="field-group__item">
				<label class="field-group__label">Туроператор</label>
				@if (count($touroperators) > 0)
					<select data-select name="title" multiple select-one>
							@foreach ($touroperators as $touroperator)
								<option
									value="{{$touroperator->title}}">
									{{$touroperator->title}}
								</option>
							@endforeach
					</select>
				@else
					<div class="field-group__box">
						<input class="field-group__input" type="text" name="title" autocomplete="off">
					</div>
				@endif
			</div>
		</div>
	</div>
</div>