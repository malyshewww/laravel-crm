@component('components.modal')
	@slot('modal_id', 'docModal')
	@slot('modal_title', 'Статус отправки документов')
	@slot('modal_class', null)
	<form action="" id="formStatusDoc" method="post">
		@csrf
		<input type="hidden" name="claim_id" value="">
		<div class="modal__body"></div>
		@include('components.modal_footer')
	</form>
@endcomponent