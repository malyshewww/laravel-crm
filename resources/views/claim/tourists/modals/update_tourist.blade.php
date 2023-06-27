@component('components.modal')
	@slot('modal_id', 'updateTourist')
	@slot('modal_title', 'Турист (редактирование)')
	@slot('modal_class', ' modal-extended')
	<form action="" method="post" id="formTouristUpdate">
		@csrf
		@method('PATCH')
		<input type="hidden" name="claim_id" value="">
		<input type="hidden" name="tourist_id" value="">
		<div class="modal__body"></div>
		@include('components.modal_footer')
	</form>
@endcomponent

