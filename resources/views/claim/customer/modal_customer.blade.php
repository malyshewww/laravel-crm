@component('components.modal')
	@slot('modal_id', 'addCustomer')
	@slot('modal_title', 'Заказчик')
	@slot('modal_class', ' modal-extended')
	<form id="my-form"></form>
	<form action="" 
		method="post" id="formCustomer">
		@csrf
		<input type="hidden" name="claim_id" value="{{$claim->id}}">
		<input type="hidden" name="person_id" value="{{$claim->id}}">
		<input type="hidden" name="company_id" value="{{$claim->id}}">
		<div class="modal__body"></div>
		@include('components.modal_footer')
	</form>
@endcomponent