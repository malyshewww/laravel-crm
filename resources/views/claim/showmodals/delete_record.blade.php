<div class="modal modal-small fade" id="deleteRecord" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content modal__content">
			<div class="modal__header">
				<div class="modal__title">Вы действительно хотите удалить запись?</div>
				<button class="modal__close" type="button" data-bs-dismiss="modal" aria-label="Close">
					<i class="fa-solid fa-xmark"></i>
				</button>
			</div>
			<div class="modal__body">
				<form action="#" method="post">
					@csrf
					@method('delete')
					<div class="row justify-content-center">
						<div class="col-4">
							<button class="btn btn-danger" type="submit">Да</button>
						</div>
						<div class="col-4">
							<button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Нет</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>