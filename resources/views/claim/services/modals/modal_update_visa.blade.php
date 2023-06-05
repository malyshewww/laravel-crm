<input type="hidden" name="type" value="visa">
<input type="hidden" name="record_id" value="{{$visa->id}}">
<div class="field-group"> 
	<div class="row">
		<div class="col-lg-6">
			<div class="field-group__item">
				<label class="field-group__label">Название</label>
				<div class="field-group__box">
					<input class="field-group__input" type="text" name="visa_name"
					value="{{$visa->visa_name ?: ''}}">
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="field-group__item">
				<label class="field-group__label">Страна назначения</label>
				<div class="field-group__box">
					<input class="field-group__input" type="text" name="visa_country"
					value="{{$visa->visa_country ?: ''}}">
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="field-group__item">
				<label class="field-group__label">Начало действия</label>
				<div class="field-group__box">
					<input class="field-group__input" type="text" 
					data-name="date_start" data-format="date"
					name="datevisa_start"
					value="{{$visa->datevisa_start ? $visa->datevisa_start->format('Y-m-d') : ''}}">
					<div class="field-group__trigger">
						<i class="fa-regular fa-calendar-days calendar-icon"></i>
						<input class="input-trigger" type="text" data-trigger="date_start">
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="field-group__item">
				<label class="field-group__label">Окончание действия</label>
				<div class="field-group__box">
					<input class="field-group__input" type="text" 
					data-name="date_end" data-format="date"
					name="datevisa_end"
					value="{{$visa->datevisa_end ? $visa->datevisa_end->format('Y-m-d') : ''}}">
					<div class="field-group__trigger">
						<i class="fa-regular fa-calendar-days calendar-icon"></i>
						<input class="input-trigger" type="text" data-trigger="date_end">
					</div>
				</div>
			</div>
		</div>
		<div class="col-12">
			@include('claim.tourists.list_tourists')
		</div>
	</div>
</div>