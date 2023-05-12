<div class="modal fade" id="contractModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content modal__content">
			<div class="modal__header">
				<div class="modal__title">Договор</div>
				<button class="modal__close" type="button" data-bs-dismiss="modal" aria-label="Close">
					<i class="fa-solid fa-xmark"></i>
				</button>
			</div>
			<form action="{{route('contract.store', $claim->id)}}" method="post" id="formContract" class="form">
				@csrf
				<input type="hidden" name="claim_id" value="{{$claim->id}}">
				<div class="modal__body">
					<div class="field-group">
						<div class="row">
							<div class="col-lg-4">
								<div class="field-group__item">
									<label class="field-group__label">Дата договора</label>
									<div class="field-group__box">
										<input class="field-group__input" type="text" data-name="date" data-format="date"
										value="{{$claim->contract && $claim->contract->date  ? $claim->contract->date->format('Y-m-d') : ''}}">
										<div class="field-group__trigger">
											<i class="fa-regular fa-calendar-days calendar-icon"></i>
											<input class="input-trigger" type="text" data-trigger="date">
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="field-group__item">
									<label class="field-group__label">Номер брони</label>
									<div class="field-group__box">
										<input class="field-group__input" type="text" name="number" value="{{$claim->contract ? $claim->contract->number : ''}}">
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