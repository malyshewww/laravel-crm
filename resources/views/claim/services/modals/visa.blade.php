@component('components.modal')
	@slot('modal_id', 'addVisa')
	@slot('modal_title', 'Виза (добавление)')
	@slot('modal_class', ' modal-extended')
	<form action="{{route('visa.store')}}" method="post" id="formVisa" class="form">
		@csrf
		<input type="hidden" name="type" value="visa">
		<input type="hidden" name="claim_id" value="{{$claim->id}}">
		<div class="modal__body">
			<div class="field-group"> 
				<div class="row">
					<div class="col-lg-6">
						<div class="field-group__item">
							<label class="field-group__label">Название</label>
							<div class="field-group__box">
								<input class="field-group__input" type="text" name="visa_name" autocomplete="off">
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="field-group__item">
							<label class="field-group__label">Страна назначения</label>
							<div class="field-group__box">
								<input class="field-group__input" type="text" name="visa_country" autocomplete="off">
							</div>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="field-group__item">
							<label class="field-group__label">Начало действия</label>
							<div class="field-group__box">
								<input class="field-group__input" type="text" data-name="date_start" data-format="date" name="datevisa_start"
								value="" autocomplete="off">
								<div class="field-group__trigger">
									<i class="fa-regular fa-calendar-days calendar-icon"></i>
									<input class="input-trigger" type="text" data-trigger="date_start" autocomplete="off">
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="field-group__item">
							<label class="field-group__label">Окончание действия</label>
							<div class="field-group__box">
								<input class="field-group__input" type="text" data-name="date_end" data-format="date" name="datevisa_end"
								value="" autocomplete="off">
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
