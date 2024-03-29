@component('components.modal')
	@slot('modal_id', 'addExcursionProgram')
	@slot('modal_title', 'Экскурсионная программа (добавление)')
	@slot('modal_class', ' modal-extended')
	<form action="{{route('excursion.store')}}" method="post" id="formExcursion" class="form">
		@csrf
		<input type="hidden" name="type" value="excursion">
		<input type="hidden" name="claim_id" value="{{$claim->id}}">
		<div class="modal__body">
			<div class="field-group"> 
				<div class="row">
					<div class="col-12"> 
						<div class="field-group__item">
							<label class="field-group__label">Название</label>
							<div class="field-group__box">
								<input class="field-group__input" type="text" name="excursion_name" autocomplete="off">
							</div>
						</div>
					</div>
					<div class="col-12"> 
						<div class="field-group__item">
							<label class="field-group__label">Описание</label>
							<div class="field-group__box">
								<input class="field-group__input" type="text" name="excursion_description" autocomplete="off">
							</div>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="field-group__item">
							<label class="field-group__label">Начало</label>
							<div class="field-group__box">
								<input class="field-group__input" type="text" data-name="date_start" data-format="date" name="excursion_date_start"
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
								<input class="field-group__input" type="text" data-name="date_end" data-format="date" name="excursion_date_end"
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

