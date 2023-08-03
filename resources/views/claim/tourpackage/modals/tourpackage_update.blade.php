<div class="field-group">
	<div class="row">
		<div class="col-lg-6">
			<div class="field-group__item">
				<label class="field-group__label">Название</label>
				<div class="field-group__box">
					<input class="field-group__input" type="text" name="name" value="{{$tourpackage ? $tourpackage->name : ''}}" autocomplete="off">
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="field-group__item">
				<label class="field-group__label">Начало</label>
				<div class="field-group__box">
					<input class="field-group__input" type="text" data-name="date_start" data-format="date" name="date_start" 
					value="{{$claim->date_start->format('Y-m-d')}}" autocomplete="off">
					<div class="field-group__trigger"><i class="fa-regular fa-calendar-days calendar-icon"></i>
						<input class="input-trigger" type="text" data-trigger="date_start">
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="field-group__item">
				<label class="field-group__label">Окончание</label>
				<div class="field-group__box">
					<input class="field-group__input" type="text" data-name="date_end" data-format="date" name="date_end" 
					value="{{$claim->date_end->format('Y-m-d')}}" autocomplete="off">
					<div class="field-group__trigger">
						<i class="fa-regular fa-calendar-days calendar-icon"></i>
						<input class="input-trigger" type="text" data-trigger="date_end">
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="field-group__item">
				<label class="field-group__label">Город вылета</label>
				<select name="city_id" data-select>
					<option value=""></option>
					@php
						$cities = TourPackageHelper::city();
					@endphp
					@foreach ($cities as $key => $city)
						<option
							{{$tourpackage && $key === $tourpackage->city_id ? ' selected' : ''}}
							value="{{$key}}">
							{{$city['name']}}
						</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="field-group__item">
				<label class="field-group__label">Страна прилета</label>
				<select name="country_id" data-select>
					<option value=""></option>
					@php
						$countries = TourPackageHelper::country();
					@endphp
					@foreach ($countries as $key => $country)
						<option
							{{$tourpackage && $key === $tourpackage->country_id ? ' selected' : ''}}
							value="{{$key}}">
							{{$country['name']}}
						</option>
					@endforeach
				</select>
			</div>
		</div>
	</div>
</div>