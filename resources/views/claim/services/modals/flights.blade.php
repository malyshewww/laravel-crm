@component('components.modal')
	@slot('modal_id', 'addFlight')
	@slot('modal_title', 'Перелет (добавление)')
	@slot('modal_class', ' modal-extended')
	<form method="post" action="{{route('flight.store')}}" id="formFlights" class="form">
		@csrf
		<input type="hidden" name="type" value="flights">
		<input type="hidden" name="claim_id" value="{{$claim->id}}">
		<div class="modal__body">
			<div class="field-group">	
				<div class="row">	
					<div class="col-12">
						<div class="field-group__item">
							<label class="field-group__label">Маршрут</label>
							<div class="field-group__box">
								<input class="field-group__input" type="text" name="flight_route" autocomplete="off">
							</div>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="field-group__item">
							<label class="field-group__label">Откуда</label>
							<div class="field-group__box">
								<input class="field-group__input" type="text" name="flight_start" autocomplete="off">
							</div>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="field-group__item">
							<label class="field-group__label">Куда</label>
							<div class="field-group__box">
								<input class="field-group__input" type="text" name="flight_end" autocomplete="off">
							</div>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="field-group__item">
							<label class="field-group__label">Авиакомпания</label>
							<div class="field-group__box">
								<input class="field-group__input" type="text" name="flight_aviacompany" autocomplete="off">
							</div>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="field-group__item">
							<label class="field-group__label">Класс</label>
							<select class="select-choices" name="flight_class" id="selectFlightClass">
								{{-- <option value=""></option>
									@php
										$flightClasses = ServiceHelper::flightClass();
									@endphp
									@foreach ($flightClasses as $class)
										<option
											value="{{$class['value']}}">
											{{$class['title']}}
										</option>
									@endforeach --}}
								</select>
							</select>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="field-group__item">
							<label class="field-group__label">Номер рейса</label>
							<div class="field-group__box">
								<input class="field-group__input" type="text" name="flight_number" autocomplete="off">
							</div>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="field-group__item">
							<label class="field-group__label">Время вылета</label>
							<div class="field-group__box">
								<input class="field-group__input" type="text" data-name="date_start" data-format="datetime" name="dateflight_start"
								autocomplete="off">
								<div class="field-group__trigger">
									<i class="fa-regular fa-calendar-days calendar-icon"></i>
									<input class="input-trigger" type="text" data-trigger="date_start" autocomplete="off">
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="field-group__item">
							<label class="field-group__label">Время прилета</label>
							<div class="field-group__box">
								<input class="field-group__input" type="text" data-name="date_end" data-format="datetime" name="dateflight_end"
								autocomplete="off">
								<div class="field-group__trigger">
									<i class="fa-regular fa-calendar-days calendar-icon"></i>
									<input class="input-trigger" type="text" data-trigger="date_end" autocomplete="off">
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
		@include('components.modal_footer')
	</form>
@endcomponent
