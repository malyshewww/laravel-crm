@extends('layouts.app')
@section('title')
	Страница заявки № {{$claim->id}}
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
							<strong>{{Auth::user()->name}}</strong> создана: {{$claim->created_at->format('d.m.Y H:i:s')}} МСК.
						</div>
					</div>
					<div class="claim__comment comment-claim">
						<div class="comment-claim__box">
							<button class="claim__button btn-blue btn-redact" 
								type="button" data-bs-toggle="modal" data-bs-target="#commentModal"
								data-id="{{$claim->id}}" 
								data-type="update"
								data-claim-id="{{$claim->id}}"
								data-url="{{route('claim.store')}}"
								data-path="{{route('claim.loadModal', [$claim->id, 'update'])}}"
								data-title="{{$claim->comment ? 'Комментарий (редактирование)' : 'Комментарий'}}">
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
								{{-- Блок с данными о заказчике --}}
								@include('claim.blocks.block_customers')
								{{-- Блок с данными о туристах --}}
								@include('claim.blocks.block_tourists')
								{{-- Блок с данными об услугах --}}
								@include('claim.blocks.block_services')
								{{-- @include('claim.blocks.block_docstouroperator') --}}

								{{-- Блок с данными о добавленных файлах --}}
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
															data-bs-target="#prepaymentParameters"
															data-id="{{$claim->id}}" 
															data-type="update"
															data-claim-id="{{$claim->id}}"
															data-url="{{route('prepayment.store', $claim->id)}}"
															data-path="{{route('prepayment.loadModal', [$claim->id, 'update'])}}"
															data-title="Параметры предоплаты">
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
																{{-- @if ($claim->payment && $claim->payment->tour_price)
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
																@endif --}}
																стоимость с учетом курса
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
															</ul>
														</div>
													</div>
												</div>
												@if (count($claim->paymentInvoices) > 0)
												<div class="item-group__box">
													<div class="item-group__heading">
														<div class="item-group__button">
															<span class="text-label">ОПЛАЧЕНО ТУРИСТОМ</span>
															<button class="btn-blue btn-redact" type="button" id="history-price">
																ИСТОРИЯ ОПЛАТ
																<i class="fa-solid fa-chevron-down icon-arrow"></i>
															</button>
														</div>
														<div class="item-group__prices">
															@php
																if (count($claim->paymentInvoices) > 0) {
																	$currencyRUB = [];
																	$currencyUSD = [];
																	$currencyEUR = [];
																	foreach ($claim->paymentInvoices as $key => $item) {
																		if ($item->currency === 'RUB') {
																			$currencyRUB[] = $item->sum;
																		} 
																		if ($item->currency === 'USD') {
																			$currencyUSD[] = $item->sum;
																		} 
																		if ($item->currency === 'EUR') {
																			$currencyEUR[] = $item->sum;
																		}
																	}
																	$resultSumRUB = array_sum($currencyRUB);
																	$resultSumUSD = array_sum($currencyUSD);
																	$resultSumEUR = array_sum($currencyEUR);
																}
															@endphp
															<span class="item-group__price">
																@if ($resultSumRUB > 0)
																	<strong>{{$resultSumRUB}} ₽</strong>
																@endif
																@if ($resultSumUSD > 0)
																	/ {{$resultSumUSD}} $
																@endif
																@if ($resultSumEUR > 0)
																	/ {{$resultSumEUR}} €
																@endif
															</span>
														</div>
													</div>
													<div class="table-responsive">
														<table class="table finance-table" id="table-finance" {{count($claim->paymentInvoices) > 0 ? '' : 'hidden'}}>
															<thead> 
																<tr>
																	<th></th>
																	<th style="width: 110px;">ДАТА</th>
																	<th style="width: 110px;">НОМЕР СЧЁТА</th>
																	<th style="width: auto;">СУММА</th>
																	<th style="width: 60px;"></th>
																</tr>
															</thead>
															<tbody>
																@foreach ($claim->paymentInvoices as $key => $itemInvoice)
																	<tr> 
																		<td>cчет</td>
																		<td>
																			{{$itemInvoice->date_invoices ? $itemInvoice->date_invoices->format('d.m.Y H:i') : ''}}
																		</td>
																		<td>№ {{$claim->id}}-{{$key+1}}</td>
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
																			<div class="table__actions"> 
																				<div class="table__buttons">
																					<div class="table__button-item" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Редактировать счет">
																						<button class="btn-pen" type="button" 
																							data-bs-toggle="modal" data-bs-target="#updatePaymentInvoice"
																							data-id="{{$itemInvoice->id}}" 
																							data-type="update"
																							data-claim-id="{{$claim->id}}"
																							data-url="{{route('payment_invoice.update', $itemInvoice->id)}}"
																							data-path="{{route('payment_invoice.loadModal', [$itemInvoice->id, 'update'])}}"
																							data-title="Счёт на оплату (редактирование)">
																							<i class="fa-solid fa-pen"></i>
																						</button>
																					</div>
																					<div class="table__button-item" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Удалить счет">
																						<button class="btn-trash" type="button" 
																							data-bs-toggle="modal" data-bs-target="#deleteRecord"
																							data-type="delete" 
																							data-id="{{$itemInvoice->id}}" 
																							data-url="{{route('payment_invoice.destroy', $itemInvoice->id)}}" 
																							data-title="Вы действительно хотите удалить счёт № {{$claim->id}}-{{$itemInvoice->id}}?">
																							<i class="fa-solid fa-trash-can"></i>
																						</button>
																					</div>
																				</div>
																			</div>
																		</td>
																	</tr>
																@endforeach
																{{-- <tr> 
																	<td>- оплата</td>
																	<td>16.03.2023 в 18:27</td>
																	<td></td>
																	<td>+ 151 300,00 ₽ / 1 939,25 $</td>
																	<td> 
																		<div class="table__actions"> 
																			<div class="table__buttons">
																				<div class="table__button-item" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Редактировать платеж">
																					<button class="btn-pen" type="button">
																						<i class="fa-solid fa-pen"></i>
																					</button>
																				</div>
																				<div class="table__button-item" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Удалить платеж">
																					<button class="btn-trash" type="button">
																						<i class="fa-solid fa-trash-can"></i>
																					</button>
																				</div>
																			</div>
																		</div>
																	</td>
																</tr> --}}
															</tbody>
														</table>
													</div>
												</div>
												@endif
												{{-- <div class="item-group__box">
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
												</div> --}}
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
																	<button class="item-group__button btn-blue btn-redact" type="button" 
																		data-bs-toggle="modal" data-bs-target="#parametersPayment"
																		data-id="{{$claim->id}}" 
																		data-type="update"
																		data-claim-id="{{$claim->id}}"
																		data-url="{{route('payment.store', $claim->id)}}"
																		data-path="{{route('payment.loadModal', [$claim->id, 'update'])}}"
																		data-title="Параметры стоимости">
																		[параметры]
																	</button>
																</div>
															</div>
															<div class="item-group__prices">
																@php
																	$arrPayment = [];
																	if ($claim->payment) {
																		$arrPayment[] = $claim->payment->tour_price ?: 0;
																		$arrPayment[] = $claim->payment->comission_price ?: 0;
																	}
																	$resultPaymentSum = array_sum($arrPayment);
																@endphp
																<span class="item-group__price fw-700">
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
																			Цена не указана
																		@endif
																</span>
																{{-- <span>/</span>
																<span class="item-group__price">0,00 $</span> --}}
															</div>
														</div>
														<div class="finance-price-content">
															<ul class="item-group__list list">
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
											<form action="{{route('docExport')}}" method="post">
												@csrf
												<input type="hidden" name="id" value="{{$claim->id}}">
												<div class="field-group__item">
													<label class="field-group__label">Выберите тип договора</label>
													<select class="select-choices" name="doc_type" id="choiceTypeDoc">
														<option value="" selected></option>
														<option value="doc_avia">Авиатуры</option>
														<option value="doc_bus">Автобусные туры</option>
													</select>
												</div>
												<div class="geneator-button-wrapper mt-3">
													<button class="btn btn-blue btn-primary btn-sm" type="submit">
														<i class="btn-generator-doc"></i>
														Сформировать договор
													</button>
												</div>
											</form>
											{{-- <a href="{{url('docs/doc-export/' . $claim->id)}}">Doc Export</a> --}}
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
	@include('claim.showmodals.file')
	
	@include('claim.customer.modal_customer')
	@include('claim.comment.modals.modal_comment')

	@include('claim.contract.modals.contract')
	@include('claim.touroperator.modals.touroperator')
	@include('claim.tourpackage.modals.tourpackage')

	@include('claim.tourists.modals.create_tourist')
	@include('claim.tourists.modals.update_tourist')

	@include('claim.services.modals.flights')
	@include('claim.services.modals.insurance')
	@include('claim.services.modals.transfer')
	@include('claim.services.modals.visa')
	@include('claim.services.modals.habitation')
	@include('claim.services.modals.fuelsurchange')
	@include('claim.services.modals.excursion')
	@include('claim.services.modals.other')
	@include('claim.services.modals.service_update_modal')

	@include('claim.finance.modals.prepayment')
	@include('claim.finance.modals.payment')
	@include('claim.finance.modals.payment_invoice')
	@include('claim.finance.modals.update_payment_invoice')

	@include('claim.showmodals.delete_record')
@endsection
@section('page-script')
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
@endsection