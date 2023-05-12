<div class="modal fade" id="docModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
	<div class="modal-content modal__content">
		<div class="modal__header">
			<div class="modal__title"> Статус отправки документов</div>
			<button class="modal__close" type="button" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
		</div>
		<div class="modal__body">
			<div class="field-group">
			<div class="row justify-content-center">
				<div class="col-12">
					<div class="field-group__item">
						<label class="field-group__label">Статус отправки документов</label>
						<select class="select-choices" name="statusDocs">
							<option value="" selected></option>
							<option value="Не отправлены">Не отправлены</option>
							<option value="Отправлены частично">Отправлены частично</option>
							<option value="Отправлены">Отправлены</option>
						</select>
					</div>
				</div>
			</div>
			</div>
		</div>
		<div class="modal__footer">
			<div class="modal__buttons">
			<button class="btn btn-create btn-primary" type="button"><i class="fa-solid fa-check"></i>Сохранить</button>
			<button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Закрыть</button>
			</div>
		</div>
	</div>
	</div>
</div>
<div class="modal fade modal-small" id="prepaymentParameters" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
	<div class="modal-content modal__content">
		<div class="modal__header">
			<div class="modal__title">Параметры предоплаты</div>
			<button class="modal__close" type="button" data-bs-dismiss="modal" aria-label="Close">
				<i class="fa-solid fa-xmark"></i>
			</button>
		</div>
		<div class="modal__body">
			<div class="field-group"> 
				<div class="row">
					<div class="col-12"> 
						<div class="field-group__item">
							<label class="field-group__label">Предоплата не менее, %</label>
							<div class="field-group__box">
								<input class="field-group__input" type="text" name="prepayment_percent">
							</div>
						</div>
					</div>
					<div class="col-12"> 
						<div class="field-group__item">
							<label class="field-group__label">Полная оплата не позднее, дней</label>
							<div class="field-group__box">
								<input class="field-group__input" type="text" name="prepayment_days">
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
	</div>
	</div>
</div>
<div class="modal fade" id="exposePayment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
	<div class="modal-content modal__content">
		<div class="modal__header">
			<div class="modal__title"> Счет на оплату</div>
			<button class="modal__close" type="button" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
		</div>
		<div class="modal__body">
			<div class="field-group">
			<div class="row">
				<div class="col-lg-3">
					<div class="field-group__item">
						<label class="field-group__label">Расчет</label>
						<select class="select-choices" name="expose_calculate" id="exposeCalculate">
							<option value="" selected></option>
							<option value="cash">Наличный</option>
							<option value="noncash">Безналичный</option>
						</select>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-3">
					<div class="field-group__item">
						<label class="field-group__label">Сумма платежа в счете</label>
						<div class="field-group__box">
							<input class="field-group__input" type="number" data-name="expose_payment_sum" name="expose_payment_sum">
						</div>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="field-group__item">
					<label class="field-group__label">Валюта платежа</label>
					<select class="select-choices" name="expose_currency" id="exposeCurrency">
						<option value="" selected>
							<option value="RUB" selected>RUB</option>
							<option value="USD">USD</option>
							<option value="EUR">EUR</option>
						</option>
					</select>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4">
					<div class="field-group__item">
						<label class="field-group__label">Дата и время счёта</label>
						<div class="field-group__box">
							<input class="field-group__input" type="text" name="date">
							<div class="field-group__trigger"><i class="fa-regular fa-calendar-days calendar-icon"></i>
							<input class="input-trigger" type="text" data-id="date">
							</div>
						</div>
					</div>
				</div>
			</div>
			</div>
		</div>
		<div class="modal__footer">
			<div class="modal__buttons">
			<button class="btn btn-create btn-primary" type="button"><i class="fa-solid fa-check"></i>Сохранить</button>
			<button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Закрыть</button>
			</div>
		</div>
	</div>
	</div>
