<div class="row-wrapper">
	<div class="field-group">
		<div class="row">
			<div class="col-12">
				<div class="checkbox">
					<label>
						<input class="checkbox__input" type="checkbox" data-trigger="translit" name="translit_tourist">
						<span class="checkbox__label">
							Включить транслитерацию по госту 2016
						</span>
					</label>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="field-group__item">
					<label class="field-group__label required">Фамилия</label>
					<div class="field-group__box">
						<input class="field-group__input" type="text" data-name="surname" name="tourist_surname"
						value="{{$tourist->tourist_surname ?: ''}}" autocomplete="off">
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="field-group__item">
					<label class="field-group__label required">Имя</label>
					<div class="field-group__box">
						<input class="field-group__input" type="text" data-name="name" name="tourist_name"
						value="{{$tourist->tourist_name ?: ''}}" autocomplete="off">
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="field-group__item">
					<label class="field-group__label">Отчество</label>
					<div class="field-group__box">
						<input class="field-group__input" type="text" name="tourist_patronymic"
						value="{{$tourist->tourist_patronymic ?: ''}}" autocomplete="off">
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="field-group__item">
					<label class="field-group__label required">Пол</label>
					<select data-select name="tourist_gender">
						<option value=""></option>
							@php
								$genders = TouristHelper::gender();
							@endphp
							@foreach ($genders as $gender)
								<option
									{{$tourist->common && $tourist->common->tourist_gender === $gender['value'] ? ' selected' : ''}}
									value="{{$gender['value']}}">
									{{$gender['title']}}
								</option>
							@endforeach
					</select>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="field-group__item">
					<label class="field-group__label">Фамилия (LAT)</label>
					<div class="field-group__box">
						<input class="field-group__input" type="text" data-name="surname_lat" name="tourist_surname_lat"
						value="{{$tourist->common && $tourist->common->tourist_surname_lat ? $tourist->common->tourist_surname_lat : ''}}" autocomplete="off">
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="field-group__item">
					<label class="field-group__label">Имя (LAT)</label>
					<div class="field-group__box">
						<input class="field-group__input" type="text" data-name="name_lat" name="tourist_name_lat"
						value="{{$tourist->common && $tourist->common->tourist_name_lat ? $tourist->common->tourist_name_lat : ''}}" autocomplete="off">
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="field-group__item">
					<label class="field-group__label required">Гражданство</label>
					<select data-select name="tourist_nationality">
						<option value="" selected></option>
						@php
							$nationalities = TouristHelper::nationality();
						@endphp
						@foreach ($nationalities as $nationality)
							<option
								{{$tourist->common && $tourist->common->tourist_nationality === $nationality['value'] ? ' selected' : ''}}
								value="{{$nationality['value']}}">{{$nationality['title']}}
							</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="field-group__item">
					<label class="field-group__label required">Дата рождения</label>
					<div class="field-group__box">
						<input class="field-group__input" type="text" name="tourist_birthday"
						value="{{$tourist->common && $tourist->common->tourist_birthday ? $tourist->common->tourist_birthday : ''}}"
						autocomplete="off">
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="field-group__item">
					<label class="field-group__label">Фактический адрес</label>
					<div class="field-group__box">
						<input class="field-group__input" type="text" name="tourist_address"
						value="{{$tourist->common && $tourist->common->tourist_address ? $tourist->common->tourist_address : ''}}"
						autocomplete="off">
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="field-group__item">
					<label class="field-group__label">Телефон</label>
					<div class="field-group__box">
						<input class="field-group__input" type="tel" name="tourist_phone"
						value="{{$tourist->common && $tourist->common->tourist_phone ? $tourist->common->tourist_phone : ''}}"
						autocomplete="off">
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="field-group__item">
					<label class="field-group__label">Email</label>
					<div class="field-group__box">
						<input class="field-group__input" type="email" name="tourist_email"
						value="{{$tourist->common && $tourist->common->tourist_email ? $tourist->common->tourist_email : ''}}"
						autocomplete="off">
					</div>
				</div>
			</div>
		</div>
		<hr>
		<div class="row"> 
			<div class="col-lg-4">
				<div class="text-label text-center mb-2">Национальный паспорт</div>
				<div class="row"> 
					<div class="col-sm-3">
						<div class="field-group__item">
							<label class="field-group__label">Серия</label>
							<div class="field-group__box">
								<input class="field-group__input" type="number" name="tourist_passport_series"
								value="{{$tourist->passport && $tourist->passport->tourist_passport_series ? $tourist->passport->tourist_passport_series : ''}}"
								autocomplete="off">
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="field-group__item">
							<label class="field-group__label">Номер</label>
							<div class="field-group__box">
								<input class="field-group__input" type="number" name="tourist_passport_number"
								value="{{$tourist->passport && $tourist->passport->tourist_passport_number ? $tourist->passport->tourist_passport_number : ''}}"
								autocomplete="off">
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="field-group__item">
							<label class="field-group__label">Дата выдачи</label>
							<div class="field-group__box">
								<input class="field-group__input" type="text" name="tourist_passport_date"
								value="{{$tourist->passport && $tourist->passport->tourist_passport_date ? $tourist->passport->tourist_passport_date : ''}}"
								autocomplete="off">
							</div>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="field-group__item">
							<label class="field-group__label">Кем выдан</label>
							<div class="field-group__box">
								<input class="field-group__input" type="text" name="tourist_passport_issued"
								value="{{$tourist->passport && $tourist->passport->tourist_passport_issued ? $tourist->passport->tourist_passport_issued : ''}}"
								autocomplete="off">
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="field-group__item">
							<label class="field-group__label">Код</label>
							<div class="field-group__box">
								<input class="field-group__input" type="text" name="tourist_passport_code"
								value="{{$tourist->passport && $tourist->passport->tourist_passport_code ? $tourist->passport->tourist_passport_code : ''}}"
								autocomplete="off">
							</div>
						</div>
					</div>
					<div class="col-12">
						<div class="field-group__item">
							<label class="field-group__label">Адрес регистрации</label>
							<div class="field-group__box">
								<input class="field-group__input" type="text" name="tourist_passport_address"
								value="{{$tourist->passport && $tourist->passport->tourist_passport_address ? $tourist->passport->tourist_passport_address : ''}}"
								autocomplete="off">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="text-label text-center mb-2">Свидетельство о рождении</div>
				<div class="row"> 
					<div class="col-sm-4">
						<div class="field-group__item">
							<label class="field-group__label">Серия</label>
							<div class="field-group__box">
								<input class="field-group__input" type="text" name="tourist_certificate_series"
								value="{{$tourist->certificate && $tourist->certificate->tourist_certificate_series ? $tourist->certificate->tourist_certificate_series : ''}}"
								autocomplete="off">
							</div>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="field-group__item">
							<label class="field-group__label">Номер</label>
							<div class="field-group__box">
								<input class="field-group__input" type="text" name="tourist_certificate_number"
								value="{{$tourist->certificate && $tourist->certificate->tourist_certificate_number ? $tourist->certificate->tourist_certificate_number : ''}}"
								autocomplete="off">
							</div>
						</div>
					</div>
					<div class="col-12">
						<div class="field-group__item">
							<label class="field-group__label">Дата выдачи</label>
							<div class="field-group__box">
								<input class="field-group__input" type="text" data-name="date" data-format="date" name="tourist_certificate_date"
								value="{{$tourist->certificate && $tourist->certificate->tourist_certificate_date ? $tourist->certificate->tourist_certificate_date->format('Y-m-d') : ''}}"
								autocomplete="off">
								<div class="field-group__trigger">
									<i class="fa-regular fa-calendar-days calendar-icon"></i>
									<input class="input-trigger" type="text" data-trigger="date" autocomplete="off">
								</div>
							</div>
						</div>
					</div>
					<div class="col-12">
						<div class="field-group__item">
							<label class="field-group__label">Кем выдан</label>
							<div class="field-group__box">
								<input class="field-group__input" type="text" name="tourist_certificate_issued"
								value="{{$tourist->certificate && $tourist->certificate->tourist_certificate_issued ? $tourist->certificate->tourist_certificate_issued : ''}}"
								autocomplete="off">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="text-label text-center mb-2">Заграничный паспорт</div>
				<div class="row"> 
					<div class="col-sm-4">
						<div class="field-group__item">
							<label class="field-group__label">Серия</label>
							<div class="field-group__box">
								<input class="field-group__input" type="text" name="tourist_international_passport_series"
								value="{{$tourist->internationalPassport && $tourist->internationalPassport->tourist_international_passport_series
									? $tourist->internationalPassport->tourist_international_passport_series : ''}}"
									autocomplete="off">
							</div>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="field-group__item">
							<label class="field-group__label">Номер</label>
							<div class="field-group__box">
								<input class="field-group__input" type="text" name="tourist_international_passport_number"
								value="{{$tourist->internationalPassport && $tourist->internationalPassport->tourist_international_passport_number
									? $tourist->internationalPassport->tourist_international_passport_number : ''}}"
									autocomplete="off">
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="field-group__item">
							<label class="field-group__label">Дата выдачи</label>
							<div class="field-group__box">
								<input class="field-group__input" type="text" data-name="date" data-format="date" name="tourist_international_passport_date"
								value="{{$tourist->internationalPassport && $tourist->internationalPassport->tourist_international_passport_date
									? $tourist->internationalPassport->tourist_international_passport_date->format('Y-m-d') : ''}}" autocomplete="off">
								<div class="field-group__trigger">
									<i class="fa-regular fa-calendar-days calendar-icon"></i>
									<input class="input-trigger" type="text" data-trigger="date" autocomplete="off">
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="field-group__item">
							<label class="field-group__label">Срок действия</label>
							<div class="field-group__box">
								<input class="field-group__input" type="text" data-name="date" data-format="date" name="tourist_international_passport_period"
								value="{{$tourist->internationalPassport && $tourist->internationalPassport->tourist_international_passport_period
									? $tourist->internationalPassport->tourist_international_passport_period->format('Y-m-d') : ''}}" autocomplete="off">
								<div class="field-group__trigger">
									<i class="fa-regular fa-calendar-days calendar-icon"></i>
									<input class="input-trigger" type="text" data-trigger="date" autocomplete="off">
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="field-group__item">
							<label class="field-group__label">Кем выдан</label>
							<div class="field-group__box">
								<input class="field-group__input" type="text" name="tourist_international_passport_issued"
								value="{{$tourist->internationalPassport && $tourist->internationalPassport->tourist_international_passport_issued
									? $tourist->internationalPassport->tourist_international_passport_issued : ''}}" autocomplete="off">
							</div>
						</div>
						<div class="text-label mt-2">Пример: UFMS-12</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row"> 
			<div class="col-lg-4">
				<div class="text-label mb-2">Информация и визе</div>
				<div class="select-items">
					<div class="field-group__item">
						<label class="field-group__label required">Необходимость визы</label>
						<select data-select  name="visa_info" id="visaInfo">
							<option value=""></option>
							@php
								$visaOptions = TouristHelper::visa();
							@endphp
							@foreach ($visaOptions as $visaOpt)
								<option
									{{$tourist->common && $tourist->common->visa_info === $visaOpt['value'] ? ' selected' : ''}}
									value="{{$visaOpt['value']}}">{{$visaOpt['title']}}
								</option>
							@endforeach
						</select>
					</div>
					<div class="field-group__item">
						<label class="field-group__label">Город подачи визы</label>
						<select name="visa_city" data-select 
							{{$tourist->common && $tourist->common->visa_info === 'not' ? ' disabled' : ''}}>
							<option value=""></option>
							@php
								$cities = TouristHelper::city();
							@endphp
							@foreach ($cities as $key => $city)
								<option
									{{$tourist->common 
									&& $tourist->common->visa_info == 'yes' 
									&& $tourist->common->visa_city 
									&& $key == $tourist->common->visa_city 
									? ' selected' 
									: ''}}
									value="{{$key}}">{{$city['name']}}
								</option>
							@endforeach
						</select>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
