<div class="modal fade modal-extended" id="updateHabitation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content modal__content">
			<div class="modal__header">
				<div class="modal__title">Проживание (редактирование)</div>
				<button class="modal__close" type="button" data-bs-dismiss="modal" aria-label="Close">
					<i class="fa-solid fa-xmark"></i>
				</button>
			</div>
			<form action="" method="post" id="formHabitationUpdate">
				@csrf
				@method('patch')
				<input type="hidden" name="type" value="habitation">
				<input type="hidden" name="claim_id" value="">
				<input type="hidden" name="record_id" value="">
				<div class="modal__body">
					{{-- Разметки с данными из шаблона modal_update_habitation--}}
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