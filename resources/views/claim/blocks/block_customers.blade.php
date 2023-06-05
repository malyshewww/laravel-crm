<div class="data-claim__group group-data" id="groupDataCustomer">
	<header class="group-data__header">
		<h2 class="group-data__title">Заказчик</h2>
		<div class="group-data__buttons">
			<button class="btn btn-blue btn-primary" type="button" 
				data-bs-toggle="modal" data-bs-target="#addCustomer"
				data-id="{{$claim->id}}" 
				data-type="update"
				data-claim-id="{{$claim->id}}"
				data-url="{{route('customer.store', $claim->id)}}"
				data-path="{{route('customer.loadModal', [$claim->id, 'update'])}}"
				data-title="Заказчик">
				Указать заказчика
			</button>
		</div>
		<div class="group-data__text text-blue">Покупатель тура, с которым заключается договор</div>
	</header>
	<div class="group-data__area area-group">
		@if ($claim->customer)
			<header class="area-group__header">
				<div class="area-group__info">
					@if ($claim->customer->type === 'person' && $claim->person)
						Физическое лицо:
						<span>{{$claim->person->person_surname ?: 'Фамилия'}}
							{{$claim->person->person_name ?: 'Имя'}}
							{{$claim->person->person_patronymic ?: 'Отчество'}}</span>
						<div class="area-group__labels"> 
							@if ($claim->customer->commons)
								@if ($claim->customer->commons->person_phone)
								<div class="area-group__label">
									<i class="fa-solid fa-phone"></i>
									<span class="area-group__phone">{{$claim->person->commons->person_phone}}</span>
								</div>
								@endif
								@if ($claim->person->commons->person_email)
									<div class="area-group__label">
										<i class="fa-solid fa-envelope"></i>
										<span class="area-group__phone">{{$claim->person->commons->person_email}}</span>
									</div>
								@endif
							@endif
						</div>
						@elseif($claim->customer->type === 'company' && $claim->company)
							Юридическое лицо:
							<span>{{$claim->company->company_fullname ?: 'Наименование юридического лица'}}</span>
							@if ($claim->company->contact)
								<div class="area-group__labels"> 
								@if ($claim->company->contact->company_phone)
									<div class="area-group__label">
										<i class="fa-solid fa-phone"></i>
										<span class="area-group__phone">{{$claim->company->contact->company_phone}}</span>
									</div>
								@endif
								@if ($claim->company->contact->company_email)
									<div class="area-group__label">
										<i class="fa-solid fa-envelope"></i>
										<span class="area-group__phone">{{$claim->company->contact->company_email}}</span>
									</div>
								@endif
								</div>
							@endif
					@endif
				</div>
			</header>
		@endif
		@if ($claim->customer && $claim->customer->type === 'person')
			@if ($claim->person)
			<div class="area-group__body">
				<div class="dropdown">
					<button class="dropdown__button text-blue" type="button" id="passport-data">Паспортные данные</button>
					<div class="dropdown__content customer-passport" hidden>
						<ul class="dropdown__list list">
							<li>
								<div class="list__label">СЕРИЯ И НОМЕР:</div>
								<div class="list__value">
									{{$claim->person->passport && $claim->person->passport->person_passport_series 
									? $claim->person->passport->person_passport_series : 'Не указано'}}
									-
									{{$claim->person->passport && $claim->person->passport->person_passport_number 
									? $claim->person->passport->person_passport_number : 'Не указано'}}
								</div>
							</li>
							<li> 
								<div class="list__label">КЕМ ВЫДАН:</div>
								<div class="list__value">{{$claim->person->passport && $claim->person->passport->person_passport_issued
								? $claim->person->passport->person_passport_issued : 'Не указано'}}</div>
							</li>
							<li> 
								<div class="list__label">КОД ПОДРАЗДЕЛЕНИЯ:</div>
								<div class="list__value">{{$claim->person->passport && $claim->person->passport->person_passport_code 
								? $claim->person->passport->person_passport_code : 'Не указано'}}</div>
							</li>
							<li> 
								<div class="list__label">АДРЕС:</div>
								<div class="list__value">{{$claim->person->passport && $claim->person->passport->person_passport_address 
								? $claim->person->passport->person_passport_address : 'Не указано'}}</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
			@endif
		@elseif ($claim->customer && $claim->customer->type === 'company')
			@if ($claim->company)
				<div class="area-group__body">
					<div class="dropdown">
						<button class="dropdown__button text-blue" type="button" id="passport-data">Данные юридического лица</button>
						<div class="dropdown__content customer-passport" hidden>
							<ul class="dropdown__list list">
								<li>
									<div class="list__label">Полное наименование юр. лица:</div>
									<div class="list__value">
										{{$claim->company->company_fullname ?: 'Не указано'}}</div>
								</li>
								<li> 
									<div class="list__label">Сокращенное наименование юр. лица:</div>
									<div class="list__value">
										{{$claim->company->company_shortname ?: 'Не указано'}}
									</div>
								</li>
								<li> 
									<div class="list__label">ИНН:</div>
									<div class="list__value">
										{{$claim->company->register && $claim->company->register->company_inn 
										? $claim->company->register->company_inn : 'Не указан'}}</div>
								</li>
								<li> 
									<div class="list__label">КПП:</div>
									<div class="list__value">
										{{$claim->company->register && $claim->company->register->company_kpp 
										? $claim->company->register->company_kpp : 'Не указан'}}</div>
								</li>
								<li> 
									<div class="list__label">ОГРН:</div>
									<div class="list__value">
										{{$claim->company->register && $claim->company->register->company_ogrn 
										? $claim->company->register->company_ogrn : 'Не указан'}}</div>
								</li>
								<li> 
									<div class="list__label">ОГРН:</div>
									<div class="list__value">
										{{$claim->company->register && $claim->company->register->company_ogrn 
										? $claim->company->register->company_ogrn : 'Не указан'}}</div>
								</li>
								<li> 
									<div class="list__label">Наименование банка:</div>
									<div class="list__value">
										{{$claim->company->bank && $claim->company->bank->company_bank 
										? $claim->company->bank->company_bank : 'Не указан'}}</div>
								</li>
								<li> 
									<div class="list__label">БИК:</div>
									<div class="list__value">
										{{$claim->company->bank && $claim->company->bank->company_bik 
										? $claim->company->bank->company_bik : 'Не указан'}}</div>
								</li>
								<li> 
									<div class="list__label">Р/С:</div>
									<div class="list__value">
										{{$claim->company->bank && $claim->company->bank->company_rs 
										? $claim->company->bank->company_rs : 'Не указан'}}</div>
								</li>
								<li> 
									<div class="list__label">К/С:</div>
									<div class="list__value">
										{{$claim->company->bank && $claim->company->bank->company_ks
										? $claim->company->bank->company_ks : 'Не указан'}}</div>
								</li>
								<li> 
									<div class="list__label">Юридический адрес:</div>
									<div class="list__value">
										{{$claim->company->contact && $claim->company->contact->company_address 
										? $claim->company->contact->company_address : 'Не указан'}}</div>
								</li>
								<li> 
									<div class="list__label">Фактический адрес:</div>
									<div class="list__value">
										{{$claim->company->contact && $claim->company->contact->company_actual_address 
										? $claim->company->contact->company_actual_address : 'Не указан'}}</div>
								</li>
								<li> 
									<div class="list__label">ФИО ГЕН. ДИРЕКТОРА:</div>
									<div class="list__value">
										{{$claim->company->contact && $claim->company->contact->company_director 
										? $claim->company->contact->company_director : 'Не указано'}}</div>
								</li>
								<li> 
									<div class="list__label">Телефон:</div>
									<div class="list__value">
										{{$claim->company->contact && $claim->company->contact->company_phone 
										? $claim->company->contact->company_phone : 'Не указан'}}</div>
								</li>
								<li> 
									<div class="list__label">E-mail:</div>
									<div class="list__value">
										{{$claim->company->contact && $claim->company->contact->company_email 
										? $claim->company->contact->company_email : 'Не указан'}}</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			@endif
		@else
			<div class="area-group__empty">
				Необходимо указать данные о лице, с которым будет заключен договор
			</div>
		@endif
	</div>
</div>