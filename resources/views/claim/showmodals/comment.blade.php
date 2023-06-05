<div class="modal fade" id="comment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content modal__content">
			<div class="modal__header">
				<div class="modal__title">Коментарий</div>
				<button class="modal__close" type="button" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
			</div>
			<form action="{{route('claim.update', $claim->id)}}" method="post" id="formComment" class="form">
				@csrf
				@method('patch')
				<input type="hidden" name="id" value="{{$claim->id}}">
				<div class="modal__body">
					<div class="field-group">
						<div class="row justify-content-center">
							<div class="col-12">
								<div class="field-group__item"> 
									<label class="field-group__label">КОММЕНТАРИЙ</label>
									<textarea class="field-group__textarea" type="text" name="comment">{{$claim->comment}}</textarea>
								</div>
							</div>
						</div>
					</div>
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