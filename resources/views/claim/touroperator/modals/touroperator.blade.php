@component('components.modal')
	@slot('modal_id', 'touroperatorModal')
	@slot('modal_title', 'Туроператор - поставщик тура')
	@slot('modal_class', null)
	<form action="" method="post" id="formTouroperator">
		@csrf
		<input type="hidden" name="claim_id" value="">
		<div class="modal__body"></div>
		@include('components.modal_footer')
	</form>
@endcomponent
