@component('components.modal')
	@slot('modal_id', 'contractModal')
	@slot('modal_title', 'Договор')
	@slot('modal_class', null)
	<form action="" method="post" id="formContract">
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