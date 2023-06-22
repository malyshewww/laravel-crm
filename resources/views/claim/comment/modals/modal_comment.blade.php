@component('components.modal')
	@slot('modal_id', 'commentModal')
	@slot('modal_title', 'Комментарий')
	@slot('modal_class', null)
	<form action="{{route('claim.update', $claim->id)}}" method="post" id="formComment">
		@csrf
		{{-- @method('patch') --}}
		<input type="hidden" name="id" value="{{$claim->id}}">
		<div class="modal__body"></div>
		<div class="modal__footer">
			<div class="modal__buttons">
				<button class="btn btn-create btn-primary" type="submit">
					<i class="fa-solid fa-check"></i>
					Сохранить
				</button>
				<button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Закрыть</button>
			</div>
		</div>
	</form>
@endcomponent