@component('components.modal')
	@slot('modal_id', 'addFuelSurcharge')
	@slot('modal_title', 'Топливный сбор (добавление)')
	@slot('modal_class', ' modal-extended')
	<form action="{{route('fuelsurchange.store')}}" method="post" id="formFuelSurchange" class="form">
		@csrf
		<input type="hidden" name="type" value="fuel_surchange">
		<input type="hidden" name="claim_id" value="{{$claim->id}}">
		<div class="modal__body">
			<div class="field-group">
				<div class="row">
					<div class="col-12"> 
						<div class="field-group__item">
							<label class="field-group__label">Название</label>
							<div class="field-group__box">
								<input class="field-group__input" type="text" name="fuelsurchange_name" autocomplete="off">
							</div>
						</div>
					</div>
						<div class="col-lg-3">
							<div class="field-group__item">
								<label class="field-group__label">Начало</label>
								<div class="field-group__box">
									<input class="field-group__input" type="text" data-name="date_start" data-format="date" name="fuelsurchange_date_start"
									value="{{$claim->date_start->format('Y-m-d')}}" autocomplete="off">
									<div class="field-group__trigger">
										<i class="fa-regular fa-calendar-days calendar-icon"></i>
										<input class="input-trigger" type="text" data-trigger="date_start" autocomplete="off">
									</div>
								</div>
							</div>
					</div>
					<div class="col-lg-3">
						<div class="field-group__item">
							<label class="field-group__label">Окончание</label>
							<div class="field-group__box">
								<input class="field-group__input" type="text" data-name="date_end" data-format="date" name="fuelsurchange_date_end"
								value="{{$claim->date_end->format('Y-m-d')}}" autocomplete="off">
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