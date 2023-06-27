@component('components.modal')
	@slot('modal_id', 'addOtherService')
	@slot('modal_title', 'Услуга (добавление)')
	@slot('modal_class', ' modal-extended')
	<form action="{{route('otherservice.store')}}" method="post" id="formOtherService" class="form">
		@csrf
		<input type="hidden" name="type" value="other">
		<input type="hidden" name="claim_id" value="{{$claim->id}}">
		<div class="modal__body">
			<div class="field-group"> 
				<div class="row">
					<div class="col-12"> 
						<div class="field-group__item">
							<label class="field-group__label">Название</label>
							<div class="field-group__box">
								<input class="field-group__input" type="text" name="other_service_name">
							</div>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="field-group__item">
							<label class="field-group__label">Начало</label>
							<div class="field-group__box">
								<input class="field-group__input" type="text" data-name="date_start" data-format="date" name="otherservice_date_start"
								value="{{$claim->date_start->format('Y-m-d')}}">
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
								<input class="field-group__input" type="text" data-name="date_end" data-format="date" name="otherservice_date_end"
								value="{{$claim->date_end->format('Y-m-d')}}">
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
		@include('components.modal_footer')
	</form>
@endcomponent
