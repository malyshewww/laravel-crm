<div class="group-data__item item-group" id="groupDataCalculation">
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
					{{-- <span class="item-group__price">151 300,28 ₽</span>
					<span>/</span>
					<span class="item-group__price">1 939,25 $</span> --}}
				</div>
			</div>
			<div class="tourist-price-content" hidden>
				@php
					$arrList = [
						['title' => 'СТОИМОСТЬ ТУРПАКЕТА ПО КАТАЛОГУ'],
						['title' => '- КОМИССИОННАЯ']
					];
				@endphp
				<ul class="item-group__list list">
					{{-- <li>
						<div class="list__label">СКИДКА ДЛЯ ПОКУПАТЕЛЯ (ТУРИСТА)</div>
						<div class="list__value">0,0 %</div>
					</li> --}}
					@foreach ($arrList as $item)
					<li>
						<div class="list__label">{{$item['title']}}</div>
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
					@endforeach
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
							<td>№ {{$claim->id}}-{{date('Y')}}-{{$key+1}}</td>
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
												data-bs-toggle="modal" data-bs-target="#modalAction"
												data-method="DELETE"
												data-type="delete" 
												data-id="{{$itemInvoice->id}}" 
												data-url="{{route('payment_invoice.destroy', $itemInvoice->id)}}" 
												data-title="Вы действительно хотите удалить счёт № {{$claim->id}}-{{date('Y')}}-{{$itemInvoice->id}}?">
												<i class="fa-solid fa-trash-can"></i>
											</button>
										</div>
									</div>
								</div>
							</td>
						</tr>
					@endforeach
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
<div class="group-data__item item-group" id="groupDataCost">
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
					@php
						$arrList = [
							['title' => 'СТОИМОСТЬ ТУРА ДЛЯ ТУРИСТА'],
							['title' => '- КОМИССИОННАЯ']
						];
					@endphp
					@foreach ($arrList as $item)
						<li>
							<div class="list__label">{{$item['title']}}</div>
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
					@endforeach
				</ul>
			</div>
		</div>
	</div>
</div>