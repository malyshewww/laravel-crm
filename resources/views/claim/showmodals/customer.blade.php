<div class="modal fade modal-extended" id="addCustomer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content modal__content">
			<div class="modal__header">
				<div class="modal__title">Заказчик</div>
				<button class="modal__close" type="button" data-bs-dismiss="modal" aria-label="Close">
					<i class="fa-solid fa-xmark"></i>
				</button>
			</div>
			<form action="{{route('customer.store', $claim->id)}}" method="post" id="formCustomer" class="form">
				@csrf
				<input type="hidden" name="claim_id" value="{{$claim->id}}">
				<input type="hidden" name="person_id" value="{{$claim->id}}">
				<input type="hidden" name="customer_id" value="{{$claim->id}}">
				<input type="hidden" name="company_id" value="{{$claim->id}}">
				<div class="modal__body">
					<div class="field-group">
						<div class="row">
							<div class="col-12">
								<div class="field-group__item">
									<label class="field-group__label">Заказчик</label>
									<select class="select-choices" name="type" id="personsSelect">
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
								<div class="tabs-content{{$claim->customer && $claim->customer->type === 'person' ? ' isOpen' : ''}}" id="person" data-tab-content="person">
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
													value="{{$claim->customer && $claim->customer->person ? $claim->customer->person->person_surname : ''}}">
												</div>
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="field-group__item">
												<label class="field-group__label required">Имя</label>
												<div class="field-group__box">
													<input class="field-group__input" type="text" data-name="name" name="person_name" 
													value="{{$claim->customer && $claim->customer->person ? $claim->customer->person->person_name : ''}}">
												</div>
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="field-group__item">
												<label class="field-group__label">Отчество</label>
												<div class="field-group__box">
													<input class="field-group__input" type="text" name="person_patronymic"
													value="{{$claim->customer && $claim->customer->person  ? $claim->customer->person->person_patronymic : ''}}">
												</div>
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="field-group__item">
												<label class="field-group__label required">Пол</label>
												@php
													$genders = PersonHelper::gender();
												@endphp
												<select class="select-choices" name="person_gender">
													<option value=""></option>
													@foreach ($genders as $gender)
														<option
															{{$claim->customer 
															&& $claim->customer->person
															&& $claim->customer->person->commons
															&& $claim->customer->person->commons->person_gender === $gender['value'] ? ' selected' : ''}}
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
													value="{{$claim->customer 
													&& $claim->customer->person 
													&& $claim->customer->person->commons
													? $claim->customer->person->commons->person_surname_lat : ''}}">
												</div>
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="field-group__item">
												<label class="field-group__label">Имя (LAT)</label>
												<div class="field-group__box">
													<input class="field-group__input" type="text" data-name="name_lat" name="person_name_lat"
													value="{{$claim->customer 
													&& $claim->customer->person 
													&& $claim->customer->person->commons
													? $claim->customer->person->commons->person_name_lat : ''}}">
												</div>
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="field-group__item">
												<label class="field-group__label required">Гражданство</label>
												<select class="select-choices" name="person_nationality">
													<option value="" selected></option>
													@php
														$nationalities = PersonHelper::nationality();
													@endphp
													@foreach ($nationalities as $nationality)
														<option
															{{$claim->customer 
															&& $claim->customer->person 
															&& $claim->customer->person->commons
															&& $claim->customer->person->commons->person_nationality === $nationality['value'] ? ' selected' : ''}}
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
													value="{{$claim->customer 
													&& $claim->customer->person
													&& $claim->customer->person->commons
													? $claim->customer->person->commons->person_birthday : ''}}">
												</div>
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="field-group__item">
												<label class="field-group__label">Фактический адрес</label>
												<div class="field-group__box">
													<input class="field-group__input" type="text" name="person_address"
													value="{{$claim->customer 
													&& $claim->customer->person 
													&& $claim->customer->person->commons
													? $claim->customer->person->commons->person_address : ''}}">
												</div>
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="field-group__item">
												<label class="field-group__label">Телефон</label>
												<div class="field-group__box">
													<input class="field-group__input" type="tel" name="person_phone"
													value="{{$claim->customer 
													&& $claim->customer->person
													&& $claim->customer->person->commons
													? $claim->customer->person->commons->person_phone : ''}}">
												</div>
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="field-group__item">
												<label class="field-group__label">Email</label>
												<div class="field-group__box">
													<input class="field-group__input" type="email" name="person_email"
													value="{{$claim->customer 
													&& $claim->customer->person 
													&& $claim->customer->person->commons
													? $claim->customer->person->commons->person_email : ''}}">
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
															value="{{$claim->customer 
															&& $claim->customer->person 
															&& $claim->customer->person->passport 
															? $claim->customer->person->passport->person_passport_series : ''}}">
														</div>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="field-group__item">
														<label class="field-group__label">Номер</label>
														<div class="field-group__box">
															<input class="field-group__input" type="number" name="person_passport_number"
															value="{{$claim->customer 
															&& $claim->customer->person 
															&& $claim->customer->person->passport 
															? $claim->customer->person->passport->person_passport_number : ''}}">
														</div>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="field-group__item">
														<label class="field-group__label">Дата выдачи</label>
														<div class="field-group__box">
															<input class="field-group__input" type="text" name="person_passport_date"
															value="{{$claim->customer 
															&& $claim->customer->person 
															&& $claim->customer->person->passport 
															? $claim->customer->person->passport->person_passport_date : ''}}">
														</div>
													</div>
												</div>
												<div class="col-sm-8">
													<div class="field-group__item">
														<label class="field-group__label">Кем выдан</label>
														<div class="field-group__box">
															<input class="field-group__input" type="text" name="person_passport_issued"
															value="{{$claim->customer 
															&& $claim->customer->person 
															&& $claim->customer->person->passport 
															? $claim->customer->person->passport->person_passport_issued : ''}}">
														</div>
													</div>
												</div>
												<div class="col-sm-4">
													<div class="field-group__item">
														<label class="field-group__label">Код</label>
														<div class="field-group__box">
															<input class="field-group__input" type="text" name="person_passport_code"
															value="{{$claim->customer 
															&& $claim->customer->person 
															&& $claim->customer->person->passport 
															? $claim->customer->person->passport->person_passport_code : ''}}">
														</div>
													</div>
												</div>
												<div class="col-sm-12">
													<div class="field-group__item">
														<label class="field-group__label">Адрес регистрации</label>
														<div class="field-group__box">
															<input class="field-group__input" type="text" name="person_passport_address"
															value="{{$claim->customer 
															&& $claim->customer->person 
															&& $claim->customer->person->passport
															? $claim->customer->person->passport->person_passport_address : ''}}">
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
															value="{{$claim->customer 
															&& $claim->customer->person 
															&& $claim->customer->person->certificate
															? $claim->customer->person->certificate->person_certificate_series : ''}}">
														</div>
													</div>
												</div>
												<div class="col-sm-8">
													<div class="field-group__item">
														<label class="field-group__label">Номер</label>
														<div class="field-group__box">
															<input class="field-group__input" type="text" name="person_certificate_number"
															value="{{$claim->customer 
															&& $claim->customer->person 
															&& $claim->customer->person->certificate
															? $claim->customer->person->certificate->person_certificate_number : ''}}">
														</div>
													</div>
												</div>
												<div class="col-sm-12">
													<div class="field-group__item">
														<label class="field-group__label">Дата выдачи</label>
														<div class="field-group__box">
															<input class="field-group__input" type="text" data-name="date" data-format="date" name="person_certificate_date"
															value="{{$claim->customer 
															&& $claim->customer->person 
															&& $claim->customer->person->certificate
															&& $claim->customer->person->certificate->person_certificate_date
															? $claim->customer->person->certificate->person_certificate_date->format('Y-m-d') 
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
															value="{{$claim->customer 
															&& $claim->customer->person 
															&& $claim->customer->person->certificate
															? $claim->customer->person->certificate->person_certificate_issued : ''}}">
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
															value="{{$claim->customer 
															&& $claim->customer->person 
															&& $claim->customer->person->internationalPassport
															? $claim->customer->person->internationalPassport->person_international_passport_series : ''}}">
														</div>
													</div>
												</div>
												<div class="col-sm-8">
													<div class="field-group__item">
														<label class="field-group__label">Номер</label>
														<div class="field-group__box">
															<input class="field-group__input" type="text" name="person_international_passport_number"
															value="{{$claim->customer 
															&& $claim->customer->person 
															&& $claim->customer->person->internationalPassport
															? $claim->customer->person->internationalPassport->person_international_passport_number : ''}}">
														</div>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="field-group__item">
														<label class="field-group__label">Дата выдачи</label>
														<div class="field-group__box">
															<input class="field-group__input" type="text" data-name="date" data-format="date" name="person_international_passport_date"
																value="{{$claim->customer 
																&& $claim->customer->person 
																&& $claim->customer->person->internationalPassport
																&& $claim->customer->person->internationalPassport->person_international_passport_date
																? $claim->customer->person->internationalPassport->person_international_passport_date->format('Y-m-d') : ''}}">
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
															value="{{$claim->customer 
																&& $claim->customer->person 
																&& $claim->customer->person->internationalPassport
																&& $claim->customer->person->internationalPassport->person_international_passport_period
																? $claim->customer->person->internationalPassport->person_international_passport_period->format('Y-m-d') : ''}}">
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
															value="{{$claim->customer 
															&& $claim->customer->person 
															&& $claim->customer->person->internationalPassport
															? $claim->customer->person->internationalPassport->person_international_passport_issued : ''}}">
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="modal__footer">
										<div class="modal__buttons">
											<button class="btn btn-create btn-primary" type="submit">
												<i class="fa-solid fa-check"></i>
												Сохранить (ФЛ)
											</button>
											<button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Закрыть</button>
										</div>
									</div>
								</div>
								<div class="tabs-content{{$claim->customer && $claim->customer->type === 'company' ? ' isOpen' : ''}}" id="company" data-tab-content="company">
									<div class="row align-items-end">
										<div class="col-lg-3 col-md-6">
											<div class="field-group__item">
												<label class="field-group__label">Наименование банка</label>
												<div class="field-group__box">
													<input class="field-group__input" type="text" name="company_bank"
													value="{{$claim->customer 
													&& $claim->customer->company 
													&& $claim->customer->company->bank
													? $claim->customer->company->bank->company_bank : ''}}">
												</div>
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="field-group__item">
												<label class="field-group__label">Бик</label>
												<div class="field-group__box">
													<input class="field-group__input" type="text" name="company_bik"
													value="{{$claim->customer 
													&& $claim->customer->company 
													&& $claim->customer->company->bank
													? $claim->customer->company->bank->company_bik : ''}}">
												</div>
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="field-group__item">
												<label class="field-group__label">Р/с</label>
												<div class="field-group__box">
													<input class="field-group__input" type="text" name="company_rs"
													value="{{$claim->customer 
													&& $claim->customer->company 
													&& $claim->customer->company->bank
													? $claim->customer->company->bank->company_rs : ''}}">
												</div>
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="field-group__item">
												<label class="field-group__label">К/с</label>
												<div class="field-group__box">
													<input class="field-group__input" type="text" name="company_ks"
													value="{{$claim->customer 
													&& $claim->customer->company 
													&& $claim->customer->company->bank
													? $claim->customer->company->bank->company_ks : ''}}">
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="field-group__item">
												<label class="field-group__label">Полное наименование юр.лица</label>
												<div class="field-group__box">
													<input class="field-group__input" type="text" name="company_fullname"
													value="{{$claim->customer 
													&& $claim->customer->company 
													? $claim->customer->company->company_fullname : ''}}">
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="field-group__item">
												<label class="field-group__label">Сокращенное наименование юр.лица</label>
												<div class="field-group__box">
													<input class="field-group__input" type="text" name="company_shortname"
													value="{{$claim->customer 
													&& $claim->customer->company 
													? $claim->customer->company->company_shortname : ''}}">
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="field-group__item">
												<label class="field-group__label">Юридический адрес</label>
												<div class="field-group__box">
													<input class="field-group__input" type="text" name="company_address"
													value="{{$claim->customer 
													&& $claim->customer->company 
													&& $claim->customer->company->contact
													? $claim->customer->company->contact->company_address : ''}}">
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="field-group__item">
												<label class="field-group__label">Фактический адрес</label>
												<div class="field-group__box">
													<input class="field-group__input" type="text" name="company_actual_address"
													value="{{$claim->customer 
													&& $claim->customer->company 
													&& $claim->customer->company->contact
													? $claim->customer->company->contact->company_actual_address : ''}}">
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
													value="{{$claim->customer 
													&& $claim->customer->company 
													&& $claim->customer->company->register
													? $claim->customer->company->register->company_kpp : ''}}">
												</div>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="field-group__item">
												<label class="field-group__label">ИНН</label>
												<div class="field-group__box">
													<input class="field-group__input" type="text" name="company_inn"
													value="{{$claim->customer 
													&& $claim->customer->company 
													&& $claim->customer->company->register
													? $claim->customer->company->register->company_inn : ''}}">
												</div>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="field-group__item">
												<label class="field-group__label">ОГРН</label>
												<div class="field-group__box">
													<input class="field-group__input" type="text" name="company_ogrn"
													value="{{$claim->customer 
													&& $claim->customer->company 
													&& $claim->customer->company->register
													? $claim->customer->company->register->company_ogrn : ''}}">
												</div>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="field-group__item">
												<label class="field-group__label">Фио директора</label>
												<div class="field-group__box">
													<input class="field-group__input" type="text" name="company_director"
													value="{{$claim->customer 
													&& $claim->customer->company 
													&& $claim->customer->contact 
													? $claim->customer->company->contact->company_director : ''}}">
												</div>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="field-group__item">
												<label class="field-group__label">Телефон</label>
												<div class="field-group__box">
													<input class="field-group__input" type="tel" name="company_phone"
													value="{{$claim->customer 
													&& $claim->customer->company 
													&& $claim->customer->contact 
													? $claim->customer->company->contact->company_phone : ''}}">
												</div>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="field-group__item">
												<label class="field-group__label">E-mail</label>
												<div class="field-group__box">
													<input class="field-group__input" type="email" name="company_email"
													value="{{$claim->customer 
													&& $claim->customer->company 
													&& $claim->customer->contact 
													? $claim->customer->company->contact->company_email : ''}}">
												</div>
											</div>
										</div>
									</div>
									<div class="modal__footer">
										<div class="modal__buttons">
											<button class="btn btn-create btn-primary" type="submit">
												<i class="fa-solid fa-check"></i>
												Сохранить (ЮЛ)
											</button>
											<button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Закрыть</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>