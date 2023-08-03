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
					<input class="field-group__input" type="text" data-name="surname" name="tourist_surname" autocomplete="off">
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6">
			<div class="field-group__item">
				<label class="field-group__label required">Имя</label>
				<div class="field-group__box">
					<input class="field-group__input" type="text" data-name="name" name="tourist_name" autocomplete="off">
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6">
			<div class="field-group__item">
				<label class="field-group__label">Отчество</label>
				<div class="field-group__box">
					<input class="field-group__input" type="text" name="tourist_patronymic" autocomplete="off">
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6">
			<div class="field-group__item">
				<label class="field-group__label required">Пол</label>
				<select data-select name="tourist_gender" id="selectTouristGender">
					<option value="">{{old('tourist_gender')}}</option>
						@php
							$genders = TouristHelper::gender();
						@endphp
						@foreach ($genders as $gender)
							<option
								{{old('tourist_gender') == $gender['value'] ? ' selected' : ''}}
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
					<input class="field-group__input" type="text" data-name="surname_lat" name="tourist_surname_lat" autocomplete="off">
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6">
			<div class="field-group__item">
				<label class="field-group__label">Имя (LAT)</label>
				<div class="field-group__box">
					<input class="field-group__input" type="text" data-name="name_lat" name="tourist_name_lat" autocomplete="off">
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6">
			<div class="field-group__item">
				<label class="field-group__label required">Гражданство</label>
				<select data-select name="tourist_nationality" id="selectTouristNationality">
					<option value="" selected></option>
					@php
						$nationalities = TouristHelper::nationality();
					@endphp
					@foreach ($nationalities as $nationality)
						<option
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
					<input class="field-group__input" type="text" name="tourist_birthday" autocomplete="off">
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6">
			<div class="field-group__item">
				<label class="field-group__label">Фактический адрес</label>
				<div class="field-group__box">
					<input class="field-group__input" type="text" name="tourist_address" autocomplete="off">
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6">
			<div class="field-group__item">
				<label class="field-group__label">Телефон</label>
				<div class="field-group__box">
					<input class="field-group__input" type="tel" name="tourist_phone" autocomplete="off">
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6">
			<div class="field-group__item">
				<label class="field-group__label">Email</label>
				<div class="field-group__box">
					<input class="field-group__input" type="email" name="tourist_email" autocomplete="off">
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
							<input class="field-group__input" type="number" name="tourist_passport_series" autocomplete="off">
						</div>
						</div>
				</div>
				<div class="col-sm-3">
						<div class="field-group__item">
						<label class="field-group__label">Номер</label>
						<div class="field-group__box">
							<input class="field-group__input" type="number" name="tourist_passport_number" autocomplete="off">
						</div>
						</div>
				</div>
				<div class="col-sm-6">
					<div class="field-group__item">
						<label class="field-group__label">Дата выдачи</label>
						<div class="field-group__box">
							<input class="field-group__input" type="text" name="tourist_passport_date" autocomplete="off">
						</div>
					</div>
				</div>
				<div class="col-sm-8">
					<div class="field-group__item">
						<label class="field-group__label">Кем выдан</label>
						<div class="field-group__box">
							<input class="field-group__input" type="text" name="tourist_passport_issued" autocomplete="off">
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="field-group__item">
						<label class="field-group__label">Код</label>
						<div class="field-group__box">
							<input class="field-group__input" type="text" name="tourist_passport_code" autocomplete="off">
						</div>
					</div>
				</div>
				<div class="col-12">
					<div class="field-group__item">
						<label class="field-group__label">Адрес регистрации</label>
						<div class="field-group__box">
							<input class="field-group__input" type="text" name="tourist_passport_address" autocomplete="off">
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
							<input class="field-group__input" type="text" name="tourist_certificate_series" autocomplete="off">
						</div>
					</div>
				</div>
				<div class="col-sm-8">
					<div class="field-group__item">
						<label class="field-group__label">Номер</label>
						<div class="field-group__box">
							<input class="field-group__input" type="text" name="tourist_certificate_number" autocomplete="off">
						</div>
					</div>
				</div>
				<div class="col-12">
					<div class="field-group__item">
						<label class="field-group__label">Дата выдачи</label>
						<div class="field-group__box">
							<input class="field-group__input" type="text" data-name="date" data-format="date" name="tourist_certificate_date" autocomplete="off">
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
							<input class="field-group__input" type="text" name="tourist_certificate_issued" autocomplete="off">
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
							<input class="field-group__input" type="text" name="tourist_international_passport_series" autocomplete="off">
						</div>
					</div>
				</div>
				<div class="col-sm-8">
					<div class="field-group__item">
						<label class="field-group__label">Номер</label>
						<div class="field-group__box">
							<input class="field-group__input" type="text" name="tourist_international_passport_number" autocomplete="off">
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="field-group__item">
						<label class="field-group__label">Дата выдачи</label>
						<div class="field-group__box">
							<input class="field-group__input" type="text" data-name="date" data-format="date" name="tourist_international_passport_date"
							autocomplete="off">
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
							autocomplete="off">
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
							<input class="field-group__input" type="text" name="tourist_international_passport_issued" autocomplete="off">
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
					<select data-select data-name="visaInfo" name="visa_info" id="visaInfo">
						<option value="" selected></option>
						@php
							$visaOptions = TouristHelper::visa();
						@endphp
						@foreach ($visaOptions as $visaOpt)
							<option
								value="{{$visaOpt['value']}}">{{$visaOpt['title']}}
							</option>
						@endforeach
					</select>
				</div>
				<div class="field-group__item">
					<label class="field-group__label">Город подачи визы</label>
					<select name="visa_city" data-name="visaCity" data-select id="selectVisaCity">
						<option value="" selected></option>
						@php
							$cities = TouristHelper::city();
						@endphp
						@foreach ($cities as $key => $city)
							<option
								value="{{$key}}">{{$city['name']}}
							</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
	</div>
</div>