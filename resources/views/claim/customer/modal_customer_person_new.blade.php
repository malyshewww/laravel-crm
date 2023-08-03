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
				<input class="field-group__input" type="text" data-name="surname" name="person_surname" autocomplete="off">
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="field-group__item">
			<label class="field-group__label required">Имя</label>
			<div class="field-group__box">
				<input class="field-group__input" type="text" data-name="name" name="person_name" autocomplete="off">
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="field-group__item">
			<label class="field-group__label">Отчество</label>
			<div class="field-group__box">
				<input class="field-group__input" type="text" name="person_patronymic" autocomplete="off">
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
				<input class="field-group__input" type="text" data-name="surname_lat" name="person_surname_lat" autocomplete="off">
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="field-group__item">
			<label class="field-group__label">Имя (LAT)</label>
			<div class="field-group__box">
				<input class="field-group__input" type="text" data-name="name_lat" name="person_name_lat" autocomplete="off">
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
				<input class="field-group__input" type="text" name="person_birthday" autocomplete="off">
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="field-group__item">
			<label class="field-group__label">Фактический адрес</label>
			<div class="field-group__box">
				<input class="field-group__input" type="text" name="person_address" autocomplete="off">
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="field-group__item">
			<label class="field-group__label">Телефон</label>
			<div class="field-group__box">
				<input class="field-group__input" type="tel" name="person_phone" autocomplete="off">
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="field-group__item">
			<label class="field-group__label">Email</label>
			<div class="field-group__box">
				<input class="field-group__input" type="email" name="person_email" autocomplete="off">
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
						<input class="field-group__input" type="number" name="person_passport_series" autocomplete="off">
					</div>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="field-group__item">
					<label class="field-group__label">Номер</label>
					<div class="field-group__box">
						<input class="field-group__input" type="number" name="person_passport_number" autocomplete="off">
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="field-group__item">
					<label class="field-group__label">Дата выдачи</label>
					<div class="field-group__box">
						<input class="field-group__input" type="text" name="person_passport_date" autocomplete="off">
					</div>
				</div>
			</div>
			<div class="col-sm-8">
				<div class="field-group__item">
					<label class="field-group__label">Кем выдан</label>
					<div class="field-group__box">
						<input class="field-group__input" type="text" name="person_passport_issued" autocomplete="off">
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="field-group__item">
					<label class="field-group__label">Код</label>
					<div class="field-group__box">
						<input class="field-group__input" type="text" name="person_passport_code" autocomplete="off">
					</div>
				</div>
			</div>
			<div class="col-sm-12">
				<div class="field-group__item">
					<label class="field-group__label">Адрес регистрации</label>
					<div class="field-group__box">
						<input class="field-group__input" type="text" name="person_passport_address" autocomplete="off">
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
						<input class="field-group__input" type="text" name="person_certificate_series" autocomplete="off">
					</div>
				</div>
			</div>
			<div class="col-sm-8">
				<div class="field-group__item">
					<label class="field-group__label">Номер</label>
					<div class="field-group__box">
						<input class="field-group__input" type="text" name="person_certificate_number" autocomplete="off">
					</div>
				</div>
			</div>
			<div class="col-sm-12">
				<div class="field-group__item">
					<label class="field-group__label">Дата выдачи</label>
					<div class="field-group__box">
						<input class="field-group__input" type="text" data-name="date" data-format="date" name="person_certificate_date" autocomplete="off">
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
						<input class="field-group__input" type="text" name="person_certificate_issued" autocomplete="off">
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
						<input class="field-group__input" type="text" name="person_international_passport_series" autocomplete="off">
					</div>
				</div>
			</div>
			<div class="col-sm-8">
				<div class="field-group__item">
					<label class="field-group__label">Номер</label>
					<div class="field-group__box">
						<input class="field-group__input" type="text" name="person_international_passport_number" autocomplete="off">
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="field-group__item">
					<label class="field-group__label">Дата выдачи</label>
					<div class="field-group__box">
						<input class="field-group__input" type="text" data-name="date" data-format="date" name="person_international_passport_date" autocomplete="off">
						<div class="field-group__trigger">
							<i class="fa-regular fa-calendar-days calendar-icon"></i>
							<input class="input-trigger" type="text" data-trigger="date"
							autocomplete="off">
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="field-group__item">
					<label class="field-group__label">Срок действия</label>
					<div class="field-group__box">
						<input class="field-group__input" type="text" data-name="date" data-format="date" name="person_international_passport_period"
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
						<input class="field-group__input" type="text" name="person_international_passport_issued" autocomplete="off">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>