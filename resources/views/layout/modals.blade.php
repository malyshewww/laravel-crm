@component('layout.modal')
	@slot('modal_id', 'docModal')
	@slot('modal_title', 'Статус отправки документов')
	@slot('modal_class', null)
	<form action="#">
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
				<button class="btn btn-create btn-primary" type="submit"><i class="fa-solid fa-check"></i>Сохранить</button>
				<button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Закрыть</button>
			</div>
		</div>
	</form>
@endcomponent
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
							<input class="field-group__input" type="text" data-name="date" data-format="date" name="pay_date">
							<div class="field-group__trigger"><i class="fa-regular fa-calendar-days calendar-icon"></i>
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
			<button class="btn btn-create btn-primary" type="submit"><i class="fa-solid fa-check"></i>Сохранить</button>
			<button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Закрыть</button>
			</div>
		</div>
	</div>
	</div>
</div>