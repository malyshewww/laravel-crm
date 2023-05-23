<div class="modal fade modal-extended" id="addTransfer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content modal__content">
			<div class="modal__header">
				<div class="modal__title">Трансфер (добавление)</div>
				<button class="modal__close" type="button" data-bs-dismiss="modal" aria-label="Close">
					<i class="fa-solid fa-xmark"></i>
				</button>
			</div>
			<form action="{{route('transfer.store')}}" method="post" id="formTransfer" class="form">
				@csrf
				<input type="hidden" name="type" value="transfer">
				<input type="hidden" name="claim_id" value="{{$claim->id}}">
				<div class="modal__body">
					<div class="field-group"> 
						<div class="row">
							<div class="col-lg-6">
								<div class="field-group__item">
									<label class="field-group__label">Маршрут</label>
									<div class="field-group__box">
										<input class="field-group__input" type="text" name="transfer_route">
									</div>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="field-group__item">
									<label class="field-group__label">Начало</label>
									<div class="field-group__box">
										<input class="field-group__input" type="text" data-name="date_start" data-format="date" name="datetransfer_start"
										>
										<div class="field-group__trigger">
											<i class="fa-regular fa-calendar-days calendar-icon"></i>
											<input class="input-trigger" type="text" data-trigger="date_start">
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="field-group__item">
									<label class="field-group__label">Окончание</label>
									<div class="field-group__box">
										<input class="field-group__input" type="text" data-name="date_end" data-format="date" name="datetransfer_end"
										>
										<div class="field-group__trigger">
											<i class="fa-regular fa-calendar-days calendar-icon"></i>
											<input class="input-trigger" type="text" data-trigger="date_end">
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="field-group__item">
									<label class="field-group__label">Тип трансфера</label>
									<select class="select-choices" name="transfer_type">
										<option value="" selected></option>
										@php
											$transferTypes = ServiceHelper::transferType();
										@endphp
										@foreach ($transferTypes as $transfer)
											<option
												value="{{old($transfer['value']) ?: $transfer['value']}}">
												{{old($transfer['title']) ?: $transfer['title']}}
											</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="field-group__item">
									<label class="field-group__label">Вид транспорта</label>
									<div class="field-group__box">
										<input class="field-group__input" type="text" name="transfer_transport">
									</div>
								</div>
							</div>
							<div class="col-12">
								@include('claim.tourists.list_tourists')
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