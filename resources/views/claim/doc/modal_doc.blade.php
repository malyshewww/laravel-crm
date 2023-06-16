@component('layout.modal')
	@slot('modal_id', 'docModal')
	@slot('modal_class', null)
	<x-slot name="modal_title">
		Статус отправки документов
	</x-slot>
	<form action="" id="formStatusDoc" method="post">
		@csrf
		<input type="hidden" name="claim_id" value="{{$claim->id}}">
		<div class="modal__body"></div>
		<div class="modal__footer">
			<div class="modal__buttons">
				<button class="btn btn-create btn-primary" type="submit"><i class="fa-solid fa-check"></i>Сохранить</button>
				<button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Закрыть</button>
			</div>
		</div>
	</form>
@endcomponent