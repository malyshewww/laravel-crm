@extends('layouts.app')
@section('title')
	Страница заявки № {{$claim->id}}
@endsection
@section('header')
	@include('layouts.header')
@endsection
@section('content')
	<section class="claim">
		<div class="container">
			<div class="claim__body">
				<div class="claim__header">
					<div class="claim__top"> 
						<h1 class="claim__title">
							Заявка № <span class="claim-number">{{$claim->id}}</span>
						</h1>
						<button class="claim__copy btn-copy" id="btn-copy"><i class="fa-regular fa-paste"></i></button>
						<div class="claim__subtitle">
							Тихановская Ирина Викторовна создана: {{$claim->created_at}} МСК.</div>
					</div>
					<div class="claim__comment comment-claim">
						<div class="comment-claim__box">
							<button class="claim__button btn-blue btn-redact" type="button" data-bs-toggle="modal" data-bs-target="#comment" data-url="">
								<span>{{$claim->comment ? 'редактировать комментарий' : 'добавить комментарий'}}</span>
							</button>
							@if ($claim->comment)
								<div class="comment-claim__text">{{$claim->comment}}</div>
							@endif
						</div>
					</div>
				</div>
				<div class="claim__tabs tabs-claim">
					<nav class="tabs-claim__navigation"> 
						<ul class="tabs-claim__list"> 
							<li class="tabs-claim__item tabs-item" data-tab="info">Информация по заявке</li>
							<li class="tabs-claim__item tabs-item" data-tab="finance">Финансы</li>
							<li class="tabs-claim__item tabs-item" data-tab="contract">Договоры</li>
						</ul>
					</nav>
					<div class="tabs-claim__content"> 
						<div class="tabs-claim__data data-claim tabs-content" data-tab-content="info">
							<div class="data-claim__groups">
								<div class="data-claim__group group-data">
									<div class="row g-20">
										<div class="col col-xl-6 col-12">
											@include('claim.blocks.block_docs')
											@include('claim.blocks.block_tourpackage')
											@include('claim.blocks.block_touroperator')
											@include('claim.blocks.block_contract')
										</div>
									</div>
								</div>
								@include('claim.blocks.block_customers')
								<div class="data-claim__group group-data" id="groupDataTourist">
									<header class="group-data__header">
										<h2 class="group-data__title">Туристы</h2>
										<div class="group-data__buttons">
											{{-- <button class="btn btn-blue btn-primary" type="button">
												Отправить ссылку на заполнение данных
											</button> --}}
											<button class="btn btn-blue btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#addTourist">
												<i class="fa-regular fa-plus"></i>
												Добавить туриста
											</button>
										</div>
									</header>
									<div class="group-data__subheader">
										<i>Для граждан РФ при бронировании направления Россия заселение в отель и авиаперевозка производится 
											<strong>только по паспорту гражданина РФ</strong>
										</i>
										<br>
										<i>
											<strong>Важно!</strong>Замена данных в заявке с заграничного паспорта на российский и наоборот 
											<strong>является перебронированием.</strong>
										</i>
										<br>
										<i>
											<strong>Внимание!</strong> 
											Паспортные данные граждан СНГ и иностранных граждан других государств вносятся латиницей как в паспорте.	
										</i>
									</div>
									<div class="group-data__area area-group">
										<div class="area-group__body">
											@if ($claim->tourist && count($claim->tourist) > 0)
											<div class="table-responsive">
												<table class="tourist-table table" id="touristTable"> 
													<thead> 
														<th style="width: 20%">Фио туриста</th>
														<th style="width: 5%">Пол</th>
														<th style="width: 15%">Дата рождения</th>
														<th style="width: 20%">Паспортные данные / Св-во о рождении</th>
														<th style="width: 20%">Контакты</th>
														<th style="width: 15%">Виза</th>
														<th style="width: 5%">Действия</th>
													</thead>
													<tbody>
															@foreach ($claim->tourist as $key => $tourist)
																<tr>
																	<td class="tourist-table__name">
																		{{$tourist->tourist_surname}}
																		{{$tourist->tourist_name}}
																		{{$tourist->tourist_patronymic ?: ''}}
																	</td>
																	<td class="tourist-table__gender">
																		{{$tourist->common->tourist_gender === 'male' ? 'М' : 'Ж'}}
																	</td>
																	<td class="tourist-table__date">
																		{{$tourist->common->tourist_birthday ?: ''}}
																	</td>
																	<td class="tourist-table__passport">
																		@if ($tourist->passport || $tourist->certificate)
																			<ul>
																				@if ($tourist->passport)
																					<li>
																						<span>РФ:</span>
																						<span>
																							{{$tourist->passport->tourist_passport_series ?: '-'}} 
																							{{$tourist->passport->tourist_passport_number ?: '-'}}
																						</span>
																					</li>
																				@endif
																				@if ($tourist->certificate)
																					<li>
																						<span>Св-во:</span>
																						<span>
																							{{$tourist->certificate->tourist_certificate_series ?: '-'}}
																							{{$tourist->certificate->tourist_certificate_number ?: '-'}}
																						</span>
																					</li>
																				@endif
																			</ul>
																		@else
																			Не указаны	
																		@endif
																	</td>
																	<td class="tourist-table__contacts">
																		@if ($tourist->common && $tourist->common->tourist_phone || $tourist->common->tourist_email)
																			<ul>
																				@if ($tourist->common->tourist_phone)
																					<li>
																						<span>Тел:</span>
																						@php
																							$phone = preg_replace('/[^0-9]/', '', $tourist->common->tourist_phone);
																						@endphp
																						<span>
																							<a href="tel:{{$phone}}">{{$phone}}</a>
																						</span>
																					</li>
																				@endif
																				@if ($tourist->common->tourist_email)
																					<li>
																						<span>Email:</span>
																						<span>
																							<a href="mailto:{{$tourist->common->tourist_email}}">
																								{{$tourist->common->tourist_email}}
																							</a>
																						</span>
																					</li>
																				@endif
																			</ul>
																		@else
																			Не указаны
																		@endif
																	</td>
																	<td class="tourist-table__visa">
																		@php
																			$cities = TouristHelper::city();
																		@endphp
																		<ul>
																			<li>
																				<span>{{$tourist->common->visa_info == 'not' ? 'не требуется' : 'надо оформить визу'}}</span>
																			</li>
																			@if ($tourist->common && $tourist->common->visa_info == 'yes' )
																				<li>
																					<span>
																						@foreach ($cities as $key => $city)
																							{{$key == $tourist->common->visa_city ? $city['name'] : ''}}
																						@endforeach
																					</span>
																				</li>
																			@endif
																		</ul>
																	</td>
																	<td class="tourist-table__actions">
																		<div class="table__buttons">
																			<div class="table__button-item" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Редактировать данные о туристе">
																				<button class="btn-gear" type="button" data-id="{{$tourist->id}}" data-bs-toggle="modal" data-bs-target="#updateTourist-{{$tourist->id}}">
																					<i class="fa-solid fa-gear"></i>
																				</button>
																			</div>
																			<div class="table__button-item" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Удалить туриста">
																				<button class="btn-trash" type="button" >
																					<i class="fa-solid fa-trash-can"></i>
																				</button>
																			</div>
																			{{-- <div class="table__button-item" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Добавить во все услуги заявки">
																				<button class="btn-linkify" type="button">
																					<i class="fa-solid fa-link"></i>
																				</button>
																			</div> --}}
																		</div>
																		@include('claim.tourists.modals.update_tourist', ['tourist' => $tourist])
																	</td>
																</tr>
																<tr class="join">
																	<td class="tourist-table__name">
																		<span>
																			{{$tourist->common && $tourist->common->tourist_surname_lat ? $tourist->common->tourist_surname_lat : ''}}
																			{{$tourist->common && $tourist->common->tourist_name_lat ? $tourist->common->tourist_name_lat : ''}}
																		</span>
																	</td>
																	<td class="tourist-table__gender"></td>
																	<td class="tourist-table__date"></td>
																	<td class="tourist-table__passport">
																		@if ($tourist->internationalPassport)
																			<ul>	
																				<li> 
																					<span>ЗГРН:</span>
																					<span>
																						{{$tourist->internationalPassport 
																							&& $tourist->internationalPassport->tourist_international_passport_series
																							? $tourist->internationalPassport->tourist_international_passport_series : '-'}}
																						-
																						{{$tourist->internationalPassport 
																							&& $tourist->internationalPassport->tourist_international_passport_number
																							? $tourist->internationalPassport->tourist_international_passport_number : '-'}}
																					</span>
																				</li>
																			</ul>
																		@endif
																	</td>
																	<td class="tourist-table__contacts"></td>
																	<td class="ourist-table__visa"></td>
																	<td class="tourist-table__actions"></td>
																</tr>
															@endforeach
														</tbody>
													</table>
												</div>
											@else
												<div class="area-group__empty">
													Туристы не указаны
												</div>
											@endif
										</div>
									</div>
								</div>
								<div class="data-claim__group group-data">
									<header class="group-data__header">
										<h1 class="group-data__title">Детали тура</h1>
										<div class="group-data__buttons">
											<button class="btn btn-blue btn-primary" type="button">
												Создать заявку на доп.услугу
											</button>
											<div class="dropdown">
												<button class="btn btn-blue btn-primary" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-regular fa-plus"> </i>Добавить услугу</button>
												<ul class="dropdown-menu dropdown__menu">
													<li class="dropdown-menu__item">
														<button class="dropdown-menu__button" type="button" data-bs-toggle="modal" data-bs-target="#addFlight">Перелёт</button>
													</li>
													<li class="dropdown-menu__item">
														<button class="dropdown-menu__button" type="button" data-bs-toggle="modal" data-bs-target="#addInsurance">Страховка</button>
													</li>
													<li class="dropdown-menu__item">
														<button class="dropdown-menu__button" type="button" data-bs-toggle="modal" data-bs-target="#addTransfer">Трансфер</button>
													</li>
													<li class="dropdown-menu__item">
														<button class="dropdown-menu__button" type="button" data-bs-toggle="modal" data-bs-target="#addVisa">Виза</button>
													</li>
													<li class="dropdown-menu__item">
														<button class="dropdown-menu__button" type="button" data-bs-toggle="modal" data-bs-target="#addHabitation">Проживание</button>
													</li>
													<li class="dropdown-menu__item">
														<button class="dropdown-menu__button" type="button" data-bs-toggle="modal" data-bs-target="#addFuelSurcharge">Топливный сбор</button>
													</li>
													<li class="dropdown-menu__item">
														<button class="dropdown-menu__button" type="button" data-bs-toggle="modal" data-bs-target="#addExcursionProgram">Экскурсионная программа</button>
													</li>
													<li class="dropdown-menu__item">
														<button class="dropdown-menu__button" type="button" data-bs-toggle="modal" data-bs-target="#addOtherService">Другая услуга</button>
													</li>
												</ul>
											</div>
										</div>
									</header>
									<div class="group-data__area area-group">
										<div class="area-group__body">
											<div class="area-group__header"> 
												<h3 class="area-group__title">УСЛУГИ В ТУРПАКЕТЕ</h3>
											</div>
											<div class="table-responsive">
												<table class="detailtour-table table">
													<thead> 
														<th style="width: 160px;">Услуга</th>
														<th style="width: 40px;"></th>
														<th style="width: auto;">Описание</th>
														<th style="width: 270px;">Даты</th>
														<th style="width: 100px;">Туристы</th>
														<th style="width: 80px;">Действия</th>
													</thead>
													<tbody>
														@include('claim.services.outputs.output_flight')
														@include('claim.services.outputs.output_insurance')
														@include('claim.services.outputs.output_transfer')
														@include('claim.services.outputs.output_visa')
														@include('claim.services.outputs.output_habitation')
														@include('claim.services.outputs.output_fuel_surchange')
														@include('claim.services.outputs.output_excursion')
														@include('claim.services.outputs.output_other')
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								{{-- @include('claim.blocks.block_docstouroperator') --}}
								@include('claim.blocks.block_file')
							</div>
						</div>
						<div class="tabs-claim__data data-claim tabs-content" data-tab-content="finance">
							<div class="data-claim-groups"> 
								<div class="data-claim__group">
									<div class="row">
										<div class="col col-xl-6 col-12">
											<div class="group-data__item item-group">
												<div class="item-group__top"> 
													<div class="item-group__title">ВЗАИМОРАСЧЁТЫ С ТУРИСТОМ</div>
													<div class="item-group__status status-full">
														<i class="fa-solid fa-circle-check"></i>
														Полностью оплачено
													</div>
													<div>
														<button class="item-group__button btn-blue btn-redact" type="button" 
														data-bs-toggle="modal" 
														data-bs-target="#prepaymentParameters">
															[параметры предоплаты по договору]
														</button>
													</div>
												</div>
												<div class="item-group__main">
													<div class="item-group__box finance-box">
														<div class="item-group__heading">
															<div class="item-group__buttons">
																<button class="btn-blue btn-redact" type="button" id="tourist-price">
																	СТОИМОСТЬ ДЛЯ ТУРИСТА
																	<i class="fa-solid fa-chevron-down icon-arrow"></i>
																</button>
															</div>
															<div class="item-group__prices">
																@if ($claim->payment && $claim->payment->tour_price)
																	@switch($claim->payment->currency)
																		@case('USD')
																			<span class="item-group__price">{{$claim->payment->tour_price}} $</span>
																			@break
																		@case('EUR')
																			<span class="item-group__price">{{$claim->payment->tour_price}} €</span>
																			@break
																		@default
																			<span class="item-group__price">{{$claim->payment->tour_price}} ₽</span>
																	@endswitch
																@endif
																{{-- <span class="item-group__price">151 300,28 ₽</span>
																<span>/</span>
																<span class="item-group__price">1 939,25 $</span> --}}
															</div>
														</div>
														<div class="tourist-price-content" hidden>
															<ul class="item-group__list list">
																{{-- <li>
																	<div class="list__label">СКИДКА ДЛЯ ПОКУПАТЕЛЯ (ТУРИСТА)</div>
																	<div class="list__value">0,0 %</div>
																</li> --}}
																<li>
																	<div class="list__label">СТОИМОСТЬ ТУРПАКЕТА ПО КАТАЛОГУ</div>
																	<div class="list__value">
																		@if ($claim->payment)
																			{{$claim->payment->comission_price ?: '0'}}
																			@switch($claim->payment->currency)
																				@case('USD')
																					$
																					@break
																				@case('EUR')
																					€
																					@break
																				@default
																					₽
																			@endswitch
																		@else
																			0 ₽
																		@endif
																	</div>
																</li>
																<li>
																	<div class="list__label">— КОМИССИОННАЯ</div>
																	<div class="list__value">
																		@if ($claim->payment)
																			{{$claim->payment->comission_price ?: '0'}}
																			@switch($claim->payment->currency)
																				@case('USD')
																					$
																					@break
																				@case('EUR')
																					€
																					@break
																				@default
																					₽
																			@endswitch
																		@else
																			0 ₽
																		@endif
																	</div>
																</li>
																{{-- <li>
																	<div class="list__label">— НЕКОМИССИОННАЯ</div>
																	<div class="list__value">0,00 ₽</div>
																</li> --}}
																{{-- <li>
																	<div class="list__label">CТОИМОСТЬ ДОПОЛНИТЕЛЬНЫХ УСЛУГ</div>
																	<div class="list__value">0,00 ₽</div>
																</li>
																<li>
																	<div class="list__label">— КОМИССИОННАЯ</div>
																	<div class="list__value">0,00 ₽</div>
																</li>
																<li>
																	<div class="list__label">— НЕКОМИССИОННАЯ</div>
																	<div class="list__value">0,00 ₽</div>
																</li> --}}
															</ul>
														</div>
													</div>
												</div>
												<div class="item-group__box">
													<div class="item-group__heading">
														<div class="item-group__button">
															<span class="text-label">ОПЛАЧЕНО ТУРИСТОМ</span>
															<button class="btn-blue btn-redact" type="button" id="history-price">ИСТОРИЯ ОПЛАТ
																<i class="fa-solid fa-chevron-down icon-arrow"></i>
															</button>
														</div>
														<div class="item-group__prices">
															<span class="item-group__price">сумма платежей ₽</span>
														</div>
													</div>
													@if (count($claim->paymentInvoices) > 0)
													<div class="table-responsive">
														<table class="table finance-table" hidden>
															<thead> 
																<th style="width: 60px;">
																	<th style="width: 110px;">ДАТА</th>
																	<th style="width: auto;">НОМЕР СЧЁТА</th>
																	<th style="width: auto;">СУММА</th>
																	<th style="width: 80px;">ДОЛГ</th>
																</th>
																<th style="width: 50px;"></th>
															</thead>
															<tbody>
																@foreach ($claim->paymentInvoices as $itemInvoice)
																	<tr> 
																		<td>cчет</td>
																		<td>
																			{{$itemInvoice->date_invoices ? $itemInvoice->date_invoices->format('d.m.Y H:i') : ''}}
																		</td>
																		<td>№ {{$claim->id}}-{{$itemInvoice->id}}</td>
																		<td>
																			{{$itemInvoice->sum ?: ''}}
																			@switch($itemInvoice->currency)
																				@case('USD')
																					$
																					@break
																				@case('EUR')
																					€
																					@break
																				@default
																					₽
																			@endswitch
																		</td>
																		<td> 
																			{{-- <span class="text-success">Оплачено</span> --}}
																		</td>
																		<td> 
																			<div class="table__actions"> 
																				<div class="table__buttons">
																					<div class="table__button-item" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Редактировать счет">
																						<button class="btn-pen" type="button" 
																						data-bs-toggle="modal" 
																						data-bs-target="#updatePaymentInvoice-{{$itemInvoice->id}}">
																							<i class="fa-solid fa-pen"></i>
																						</button>
																					</div>
																					<div class="table__button-item" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Удалить счет">
																						<button class="btn-trash" type="button">
																							<i class="fa-solid fa-trash-can"></i>
																						</button>
																					</div>
																				</div>
																				@include('claim.finance.modals.update_payment_invoice', ['invoice' => $itemInvoice])
																			</div>
																		</td>
																	</tr>
																@endforeach
																<tr> 
																	<td>- оплата</td>
																	<td>16.03.2023 в 18:27</td>
																	<td></td>
																	<td>+ 151 300,00 ₽ / 1 939,25 $</td>
																	<td> 
																	</td>
																	<td> 
																		<div class="table__actions"> 
																		<div class="table__buttons">
																				<button class="btn-pen" type="button" data-bs-toggle="tooltip" title="Редактировать счет"><i class="fa-solid fa-pen"></i></button>
																				<button class="btn-trash" type="button" data-bs-toggle="tooltip" title="Удалить счет"><i class="fa-solid fa-trash-can"></i></button>
																		</div>
																		</div>
																	</td>
																</tr>
															</tbody>
														</table>
													</div>
													@endif
												</div>
												<div class="item-group__box">
													<div class="item-group__row"> 
														<div class="item-group__col">
															<div class="text-label">
																<span>Долг туриста</span>
																<span> по установленному ТА</span>
															</div>
															<div>
																<span class="text-label">КУРСУ</span>
																<button class="btn-blue btn-redact" type="button">
																	{{$claim->payment && $claim->payment->tourist_course 
																	? $claim->payment->tourist_course . '₽' : ''}}
																	
																</button>
															</div>
														</div>
														<div class="item-group__col">
															<span class="fw-700" style="color: #659f13;">0,28 ₽</span>
														</div>
													</div>
												</div>
												<div class="item-group__footer">
													<button class="btn btn-blue btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#addPayTourist">
														<i class="fa-regular fa-plus"></i>
														Платеж от туриста
													</button>
													<button class="btn btn-blue btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#paymentInvoice">
														Выставить счет туристу
													</button>
												</div>
											</div>
											<div class="group-data__item item-group">
												<div class="item-group__top"> 
													<div class="item-group__title">ФИНАНСОВЫЕ РАСЧЁТЫ</div>
												</div>
												<div class="item-group__main">
													<div class="item-group__box finance-box">
														<div class="item-group__heading">
															<div class="item-group__buttons">
																<button class="isActive btn-blue btn-redact" type="button" id="finance-price">
																	СЕБЕСТОИМОСТЬ
																	<i class="fa-solid fa-chevron-down icon-arrow"></i>
																</button>
																<div>
																	<button class="item-group__button btn-blue btn-redact" type="button" data-bs-toggle="modal" data-bs-target="#parametersPayment">
																		[параметры]
																	</button>
																</div>
															</div>
															<div class="item-group__prices">
																<span class="item-group__price fw-700">Не указана</span>
																{{-- <span>/</span>
																<span class="item-group__price">0,00 $</span> --}}
															</div>
														</div>
														<div class="finance-price-content">
															<ul class="item-group__list list">
																{{-- <li>
																	<div class="list__label">КОМИССИЯ ТА, %</div>
																	<div class="list__value">7,00 %</div>
																</li> --}}
																<li>
																	<div class="list__label">СТОИМОСТЬ ТУРПАКЕТА ДЛЯ ТА</div>
																	<div class="list__value">
																		@if ($claim->payment)
																			{{$claim->payment->tour_price ?: '0'}}
																			@switch($claim->payment->currency)
																				@case('USD')
																					$
																					@break
																				@case('EUR')
																					€
																					@break
																				@default
																					₽
																			@endswitch
																		@else
																			0 ₽
																		@endif
																	</div>
																</li>
																<li>
																	<div class="list__label">СТОИМОСТЬ ТУРА ДЛЯ ТУРИСТА</div>
																	<div class="list__value">
																		@if ($claim->payment)
																			{{$claim->payment->comission_price ?: '0'}}
																			@switch($claim->payment->currency)
																				@case('USD')
																					$
																					@break
																				@case('EUR')
																					€
																					@break
																				@default
																					₽
																			@endswitch
																		@else
																			0 ₽
																		@endif
																	</div>
																</li>
																<li>
																	<div class="list__label">- КОМИССИОННАЯ</div>
																	<div class="list__value">
																		@if ($claim->payment)
																			{{$claim->payment->comission_price ?: '0'}}
																			@switch($claim->payment->currency)
																				@case('USD')
																					$
																					@break
																				@case('EUR')
																					€
																					@break
																				@default
																					₽
																			@endswitch
																		@else
																			0 ₽
																		@endif
																	</div>
																</li>
																{{-- <li>
																	<div class="list__label">- НЕКОМИССИОННАЯ</div>
																	<div class="list__value">0,00 $</div>
																</li> --}}
																{{-- <li>
																	<div class="list__label">СТОИМОСТЬ ДОПОЛНИТЕЛЬНЫХ УСЛУГ</div>
																	<div class="list__value">0,00 $</div>
																</li>
																<li>
																	<div class="list__label">ОПЛАЧЕНО ПОСТАВЩИКУ</div>
																	<div class="list__value">0,00 ₽</div>
																</li> --}}
															</ul>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="tabs-claim__data data-claim tabs-content" data-tab-content="contract">
							<div class="data-claim-groups"> 
								<div class="data-claim__group">
									<div class="row"> 
										<div class="col col-lg-4 col-12">
											<div class="field-group__item">
												<label class="field-group__label">Выберите тип договора</label>
												<select class="select-choices" name="choice_type_doc" id="choiceTypeDoc">
													<option value="" selected></option>
													<option value="doc_avia">Авиатуры</option>
													<option value="doc_bus">Автобусные туры</option>
												</select>
											</div>
											<div class="geneator-button-wrapper mt-3">
												<button class="btn btn-blue btn-primary btn-sm" type="button">
													<i class="btn-generator-doc"></i>
													Сформировать договор
												</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
@section('page-modal')
	@include('claim.showmodals.comment')
	@include('claim.showmodals.touroperator')
	@include('claim.showmodals.tourpackage')
	@include('claim.showmodals.contract')
	@include('claim.showmodals.customer')
	@include('claim.showmodals.file')

	@include('claim.tourists.modals.create_tourist')

	@include('claim.services.modals.flights')
	@include('claim.services.modals.insurance')
	@include('claim.services.modals.transfer')
	@include('claim.services.modals.visa')
	@include('claim.services.modals.habitation')
	@include('claim.services.modals.fuelsurchange')
	@include('claim.services.modals.excursion')
	@include('claim.services.modals.other')

	@include('claim.finance.modals.prepayment')
	@include('claim.finance.modals.payment')
	@include('claim.finance.modals.payment_invoice')

@endsection
@section('page-script')
@endsection