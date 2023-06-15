<div class="parameters-payment">
	<div class="parameters-payment__row">
		<div class="parameters-payment__col">
			<div class="field-group__item">
				<label class="field-group__label">Валюта турпакета</label>
				<select data-select name="currency" data-id="tourPackageCurrency">
					@php
						$currencies = FinanceHelper::currency();
					@endphp
					@foreach ($currencies as $key => $currency)
						<option
							{{$payment && $payment->currency === $currency['value'] ? ' selected' : ''}}
							value="{{$currency['value']}}">
							{{$currency['title']}}
						</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="parameters-payment__col">
			<div class="field-group__item"{{$payment && $payment->currency === 'RUB' ? ' hidden' : 'hidden'}}>
				<label class="field-group__label">Курс для туриста</label>
				<div class="field-group__box">
					<input class="field-group__input" type="text" data-name="parameters_course_tourist" 
					name="tourist_course" data-number
					value="{{$payment && $payment->tourist_course ? $payment->tourist_course : old('tourist_course')}}">
				</div>
			</div>
		</div>
	</div>
	<hr class="line-dashed">
	<div class="parameters-payment__row">
		<div class="parameters-payment__col">
			<div class="text-label">Цена тура для ТА</div>
		</div>
		<div class="parameters-payment__col parameters-price">
			<div class="field-group__item">
				<label class="field-group__label">
					{{$payment && $payment->currency ? $payment->currency : 'RUB'}}
				</label>
				<div class="field-group__box">
					<input class="field-group__input" type="text" name="tour_price" data-number
					value="{{$payment && $payment->tour_price ? $payment->tour_price : ''}}">
				</div>
			</div>
		</div>
		<div class="parameters-payment__col">
			<div class="text-label">Комиссионная часть</div>
		</div>
		<div class="parameters-payment__col parameters-price">
			<div class="field-group__item">
				<label class="field-group__label">
					{{$payment && $payment->currency ? $payment->currency : 'RUB'}}
				</label>
				<div class="field-group__box">
					<input class="field-group__input" type="text" name="comission_price" data-number
					value="{{$payment && $payment->comission_price ? $payment->comission_price : ''}}">
				</div>
			</div>
		</div>
	</div>
</div>