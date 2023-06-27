<div class="data-claim__group group-data" id="groupDataCustomer">
	<header class="group-data__header">
		<h2 class="group-data__title">Заказчик</h2>
		<div class="group-data__buttons">
			<button class="btn btn-blue btn-primary" type="button" 
				data-bs-toggle="modal" data-bs-target="#addCustomer"
				data-id="{{$claim->id}}" 
				data-type="update"
				data-claim-id="{{$claim->id}}"
				data-url="{{route('customer.store')}}"
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
							@if ($claim->person->commons)
								@if ($claim->person->commons->person_phone)
								<div class="area-group__label">
									<i class="fa-solid fa-phone"></i>
									<span class="area-group__phone">+{{$claim->person->commons->person_phone}}</span>
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
							<div class="area-group__labels"> 
								@if ($claim->company->company_phone)
									<div class="area-group__label">
										<i class="fa-solid fa-phone"></i>
										<span class="area-group__phone">+{{$claim->company->company_phone}}</span>
									</div>
								@endif
								@if ($claim->company->company_email)
									<div class="area-group__label">
										<i class="fa-solid fa-envelope"></i>
										<span class="area-group__phone">{{$claim->company->company_email}}</span>
									</div>
								@endif
							</div>
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
						@php
							$passportSeries = $claim->person->passport && $claim->person->passport->person_passport_series 
									? $claim->person->passport->person_passport_series : 'Не указано';
							$passportNumber = $claim->person->passport && $claim->person->passport->person_passport_number 
									? $claim->person->passport->person_passport_number : 'Не указано';
							$passportIssued = $claim->person->passport && $claim->person->passport->person_passport_issued
									? $claim->person->passport->person_passport_issued : 'Не указано';
							$passportCode = $claim->person->passport && $claim->person->passport->person_passport_code 
									? $claim->person->passport->person_passport_code : 'Не указано';
							$passportAddress = $claim->person->passport && $claim->person->passport->person_passport_address 
									? $claim->person->passport->person_passport_address : 'Не указано';
							$personDataList = [
								['label' => 'СЕРИЯ И НОМЕР:', 'value' => $passportSeries . ' - ' . $passportNumber],
								['label' => 'КЕМ ВЫДАН:', 'value' => $passportIssued],
								['label' => 'КОД ПОДРАЗДЕЛЕНИЯ:', 'value' => $passportCode],
								['label' => 'АДРЕС:', 'value' => $passportAddress],
							];
						@endphp
						<ul class="dropdown__list list">
							@foreach ($personDataList as $item)
								<li>
									<div class="list__label">{{$item['label']}}</div>
									<div class="list__value">{{$item['value']}}</div>
								</li>
							@endforeach
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
							@php
								$companyDataList = [
									['label' => 'Полное наименование юр. лица:', 'value' => $claim->company->company_fullname ?: 'Не указано'],
									['label' => 'Сокращенное наименование юр. лица:', 'value' => $claim->company->company_shortname ?: 'Не указано'],
									['label' => 'ИНН:', 'value' => $claim->company->company_inn ?: 'Не указан'],
									['label' => 'КПП:', 'value' => $claim->company->company_kpp ?: 'Не указан'],
									['label' => 'ОГРН:', 'value' => $claim->company->company_ogrn ?: 'Не указан'],
									['label' => 'Наименование банка:', 'value' => $claim->company->company_bank ?: 'Не указан'],
									['label' => 'БИК:', 'value' => $claim->company->company_bik ?: 'Не указан'],
									['label' => 'Р/С:', 'value' => $claim->company->company_rs ?: 'Не указан'],
									['label' => 'К/С:', 'value' => $claim->company->company_ks ?: 'Не указан'],
									['label' => 'Юридический адрес:', 'value' => $claim->company->company_address ?: 'Не указан'],
									['label' => 'Фактический адрес:', 'value' => $claim->company->company_actual_address ?: 'Не указан'],
									['label' => 'ФИО ГЕН. ДИРЕКТОРА:', 'value' => $claim->company->company_director ?: 'Не указано'],
									['label' => 'Телефон:', 'value' => $claim->company->company_phone ?: 'Не указан'],
									['label' => 'E-mail:', 'value' => $claim->company->company_email ?: 'Не указан'],
								];
							@endphp
							<ul class="dropdown__list list">
								@foreach ($companyDataList as $item)
									<li> 
										<div class="list__label">{{$item['label']}}</div>
										<div class="list__value">{{$item['value']}}</div>
									</li>
								@endforeach
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