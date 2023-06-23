@component('components.modal')
	@slot('modal_id', 'deleteRecord')
	@slot('modal_title', 'Вы действительно хотите удалить запись?')
	@slot('modal_class', ' modal-small')
	<div class="modal__body">
		<form action="#" method="post">
			@csrf
			@method('delete')
			<input type="hidden" name="claim_id" value="">
			<div class="row justify-content-center">
				<div class="col-4">
					<button class="btn btn-danger" type="submit">Да</button>
				</div>
				<div class="col-4">
					<button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Нет</button>
				</div>
			</div>
		</form>
	</div>
@endcomponent
