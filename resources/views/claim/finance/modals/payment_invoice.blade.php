@component('components.modal')
	@slot('modal_id', 'paymentInvoice')
	@slot('modal_title', 'Счет на оплату')
	@slot('modal_class', null)
	<form action="{{route('payment_invoice.store')}}" method="post" id="formPaymentInvoice" class="form">
		@csrf
		<input type="hidden" name="claim_id" value="{{$claim->id}}">
		<div class="modal__body">
			<div class="field-group">
				<div class="row">
					<div class="col-lg-3">
						<div class="field-group__item">
							<label class="field-group__label">Расчет</label>
							<select class="select-choices" name="calculate" id="exposeCalculate">
								{{-- @php
									$calculations = FinanceHelper::calculation();
								@endphp
								@foreach ($calculations as $key => $item)
									<option
										value="{{$item['value']}}">
										{{$item['title']}}
									</option>
								@endforeach --}}
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-3">
						<div class="field-group__item">
							<label class="field-group__label">Сумма платежа в счете</label>
							<div class="field-group__box">
								<input class="field-group__input" type="text" data-name="expose_payment_sum" name="sum" data-number>
							</div>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="field-group__item">
							<label class="field-group__label">Валюта платежа</label>
							<select class="select-choices" name="currency" id="exposeCurrency">
								{{-- @php
									$currencies = FinanceHelper::currency();
								@endphp
								@foreach ($currencies as $key => $currency)
									<option
										value="{{$currency['value']}}">
										{{$currency['title']}}
									</option>
								@endforeach --}}
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-4">
						<div class="field-group__item">
							<label class="field-group__label">Дата и время счёта</label>
							<div class="field-group__box">
								<input class="field-group__input" type="text" data-name="date" data-format="datetime" name="date_invoices">
								<div class="field-group__trigger">
									<i class="fa-regular fa-calendar-days calendar-icon"></i>
									<input class="input-trigger" type="text" data-trigger="date">
								</div>
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
					Сохранить
				</button>
				<button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Закрыть</button>
			</div>
		</div>
	</form>
@endcomponent
