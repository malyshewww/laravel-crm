<div class="row">
	<div class="col-12">
		<div class="checkbox">
			<label>
				<input class="checkbox__input" type="checkbox" data-trigger="translit" name="translit_customer">
				<span class="checkbox__label text-label">Включить транслитерацию по госту 2016</span>
			</label>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="field-group__item">
			<label class="field-group__label required">Фамилия</label>
			<div class="field-group__box">
				<input class="field-group__input" type="text" data-name="surname" name="person_surname"
				value="{{$person->person_surname ?: ''}}">
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="field-group__item">
			<label class="field-group__label required">Имя</label>
			<div class="field-group__box">
				<input class="field-group__input" type="text" data-name="name" name="person_name" 
				value="{{$person->person_name ?: ''}}">
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="field-group__item">
			<label class="field-group__label">Отчество</label>
			<div class="field-group__box">
				<input class="field-group__input" type="text" name="person_patronymic"
				value="{{$person->person_patronymic ?: ''}}">
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="field-group__item">
			<label class="field-group__label required">Пол</label>
			@php
				$genders = PersonHelper::gender();
			@endphp
			<select data-select name="person_gender">
				<option value=""></option>
				@foreach ($genders as $gender)
					<option
						{{$person->person_gender === $gender['value'] ? ' selected' : ''}}
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
				<input class="field-group__input" type="text" data-name="surname_lat" name="person_surname_lat"
				value="{{$person->person_surname_lat ?: ''}}">
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="field-group__item">
			<label class="field-group__label">Имя (LAT)</label>
			<div class="field-group__box">
				<input class="field-group__input" type="text" data-name="name_lat" name="person_name_lat"
				value="{{$person->person_name_lat ?: ''}}">
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="field-group__item">
			<label class="field-group__label required">Гражданство</label>
			<select data-select name="person_nationality">
				<option value="" selected></option>
				@php
					$nationalities = PersonHelper::nationality();
				@endphp
				@foreach ($nationalities as $nationality)
					<option
						{{$person->person_nationality === $nationality['value'] ? ' selected' : ''}}
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
				<input class="field-group__input" type="text" name="person_birthday"
				value="{{$person->person_birthday ?: ''}}">
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="field-group__item">
			<label class="field-group__label">Фактический адрес</label>
			<div class="field-group__box">
				<input class="field-group__input" type="text" name="person_address"
				value="{{$person->person_address ?: ''}}">
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="field-group__item">
			<label class="field-group__label">Телефон</label>
			<div class="field-group__box">
				<input class="field-group__input" type="tel" name="person_phone"
				value="+{{$person->person_phone ?: ''}}">
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="field-group__item">
			<label class="field-group__label">Email</label>
			<div class="field-group__box">
				<input class="field-group__input" type="email" name="person_email"
				value="{{$person->person_email ?: ''}}">
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
						<input class="field-group__input" type="number" name="person_passport_series"
						value="{{$person->person_passport_series ?: ''}}">
					</div>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="field-group__item">
					<label class="field-group__label">Номер</label>
					<div class="field-group__box">
						<input class="field-group__input" type="number" name="person_passport_number"
						value="{{$person->person_passport_number ?: ''}}">
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="field-group__item">
					<label class="field-group__label">Дата выдачи</label>
					<div class="field-group__box">
						<input class="field-group__input" type="text" name="person_passport_date"
						value="{{$person->person_passport_date ?: ''}}">
					</div>
				</div>
			</div>
			<div class="col-sm-8">
				<div class="field-group__item">
					<label class="field-group__label">Кем выдан</label>
					<div class="field-group__box">
						<input class="field-group__input" type="text" name="person_passport_issued"
						value="{{$person->person_passport_issued ?: ''}}">
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="field-group__item">
					<label class="field-group__label">Код</label>
					<div class="field-group__box">
						<input class="field-group__input" type="text" name="person_passport_code"
						value="{{$person->person_passport_code ?: ''}}">
					</div>
				</div>
			</div>
			<div class="col-sm-12">
				<div class="field-group__item">
					<label class="field-group__label">Адрес регистрации</label>
					<div class="field-group__box">
						<input class="field-group__input" type="text" name="person_passport_address"
						value="{{$person->person_passport_address ?: ''}}">
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
						<input class="field-group__input" type="text" name="person_certificate_series"
						value="{{$person->person_certificate_series ?: ''}}">
					</div>
				</div>
			</div>
			<div class="col-sm-8">
				<div class="field-group__item">
					<label class="field-group__label">Номер</label>
					<div class="field-group__box">
						<input class="field-group__input" type="text" name="person_certificate_number"
						value="{{$person->person_certificate_number ?: ''}}">
					</div>
				</div>
			</div>
			<div class="col-sm-12">
				<div class="field-group__item">
					<label class="field-group__label">Дата выдачи</label>
					<div class="field-group__box">
						<input class="field-group__input" type="text" data-name="date" data-format="date" name="person_certificate_date"
						value="{{$person->person_certificate_date
						? $person->person_certificate_date->format('Y-m-d') 
						: ''}}">
						<div class="field-group__trigger">
							<i class="fa-regular fa-calendar-days calendar-icon"></i>
							<input class="input-trigger" type="text" data-trigger="date">
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12">
				<div class="field-group__item">
					<label class="field-group__label">Кем выдан</label>
					<div class="field-group__box">
						<input class="field-group__input" type="text" name="person_certificate_issued"
						value="{{$person->person_certificate_issued ?: ''}}">
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
						<input class="field-group__input" type="text" name="person_international_passport_series"
						value="{{$person->person_international_passport_series ?: ''}}">
					</div>
				</div>
			</div>
			<div class="col-sm-8">
				<div class="field-group__item">
					<label class="field-group__label">Номер</label>
					<div class="field-group__box">
						<input class="field-group__input" type="text" name="person_international_passport_number"
						value="{{$person->person_international_passport_number ?: ''}}">
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="field-group__item">
					<label class="field-group__label">Дата выдачи</label>
					<div class="field-group__box">
						<input class="field-group__input" type="text" data-name="date" data-format="date" name="person_international_passport_date"
							value="{{$person->person_international_passport_date
							? $person->person_international_passport_date->format('Y-m-d') : ''}}">
						<div class="field-group__trigger">
							<i class="fa-regular fa-calendar-days calendar-icon"></i>
							<input class="input-trigger" type="text" data-trigger="date"
							>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="field-group__item">
					<label class="field-group__label">Срок действия</label>
					<div class="field-group__box">
						<input class="field-group__input" type="text" data-name="date" data-format="date" name="person_international_passport_period"
						value="{{$person->person_international_passport_period
							? $person->person_international_passport_period->format('Y-m-d') : ''}}">
						<div class="field-group__trigger">
							<i class="fa-regular fa-calendar-days calendar-icon"></i>
							<input class="input-trigger" type="text" data-trigger="date">
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12">
				<div class="field-group__item">
					<label class="field-group__label">Кем выдан</label>
					<div class="field-group__box">
						<input class="field-group__input" type="text" name="person_international_passport_issued"
						value="{{$person->person_international_passport_issued ?: ''}}">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>