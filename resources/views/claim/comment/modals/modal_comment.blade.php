@component('components.modal')
	@slot('modal_id', 'commentModal')
	@slot('modal_title', 'Комментарий')
	@slot('modal_class', null)
	<form action="{{route('claim.update', [$claim->id, request()->get('status')])}}" method="post" id="formComment">
		@csrf
		{{-- @method('patch') --}}
		<input type="hidden" name="id" value="{{$claim->id}}">
		<div class="modal__body"></div>
		@include('components.modal_footer')
	</form>
@endcomponent