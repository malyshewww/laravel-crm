@component('components.modal')
	@slot('modal_id', 'addHabitation')
	@slot('modal_title', 'Проживание (добавление)')
	@slot('modal_class', ' modal-extended')
	<form action="{{route('habitation.store')}}" method="post" id="formHabitation" class="form">
		@csrf
		<input type="hidden" name="type" value="habitation">
		<input type="hidden" name="claim_id" value="{{$claim->id}}">
		<div class="modal__body">
			<div class="field-group"> 
				<div class="row">
					<div class="col-12"> 
						<div class="field-group__item">
							<label class="field-group__label">Название</label>
							<div class="field-group__box">
								<input class="field-group__input" type="text" name="habitation_name" autocomplete="off">
							</div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="field-group__item">
							<label class="field-group__label">Курорт</label>
							<div class="field-group__box">
								<input class="field-group__input" type="text" name="habitation_resort" autocomplete="off">
							</div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="field-group__item">
							<label class="field-group__label">Отель</label>
							<div class="field-group__box">
								<input class="field-group__input" type="text" name="habitation_hotel" autocomplete="off">
							</div>
						</div>
					</div>
					<div class="col-12">
						<div class="field-group__item">
							<label class="field-group__label">Адрес отеля</label>
							<div class="field-group__box">
								<input class="field-group__input" type="text" name="habitation_hotel_address" autocomplete="off">
							</div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="field-group__item">
							<label class="field-group__label">Тип номера</label>
							<div class="field-group__box">
								<input class="field-group__input" type="text" name="habitation_type_number" autocomplete="off">
							</div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="field-group__item">
							<label class="field-group__label">Тип размещения</label>
							<div class="field-group__box">
								<input class="field-group__input" type="text" name="habitation_type_placement" autocomplete="off">
							</div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="field-group__item">
							<label class="field-group__label">Тип питания</label>
							<select class="select-choices" name="habitation_type_food" id="selectHabitationFoodType">
								{{-- <option value="" selected></option>
								@php
									$habitationFoodTypes = ServiceHelper::habitationFoodType();
								@endphp
								@foreach ($habitationFoodTypes as $type)
									<option
										value="{{$type['value']}}">
										{{$type['title']}}
									</option>
								@endforeach --}}
							</select>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="field-group__item">
							<label class="field-group__label">Время заезда</label>
							<div class="field-group__box">
								<input class="field-group__input" type="text" data-name="date_start" data-format="datetime" name="datehabitation_start"
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
							<label class="field-group__label">Время выезда</label>
							<div class="field-group__box">
								<input class="field-group__input" type="text" data-name="date_end" data-format="datetime" name="datehabitation_end"
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
