<div class="modal fade modal-small" id="prepaymentParameters" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content modal__content">
			<div class="modal__header">
				<div class="modal__title">Параметры предоплаты</div>
				<button class="modal__close" type="button" data-bs-dismiss="modal" aria-label="Close">
					<i class="fa-solid fa-xmark"></i>
				</button>
			</div>
			<form action="{{route('prepayment.store')}}" method="post" id="formPrepayment" class="form">
				@csrf
				<input type="hidden" name="claim_id" value="{{$claim->id}}">
				<div class="modal__body">
					<div class="field-group"> 
						<div class="row">
							<div class="col-12"> 
								<div class="field-group__item">
									<label class="field-group__label">Предоплата не менее, %</label>
									<div class="field-group__box">
										<input class="field-group__input" type="text" name="percent"
										value="{{$claim->prepayment && $claim->prepayment->percent ? $claim->prepayment->percent : '' }}">
									</div>
								</div>
							</div>
							<div class="col-12">
								<div class="field-group__item">
									<label class="field-group__label">Полная оплата не позднее, дней</label>
									<div class="field-group__box">
										<input class="field-group__input" type="number" name="days"
										value="{{$claim->prepayment && $claim->prepayment->days ? $claim->prepayment->days : '' }}">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
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
		</div>
	</div>
</div>