@component('components.modal')
	@slot('modal_id', 'parametersPayment')
	@slot('modal_title', 'Параметры стоимости')
	@slot('modal_class', ' modal-parameters')
	<form action="" method="post" id="formPayment">
		@csrf
		<input type="hidden" name="claim_id" value="">
		<div class="modal__body"></div>
		@include('components.modal_footer')
	</form>
@endcomponent
