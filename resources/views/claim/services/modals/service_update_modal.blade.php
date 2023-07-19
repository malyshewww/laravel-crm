@component('components.modal')
	@slot('modal_id', 'serviceUpdateModal')
	@slot('modal_title', null)
	@slot('modal_class', ' modal-extended')
	<form action="" method="post" id="formServiceUpdate">
		@csrf
		@method('patch')
		<input type="hidden" name="claim_id" value="{{$claim->id}}">
		<div class="modal__body"></div>
		@include('components.modal_footer')
	</form>
@endcomponent
