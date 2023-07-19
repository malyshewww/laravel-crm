@component('components.modal')
	@slot('modal_id', 'tourpackageModal')
	@slot('modal_title', 'Турпакет')
	@slot('modal_class', null)
	<form action="" method="post" id="formTourpackage">
		@csrf
		<input type="hidden" name="claim_id" value="">
		<div class="modal__body"></div>
		@include('components.modal_footer')
	</form>
@endcomponent