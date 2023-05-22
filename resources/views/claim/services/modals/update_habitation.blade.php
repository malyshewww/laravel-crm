<div class="modal fade modal-extended" id="updateHabitation-{{$habitation->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content modal__content">
			<div class="modal__header">
				<div class="modal__title">Проживание (редактирование)</div>
				<button class="modal__close" type="button" data-bs-dismiss="modal" aria-label="Close">
					<i class="fa-solid fa-xmark"></i>
				</button>
			</div>
			<form action="{{route('habitation.update')}}" method="post" id="formHabitationUpdate-{{$habitation->id}}" class="form">
				@csrf
				@method('patch')
				<input type="hidden" name="type" value="habitation">
				<input type="hidden" name="claim_id" value="{{$claim->id}}">
				<input type="hidden" name="habitation_id" value="{{$habitation->id}}">
				<div class="modal__body">
					<div class="field-group"> 
						<div class="row">
							<div class="col-12"> 
								<div class="field-group__item">
									<label class="field-group__label">Название</label>
									<div class="field-group__box">
										<input class="field-group__input" type="text" name="habitation_name"
										value="{{$habitation->habitation_name ?: ''}}">
									</div>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="field-group__item">
									<label class="field-group__label">Курорт</label>
									<div class="field-group__box">
										<input class="field-group__input" type="text" name="habitation_resort"
										value="{{$habitation->habitation_resort ?: ''}}">
									</div>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="field-group__item">
									<label class="field-group__label">Отель</label>
									<div class="field-group__box">
										<input class="field-group__input" type="text" name="habitation_hotel"
										value="{{$habitation->habitation_hotel ?: ''}}">
									</div>
								</div>
							</div>
							<div class="col-12">
								<div class="field-group__item">
									<label class="field-group__label">Адрес отеля</label>
									<div class="field-group__box">
										<input class="field-group__input" type="text" name="habitation_hotel_address"
										value="{{$habitation->habitation_hotel_address ?: ''}}">
									</div>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="field-group__item">
									<label class="field-group__label">Тип номера</label>
									<div class="field-group__box">
										<input class="field-group__input" type="text" name="habitation_type_number"
										value="{{$habitation->habitation_type_number ?: ''}}">
									</div>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="field-group__item">
									<label class="field-group__label">Тип размещения</label>
									<div class="field-group__box">
										<input class="field-group__input" type="text" name="habitation_type_placement"
										value="{{$habitation->habitation_type_placement ?: ''}}">
									</div>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="field-group__item">
									<label class="field-group__label">Тип питания</label>
									<select class="select-choices" name="habitation_type_food">
										<option value="" selected></option>
										@php
											$habitationFoodTypes = ServiceHelper::habitationFoodType();
										@endphp
										@foreach ($habitationFoodTypes as $type)
											<option
												{{$type['value'] === $habitation->habitation_type_food ? ' selected' : ''}}
												value="{{$type['value']}}">
												{{$type['title']}}
											</option>
										@endforeach
									</select>
								</div>
							</div>
							@php
								$start_ts = strtotime($habitation->datehabitation_start ? $habitation->datehabitation_start : '');
								$end_ts = strtotime($habitation->datehabitation_end ? $habitation->datehabitation_end : '');
								$date_start_format = date('Y-m-d H:i', $start_ts);
								$date_end_format = date('Y-m-d H:i', $end_ts);
							@endphp
							<div class="col-lg-3">
								<div class="field-group__item">
									<label class="field-group__label">Время заезда</label>
									<div class="field-group__box">
										<input class="field-group__input" type="text" 
										data-name="date_start" data-format="datetime"
										name="datehabitation_start"
										value="{{$start_ts ? $date_start_format : ''}}">
										<div class="field-group__trigger">
											<i class="fa-regular fa-calendar-days calendar-icon"></i>
											<input class="input-trigger" type="text" data-trigger="date_start">
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="field-group__item">
									<label class="field-group__label">Время выезда</label>
									<div class="field-group__box">
										<input class="field-group__input" type="text" 
										data-name="date_end" data-format="datetime"
										name="datehabitation_end"
										value="{{$end_ts ? $date_end_format : ''}}">
										<div class="field-group__trigger">
											<i class="fa-regular fa-calendar-days calendar-icon"></i>
											<input class="input-trigger" type="text" data-trigger="date_end">
										</div>
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