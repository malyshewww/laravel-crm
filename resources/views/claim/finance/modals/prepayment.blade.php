@component('components.modal')
	@slot('modal_id', 'prepaymentParameters')
	@slot('modal_title', 'Параметры предоплаты')
	@slot('modal_class', ' modal-small')
	<form action="" method="post" id="formPrepayment" class="form">
		@csrf
		<input type="hidden" name="claim_id" value="">
		<div class="modal__body"></div>
		@include('components.modal_footer')
	</form>
@endcomponent
