<div class="modal fade modal-extended" id="addCustomer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content modal__content">
			<div class="modal__header">
				<div class="modal__title">Заказчик</div>
				<button class="modal__close" type="button" data-bs-dismiss="modal" aria-label="Close">
					<i class="fa-solid fa-xmark"></i>
				</button>
			</div>
			<form action="{{route('customer.store', $claim->id)}}" method="post" id="formCustomer">
				@csrf
				<input type="hidden" name="claim_id" value="{{$claim->id}}">
				<input type="hidden" name="person_id" value="{{$claim->id}}">
				<input type="hidden" name="customer_id" value="{{$claim->id}}">
				<input type="hidden" name="company_id" value="{{$claim->id}}">
				<div class="modal__body"></div>
			</form>
		</div>
	</div>
</div>