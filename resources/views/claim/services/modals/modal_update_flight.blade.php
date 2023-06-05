<input type="hidden" name="type" value="flights">
<input type="hidden" name="record_id" value="{{$flight->id}}">
<div class="field-group">
	<div class="row">	
		<div class="col-12">
			<div class="field-group__item">
				<label class="field-group__label">Маршрут</label>
				<div class="field-group__box">
					<input class="field-group__input" type="text" name="flight_route"
					value="{{$flight->flight_route ?: ''}}">
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="field-group__item">
				<label class="field-group__label">Откуда</label>
				<div class="field-group__box">
					<input class="field-group__input" type="text" name="flight_start"
					value="{{$flight->flight_start ?: ''}}">
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="field-group__item">
				<label class="field-group__label">Куда</label>
				<div class="field-group__box">
					<input class="field-group__input" type="text" name="flight_end"
					value="{{$flight->flight_end ?: ''}}">
				</div>
			</div>
		</div>
		<div class="col-lg-2">
			<div class="field-group__item">
				<label class="field-group__label">Авиакомпания</label>
				<div class="field-group__box">
					<input class="field-group__input" type="text" name="flight_aviacompany"
					value="{{$flight->flight_aviacompany ?: ''}}">
				</div>
			</div>
		</div>
		<div class="col-lg-2">
			<div class="field-group__item">
				<label class="field-group__label">Класс</label>
				<select data-select name="flight_class">
					<option value=""></option>
						@php
							$flightClasses = ServiceHelper::flightClass();
						@endphp
						@foreach ($flightClasses as $class)
							<option
								{{$class['value'] === $flight->flight_class ? ' selected' : ''}}
								value="{{$class['value']}}">
								{{$class['title']}}
							</option>
						@endforeach
					</select>
				</select>
			</div>
		</div>
		<div class="col-lg-2">
			<div class="field-group__item">
				<label class="field-group__label">Номер рейса</label>
				<div class="field-group__box">
					<input class="field-group__input" type="text" name="flight_number"
					value="{{$flight->flight_number ?: ''}}">
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="field-group__item">
				<label class="field-group__label">Время вылета</label>
				<div class="field-group__box">
					<input class="field-group__input" type="text" 
					data-name="date_start" data-format="datetime"
					name="dateflight_start"
					value="{{$flight->dateflight_start ? $flight->dateflight_start->format('Y-m-d H:i') : ''}}">
					<div class="field-group__trigger">
						<i class="fa-regular fa-calendar-days calendar-icon"></i>
						<input class="input-trigger" type="text" data-trigger="date_start">
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="field-group__item">
				<label class="field-group__label">Время прилета</label>
				<div class="field-group__box">
					<input class="field-group__input" type="text" 
					data-name="date_end" data-format="datetime"
					name="dateflight_end"
					value="{{$flight->dateflight_end ? $flight->dateflight_end->format('Y-m-d H:i') : ''}}">
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