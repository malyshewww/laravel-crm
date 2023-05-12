<div class="modal fade" id="createClaim" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content modal__content">
			<form action="{{route('claim.store')}}" method="POST" id="formCreateClaim" class="form">
				@csrf
				<input type="hidden" name="id" value="{{count($claims) > 0 ? count($claims) + 1 : 1}}">
				<div class="modal__header">
					<div class="modal__title"> Заявка от {{ date('d.m.Y') }}</div>
					<button class="modal__close" type="button" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
				</div>
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
		</div>
	</div>
</div>