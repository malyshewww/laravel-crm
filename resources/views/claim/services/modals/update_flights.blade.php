<div class="modal fade modal-extended" id="updateFlights-{{$flight->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content modal__content">
			<div class="modal__header">
				<div class="modal__title">Перелет (редактирование)</div>
				<button class="modal__close" type="button" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
			</div>
			<form action="{{route('flight.update')}}" method="post" id="formFlightsUpdate-{{$flight->id}}" class="form">
				@csrf
				@method('patch')
				<input type="hidden" name="type" value="flights">
				<input type="hidden" name="claim_id" value="{{$claim->id}}">
				<input type="hidden" name="flight_id" value="{{$flight->id}}">
				<div class="modal__body">
					<div class="field-group">	
						<div class="row">	
							<div class="col-12">
								<div class="field-group__item">
									<label class="field-group__label">Маршрут</label>
									<div class="field-group__box">
										<input class="field-group__input" type="text" name="flight_route"
										value="{{$flight->flight_route ?: ''}}">
									</div>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="field-group__item">
									<label class="field-group__label">Откуда</label>
									<div class="field-group__box">
										<input class="field-group__input" type="text" name="flight_start"
										value="{{$flight->flight_start ?: ''}}">
									</div>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="field-group__item">
									<label class="field-group__label">Куда</label>
									<div class="field-group__box">
										<input class="field-group__input" type="text" name="flight_end"
										value="{{$flight->flight_end ?: ''}}">
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="field-group__item">
									<label class="field-group__label">Авиакомпания</label>
									<div class="field-group__box">
										<input class="field-group__input" type="text" name="flight_aviacompany"
										value="{{$flight->flight_aviacompany ?: ''}}">
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="field-group__item">
									<label class="field-group__label">Класс</label>
									<select class="select-choices" name="flight_class">
										<option value=""></option>
											@php
												$flightClasses = ServiceHelper::flightClass();
											@endphp
											@foreach ($flightClasses as $class)
												<option
													{{$class['value'] === $flight->flight_class ? ' selected' : ''}}
													value="{{$class['value']}}">
													{{$class['title']}}
												</option>
											@endforeach
										</select>
									</select>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="field-group__item">
									<label class="field-group__label">Номер рейса</label>
									<div class="field-group__box">
										<input class="field-group__input" type="text" name="flight_number"
										value="{{$flight->flight_number ?: ''}}">
									</div>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="field-group__item">
									<label class="field-group__label">Время вылета</label>
									<div class="field-group__box">
										<input class="field-group__input" type="text" 
										data-name="date_start" data-format="datetime"
										name="dateflight_start"
										value="{{$flight->dateflight_start ? $flight->dateflight_start->format('Y-m-d H:i') : ''}}">
										<div class="field-group__trigger">
											<i class="fa-regular fa-calendar-days calendar-icon"></i>
											<input class="input-trigger" type="text" data-trigger="date_start">
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="field-group__item">
									<label class="field-group__label">Время прилета</label>
									<div class="field-group__box">
										<input class="field-group__input" type="text" 
										data-name="date_end" data-format="datetime"
										name="dateflight_end"
										value="{{$flight->dateflight_end ? $flight->dateflight_end->format('Y-m-d H:i') : ''}}">
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