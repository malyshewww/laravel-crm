@component('components.modal')
	@slot('modal_id', 'prepaymentParameters')
	@slot('modal_title', 'Параметры предоплаты')
	@slot('modal_class', ' modal-small')
	<form action="" method="post" id="formPrepayment" class="form">
		@csrf
		<input type="hidden" name="claim_id" value="">
		<div class="modal__body"></div>
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