</div>
<div class="modal fade modal-parameters" id="parametersPayment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
	<div class="modal-content modal__content">
		<div class="modal__header">
			<div class="modal__title"> Параметры стоимости</div>
			<button class="modal__close" type="button" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
		</div>
		<div class="modal__body">
			<div class="parameters-payment">
			<div class="parameters-payment__row">
				<div class="parameters-payment__col">
					<div class="field-group__item">
					<label class="field-group__label">Валюта турпакета</label>
					<select class="select-choices" name="tourpackage_currency" id="tourPackageCurrency">
						<option value="" selected>
							<option value="RUB" selected>RUB</option>
							<option value="USD">USD</option>
							<option value="EUR">EUR</option>
						</option>
					</select>
					</div>
				</div>
				<div class="parameters-payment__col">
					<div class="field-group__item">
						<label class="field-group__label">Курс для туриста</label>
						<div class="field-group__box">
							<input class="field-group__input" type="text" data-name="parameters_course_tourist" name="parameters_course_tourist">
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
						<label class="field-group__label">RUB</label>
						<div class="field-group__box">
							<input class="field-group__input" type="text" name="parameters_tour_price">
						</div>
					</div>
				</div>
				<div class="parameters-payment__col">
					<div class="text-label">Комиссионная часть</div>
				</div>
				<div class="parameters-payment__col parameters-price">
					<div class="field-group__item">
						<label class="field-group__label">RUB</label>
						<div class="field-group__box">
							<input class="field-group__input" type="text" name="parameters_comission_price">
						</div>
					</div>
				</div>
			</div>
			</div>
		</div>
		<div class="modal__footer">
			<div class="modal__buttons">
			<button class="btn btn-create btn-primary" type="button"><i class="fa-solid fa-check"></i>Сохранить</button>
			<button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Закрыть</button>
			</div>
		</div>
	</div>
	</div>
</div>
<div class="modal fade modal-small" id="addPayTourist" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
	<div class="modal-content modal__content">
		<div class="modal__header">
			<div class="modal__title"> Платеж от туриста</div>
			<button class="modal__close" type="button" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
		</div>
		<div class="modal__body">
			<div class="field-group">
			<div class="row align-items-end">
				<div class="col-3">
					<div class="field-group__item">
						<label class="field-group__label">Cумма оплаты <strong>RUB</strong></label>
						<div class="field-group__box">
							<input class="field-group__input" type="text" name="sum_payment_tourist">
						</div>
					</div>
				</div>
				<div class="col-1"><span class="math-icon">	<i class="fa-solid fa-divide"></i></span></div>
				<div class="col-3">
					<div class="field-group__item">
						<label class="field-group__label">Курс <strong>EUR</strong></label>
						<div class="field-group__box">
							<input class="field-group__input" type="text" name="course_for_tourist">
						</div>
					</div>
				</div>
				<div class="col-1"><span class="math-icon">	<i class="fa-solid fa-equals"></i></span></div>
				<div class="col-4">
					<div class="field-group__item">
						<label class="field-group__label">Cумма <strong>EUR</strong></label>
						<div class="field-group__box">
							<input class="field-group__input" type="text" name="sum_eur_tourist">
						</div>
					</div>
				</div>
			</div>
			<div class="row"> 
				<div class="col-lg-4">
					<div class="field-group__item">
						<label class="field-group__label">Дата и время платежа</label>
						<div class="field-group__box">
							<input class="field-group__input" type="text" name="pay_date">
							<div class="field-group__trigger"><i class="fa-regular fa-calendar-days calendar-icon"></i>
							<input class="input-trigger" type="text" data-id="pay_date">
							</div>
						</div>
					</div>
				</div>
			</div>
			</div>
		</div>
		<div class="modal__footer">
			<div class="modal__buttons">
			<button class="btn btn-create btn-primary" type="button"><i class="fa-solid fa-check"></i>Сохранить</button>
			<button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Закрыть</button>
			</div>
		</div>
	</div>
	</div>
</div>