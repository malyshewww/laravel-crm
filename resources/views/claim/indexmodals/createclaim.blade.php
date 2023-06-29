@component('components.modal')
	@slot('modal_id', 'createClaim')
	@slot('modal_title', Blade::render('Заявка от {{ $date }}', ['date' => date('d.m.Y')]))
	@slot('modal_class', null)
	<form action="{{route('claim.store')}}" method="POST" id="formCreateClaim">
		@csrf
		<input type="hidden" name="id" value="{{count($claims) > 0 ? count($claims) + 1 : 1}}">
		<input type="hidden" name="manager" value="{{Auth::user()->name}}">
		<div class="modal__body">
			<div class="field-group">
				<div class="row"> 
					<div class="col-lg-4">
						<div class="modal-text">
							Даты тура</div>
					</div>
					<div class="col-lg-4">
						<div class="field-group__item">
							<label class="field-group__label">Начало</label>
							<div class="field-group__box">
								<input class="field-group__input" type="text" data-name="date_start" data-format="date" name="date_start">
								<div class="field-group__trigger">
									<i class="fa-regular fa-calendar-days calendar-icon"></i>
									<input class="input-trigger" type="text" data-trigger="date_start">
								</div>
								@error('date_start')
									<div class="alert alert-danger">{{ $message }}</div>
								@enderror
							</div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="field-group__item">
							<label class="field-group__label">Окончание</label>
							<div class="field-group__box">
								<input class="field-group__input" type="text" data-name="date_end" data-format="date" name="date_end">
								<div class="field-group__trigger">
									<i class="fa-regular fa-calendar-days calendar-icon"></i>
									<input class="input-trigger" type="text" data-trigger="date_end">
								</div>
								@error('date_end')
									<div class="alert alert-danger">{{ $message }}</div>
								@enderror
							</div>
						</div>
					</div>
					<div class="col-12"> 
						<div class="field-group__item"> 
							<label class="field-group__label">КОММЕНТАРИЙ ДЛЯ СЕБЯ (ЕГО НЕ БУДУТ ВИДЕТЬ СОТРУДНИКИ ЦБ!)</label>
							<textarea class="field-group__textarea" type="text" name="comment"></textarea>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal__footer">
			<div class="modal__buttons">
				<button class="btn btn-create btn-primary" type="submit">
					<i class="fa-solid fa-check"></i>
					Создать
				</button>
				<button class="btn btn-secondary" type="button" data-bs-dismiss="modal">
					Отмена
				</button>
			</div>
		</div>
	</form>
@endcomponent