<div class="field-group">
	<div class="row">
		<div class="col-12">
			<div class="field-group__item">
				<label class="field-group__label">Заказчик</label>
				<select data-select name="type" id="personsSelect">
					<option value=""></option>
					@php
						$customers = CustomerHelper::customer();
					@endphp
					@foreach ($customers as $customer)
						<option
							{{$claim->customer && $claim->customer->type === $customer['type'] ? ' selected' : ''}}
							value="{{$customer['type']}}">{{$customer['title']}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div id="tabContentModal">
			<div class="tabs-content{{$claim->customer && $claim->customer->type === 'person' ? ' isOpen' : ''}}" id="person" data-update-box data-tab-content="person">
				@include('components.search_block', ['type' => 'person', 'label' => 'Список физ.лиц', 'placeholder' => 'Начните вводить фамилию'])
				<div class="row-wrapper">
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
									value="{{$claim->person ? $claim->person->person_surname : ''}}" autocomplete="off">
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-6">
							<div class="field-group__item">
								<label class="field-group__label required">Имя</label>
								<div class="field-group__box">
									<input class="field-group__input" type="text" data-name="name" name="person_name" 
									value="{{$claim->person ? $claim->person->person_name : ''}}" autocomplete="off">
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-6">
							<div class="field-group__item">
								<label class="field-group__label">Отчество</label>
								<div class="field-group__box">
									<input class="field-group__input" type="text" name="person_patronymic"
									value="{{$claim->person ? $claim->person->person_patronymic : ''}}" autocomplete="off">
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
											{{$claim->person
											&& $claim->person->person_gender === $gender['value'] ? ' selected' : ''}}
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
									value="{{$claim->person ? $claim->person->person_surname_lat : ''}}"
									autocomplete="off">
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-6">
							<div class="field-group__item">
								<label class="field-group__label">Имя (LAT)</label>
								<div class="field-group__box">
									<input class="field-group__input" type="text" data-name="name_lat" name="person_name_lat"
									value="{{$claim->person ? $claim->person->person_name_lat : ''}}"
									autocomplete="off">
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
											{{$claim->person
											&& $claim->person->person_nationality === $nationality['value'] ? ' selected' : ''}}
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
									value="{{$claim->person ? $claim->person->person_birthday : ''}}"
									autocomplete="off">
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-6">
							<div class="field-group__item">
								<label class="field-group__label">Фактический адрес</label>
								<div class="field-group__box">
									<input class="field-group__input" type="text" name="person_address"
									value="{{$claim->person ? $claim->person->person_address : ''}}"
									autocomplete="off">
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-6">
							<div class="field-group__item">
								<label class="field-group__label">Телефон</label>
								<div class="field-group__box">
									<input class="field-group__input" type="tel" name="person_phone"
									value="+{{$claim->person ? $claim->person->person_phone : ''}}"
									autocomplete="off">
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-6">
							<div class="field-group__item">
								<label class="field-group__label">Email</label>
								<div class="field-group__box">
									<input class="field-group__input" type="email" name="person_email"
									value="{{$claim->person ? $claim->person->person_email : ''}}"
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
											<input class="field-group__input" type="number" name="person_passport_series"
											value="{{$claim->person ? $claim->person->person_passport_series : ''}}"
											autocomplete="off">
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="field-group__item">
										<label class="field-group__label">Номер</label>
										<div class="field-group__box">
											<input class="field-group__input" type="number" name="person_passport_number"
											value="{{$claim->person ? $claim->person->person_passport_number : ''}}"
											autocomplete="off">
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="field-group__item">
										<label class="field-group__label">Дата выдачи</label>
										<div class="field-group__box">
											<input class="field-group__input" type="text" name="person_passport_date"
											value="{{$claim->person ? $claim->person->person_passport_date : ''}}"
											autocomplete="off">
										</div>
									</div>
								</div>
								<div class="col-sm-8">
									<div class="field-group__item">
										<label class="field-group__label">Кем выдан</label>
										<div class="field-group__box">
											<input class="field-group__input" type="text" name="person_passport_issued"
											value="{{$claim->person ? $claim->person->person_passport_issued : ''}}"
											autocomplete="off">
										</div>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="field-group__item">
										<label class="field-group__label">Код</label>
										<div class="field-group__box">
											<input class="field-group__input" type="text" name="person_passport_code"
											value="{{$claim->person ? $claim->person->person_passport_code : ''}}"
											autocomplete="off">
										</div>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="field-group__item">
										<label class="field-group__label">Адрес регистрации</label>
										<div class="field-group__box">
											<input class="field-group__input" type="text" name="person_passport_address"
											value="{{$claim->person ? $claim->person->person_passport_address : ''}}"
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
											<input class="field-group__input" type="text" name="person_certificate_series"
											value="{{$claim->person ? $claim->person->person_certificate_series : ''}}"
											autocomplete="off">
										</div>
									</div>
								</div>
								<div class="col-sm-8">
									<div class="field-group__item">
										<label class="field-group__label">Номер</label>
										<div class="field-group__box">
											<input class="field-group__input" type="text" name="person_certificate_number"
											value="{{$claim->person ? $claim->person->person_certificate_number : ''}}"
											autocomplete="off">
										</div>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="field-group__item">
										<label class="field-group__label">Дата выдачи</label>
										<div class="field-group__box">
											<input class="field-group__input" type="text" data-name="date" data-format="date" name="person_certificate_date"
											value="{{$claim->person && $claim->person->person_certificate_date
											? $claim->person->person_certificate_date->format('Y-m-d') 
											: ''}}"
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
											<input class="field-group__input" type="text" name="person_certificate_issued"
											value="{{$claim->person ? $claim->person->person_certificate_issued : ''}}"
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
											<input class="field-group__input" type="text" name="person_international_passport_series"
											value="{{$claim->person ? $claim->person->person_international_passport_series : ''}}"
											autocomplete="off">
										</div>
									</div>
								</div>
								<div class="col-sm-8">
									<div class="field-group__item">
										<label class="field-group__label">Номер</label>
										<div class="field-group__box">
											<input class="field-group__input" type="text" name="person_international_passport_number"
											value="{{$claim->person ? $claim->person->person_international_passport_number : ''}}"
											autocomplete="off">
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="field-group__item">
										<label class="field-group__label">Дата выдачи</label>
										<div class="field-group__box">
											<input class="field-group__input" type="text" data-name="date" data-format="date" name="person_international_passport_date"
												value="{{$claim->person && $claim->person->person_international_passport_date
												? $claim->person->person_international_passport_date->format('Y-m-d') : ''}}"
												autocomplete="off">
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
											value="{{$claim->person && $claim->person->person_international_passport_period
												? $claim->person->person_international_passport_period->format('Y-m-d') : ''}}"
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
											<input class="field-group__input" type="text" name="person_international_passport_issued"
											value="{{$claim->person ? $claim->person->person_international_passport_issued : ''}}"
											autocomplete="off">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="tabs-content{{$claim->customer && $claim->customer->type === 'company' ? ' isOpen' : ''}}" id="company" data-update-box data-tab-content="company">
				@include('components.search_block', ['type' => 'company', 'label' => 'Список юр.лиц', 'placeholder' => 'Начните ввод'])
				<div class="row-wrapper">
					<div class="row align-items-end">
						<div class="col-lg-3 col-md-6">
							<div class="field-group__item">
								<label class="field-group__label">Наименование банка</label>
								<div class="field-group__box">
									<input class="field-group__input" type="text" name="company_bank"
									value="{{$claim->company ? $claim->company->company_bank : ''}}"
									autocomplete="off">
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-6">
							<div class="field-group__item">
								<label class="field-group__label">Бик</label>
								<div class="field-group__box">
									<input class="field-group__input" type="text" name="company_bik"
									value="{{$claim->company ? $claim->company->company_bik : ''}}"
									autocomplete="off">
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-6">
							<div class="field-group__item">
								<label class="field-group__label">Р/с</label>
								<div class="field-group__box">
									<input class="field-group__input" type="text" name="company_rs"
									value="{{$claim->company ? $claim->company->company_rs : ''}}"
									autocomplete="off">
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-6">
							<div class="field-group__item">
								<label class="field-group__label">К/с</label>
								<div class="field-group__box">
									<input class="field-group__input" type="text" name="company_ks"
									value="{{$claim->company ? $claim->company->company_ks : ''}}"
									autocomplete="off">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="field-group__item">
								<label class="field-group__label">Полное наименование юр.лица</label>
								<div class="field-group__box">
									<input class="field-group__input" type="text" name="company_fullname"
									value="{{$claim->company ? $claim->company->company_fullname : ''}}"
									autocomplete="off">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="field-group__item">
								<label class="field-group__label">Сокращенное наименование юр.лица</label>
								<div class="field-group__box">
									<input class="field-group__input" type="text" name="company_shortname"
									value="{{$claim->company ? $claim->company->company_shortname : ''}}"
									autocomplete="off">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="field-group__item">
								<label class="field-group__label">Юридический адрес</label>
								<div class="field-group__box">
									<input class="field-group__input" type="text" name="company_address"
									value="{{$claim->company ? $claim->company->company_address : ''}}"
									autocomplete="off">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="field-group__item">
								<label class="field-group__label">Фактический адрес</label>
								<div class="field-group__box">
									<input class="field-group__input" type="text" name="company_actual_address"
									value="{{$claim->company ? $claim->company->company_actual_address : ''}}"
									autocomplete="off">
								</div>
							</div>
						</div>
					</div>
					<hr>
					<div class="row"> 
						<div class="col-lg-4">
							<div class="field-group__item">
								<label class="field-group__label">КПП</label>
								<div class="field-group__box">
									<input class="field-group__input" type="text" name="company_kpp"
									value="{{$claim->company ? $claim->company->company_kpp : ''}}"
									autocomplete="off">
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="field-group__item">
								<label class="field-group__label">ИНН</label>
								<div class="field-group__box">
									<input class="field-group__input" type="text" name="company_inn"
									value="{{$claim->company ? $claim->company->company_inn : ''}}"
									autocomplete="off">
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="field-group__item">
								<label class="field-group__label">ОГРН</label>
								<div class="field-group__box">
									<input class="field-group__input" type="text" name="company_ogrn"
									value="{{$claim->company ? $claim->company->company_ogrn : ''}}"
									autocomplete="off">
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="field-group__item">
								<label class="field-group__label">Фио директора</label>
								<div class="field-group__box">
									<input class="field-group__input" type="text" name="company_director"
									value="{{$claim->company ? $claim->company->company_director : ''}}"
									autocomplete="off">
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="field-group__item">
								<label class="field-group__label">Телефон</label>
								<div class="field-group__box">
									<input class="field-group__input" type="tel" name="company_phone"
									value="{{$claim->company ? $claim->company->company_phone : ''}}"
									autocomplete="off">
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="field-group__item">
								<label class="field-group__label">E-mail</label>
								<div class="field-group__box">
									<input class="field-group__input" type="email" name="company_email"
									value="{{$claim->company ? $claim->company->company_email : ''}}"
									autocomplete="off">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
