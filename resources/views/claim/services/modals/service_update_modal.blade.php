@component('layout.modal')
	@slot('modal_id', 'serviceUpdateModal')
	@slot('modal_class', ' modal-extended')
	@slot('modal_title', null)
	<form action="" method="post" id="formServiceUpdate">
		@csrf
		@method('patch')
		<input type="hidden" name="claim_id" value="{{$claim->id}}">
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
