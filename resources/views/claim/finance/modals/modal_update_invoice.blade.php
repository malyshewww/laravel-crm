<div class="field-group">
	<div class="row">
		<div class="col-lg-3">
			<div class="field-group__item">
				<label class="field-group__label">Расчет</label>
				<select data-select name="calculate" id="exposeCalculate">
					@php
						$calculations = FinanceHelper::calculation();
					@endphp
					@foreach ($calculations as $key => $item)
						<option
							{{$itemInvoice->calculate && $item['value'] === $itemInvoice->calculate ? ' selected' : ''}}
							value="{{$item['value']}}">
							{{$item['title']}}
						</option>
					@endforeach
				</select>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-3">
			<div class="field-group__item">
				<label class="field-group__label">Сумма платежа в счете</label>
				<div class="field-group__box">
					<input class="field-group__input" type="number" data-name="expose_payment_sum" name="sum"
					value="{{$itemInvoice->sum ?: ''}}">
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="field-group__item">
				<label class="field-group__label">Валюта платежа</label>
				<select data-select name="currency" id="exposeCurrency">
					@php
						$currencies = FinanceHelper::currency();
					@endphp
					@foreach ($currencies as $key => $currency)
						<option
							{{$itemInvoice->currency && $currency['value'] === $itemInvoice->currency ? ' selected' : ''}}
							value="{{$currency['value']}}">
							{{$currency['title']}}
						</option>
					@endforeach
				</select>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-4">
			<div class="field-group__item">
				<label class="field-group__label">Дата и время счёта</label>
				<div class="field-group__box">
					<input class="field-group__input" type="text" data-name="date" data-format="datetime" name="date_invoices"
					value="{{$itemInvoice->date_invoices ? $itemInvoice->date_invoices->format('Y-m-d H:i') : ''}}">
					<div class="field-group__trigger">
						<i class="fa-regular fa-calendar-days calendar-icon"></i>
						<input class="input-trigger" type="text" data-trigger="date">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>