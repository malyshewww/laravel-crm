@component('components.modal')
	@slot('modal_id', 'modal_lock')
	@slot('modal_title', null)
	@slot('modal_class', ' modal-small')
	<div class="modal__body">
		<div class="alert alert-danger" role="alert">
			Вы не можете создавать и редактировать записи других пользователей
		</div>
	</div>
@endcomponent
