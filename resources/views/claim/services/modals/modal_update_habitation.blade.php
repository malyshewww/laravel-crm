<input type="hidden" name="type" value="habitation">
<input type="hidden" name="record_id" value="{{$habitation->id}}">
<div class="field-group"> 
	<div class="row">
		<div class="col-12"> 
			<div class="field-group__item">
				<label class="field-group__label">Название</label>
				<div class="field-group__box">
					<input class="field-group__input" type="text" name="habitation_name"
					value="{{$habitation->habitation_name ?: ''}}" autocomplete="off">
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="field-group__item">
				<label class="field-group__label">Курорт</label>
				<div class="field-group__box">
					<input class="field-group__input" type="text" name="habitation_resort"
					value="{{$habitation->habitation_resort ?: ''}}" autocomplete="off">
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="field-group__item">
				<label class="field-group__label">Отель</label>
				<div class="field-group__box">
					<input class="field-group__input" type="text" name="habitation_hotel"
					value="{{$habitation->habitation_hotel ?: ''}}" autocomplete="off">
				</div>
			</div>
		</div>
		<div class="col-12">
			<div class="field-group__item">
				<label class="field-group__label">Адрес отеля</label>
				<div class="field-group__box">
					<input class="field-group__input" type="text" name="habitation_hotel_address"
					value="{{$habitation->habitation_hotel_address ?: ''}}" autocomplete="off">
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="field-group__item">
				<label class="field-group__label">Тип номера</label>
				<div class="field-group__box">
					<input class="field-group__input" type="text" name="habitation_type_number"
					value="{{$habitation->habitation_type_number ?: ''}}" autocomplete="off">
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="field-group__item">
				<label class="field-group__label">Тип размещения</label>
				<div class="field-group__box">
					<input class="field-group__input" type="text" name="habitation_type_placement"
					value="{{$habitation->habitation_type_placement ?: ''}}" autocomplete="off">
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="field-group__item">
				<label class="field-group__label">Тип питания</label>
				<select data-select name="habitation_type_food">
					<option value="" selected></option>
					@php
						$habitationFoodTypes = ServiceHelper::habitationFoodType();
					@endphp
					@foreach ($habitationFoodTypes as $type)
						<option
							{{$type['value'] === $habitation->habitation_type_food ? ' selected' : ''}}
							value="{{$type['value']}}">
							{{$type['title']}}
						</option>
					@endforeach
				</select>
			</div>
		</div>
		@php
			$start_ts = strtotime($habitation->datehabitation_start ? $habitation->datehabitation_start : '');
			$end_ts = strtotime($habitation->datehabitation_end ? $habitation->datehabitation_end : '');
			$date_start_format = date('Y-m-d H:i', $start_ts);
			$date_end_format = date('Y-m-d H:i', $end_ts);
		@endphp
		<div class="col-lg-3">
			<div class="field-group__item">
				<label class="field-group__label">Время заезда</label>
				<div class="field-group__box">
					<input class="field-group__input" type="text" 
					data-name="date_start" data-format="datetime"
					name="datehabitation_start"
					value="{{$start_ts ? $date_start_format : ''}}"
					autocomplete="off">
					<div class="field-group__trigger">
						<i class="fa-regular fa-calendar-days calendar-icon"></i>
						<input class="input-trigger" type="text" data-trigger="date_start" autocomplete="off">
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="field-group__item">
				<label class="field-group__label">Время выезда</label>
				<div class="field-group__box">
					<input class="field-group__input" type="text" 
					data-name="date_end" data-format="datetime"
					name="datehabitation_end"
					value="{{$end_ts ? $date_end_format : ''}}"
					autocomplete="off">
					<div class="field-group__trigger">
						<i class="fa-regular fa-calendar-days calendar-icon"></i>
						<input class="input-trigger" type="text" data-trigger="date_end" autocomplete="off">
					</div>
				</div>
			</div>
		</div>
		<div class="col-12">
			@include('claim.tourists.list_tourists')
		</div>
	</div>
</div>