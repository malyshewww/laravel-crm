@component('components.modal')
	@slot('modal_id', 'contractModal')
	@slot('modal_title', 'Договор')
	@slot('modal_class', null)
	<form action="" method="post" id="formContract">
		@csrf
		<input type="hidden" name="claim_id" value="">
		<div class="modal__body"></div>
		@include('components.modal_footer')
	</form>
@endcomponent