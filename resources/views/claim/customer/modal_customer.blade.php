@component('components.modal')
	@slot('modal_id', 'addCustomer')
	@slot('modal_title', 'Заказчик')
	@slot('modal_class', ' modal-extended')
	<form action="{{route('customer.store', $claim->id)}}" method="post" id="formCustomer">
		@csrf
		<input type="hidden" name="claim_id" value="{{$claim->id}}">
		<input type="hidden" name="person_id" value="{{$claim->id}}">
		<input type="hidden" name="company_id" value="{{$claim->id}}">
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