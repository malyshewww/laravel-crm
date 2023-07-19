@component('components.modal')
	@slot('modal_id', 'updatePaymentInvoice')
	@slot('modal_title', 'Счет на оплату')
	@slot('modal_class', null)
	<form action="" method="post" id="formPaymentInvoiceUpdate">
		@csrf
		@method('patch')
		<input type="hidden" name="claim_id" value="">
		<input type="hidden" name="record_id" value="">
		<div class="modal__body"></div>
		@include('components.modal_footer')
	</form>
@endcomponent
