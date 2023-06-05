<div class="modal fade" id="addFile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content modal__content">
			<div class="modal__header">
				<div class="modal__title">Добавить файл</div>
				<button class="modal__close" type="button" data-bs-dismiss="modal" aria-label="Close">
					<i class="fa-solid fa-xmark"></i>
				</button>
			</div>
			<form action="{{route('file.store')}}" method="post" enctype="multipart/form-data" id="formFile">
				@csrf
				<input type="hidden" name="claim_id" value="{{$claim->id}}">
				<div class="modal__body">
					<div class="field-group">
						<div class="drag-area">
							<i class="fa-solid fa-cloud-arrow-up drag-area__icon">
							</i>
							<p class="drag-area__text">
								Просто перетащите файл в эту область 
								<br>
								или воспользуйтесь стандартным загрузчиком
							</p>
						</div>
						<div class="row"> 
							<div class="col-lg-8">
								<div class="field-group__label">Файл</div>
								<div class="upload-file">
									<div class="upload-file__preview preview">
										<ul class="upload-file__list" id="fileList"></ul>
									</div>
									<div class="upload-file__button">
										<label class="upload-file__label" for="file_uploads">Обзор</label>
										<input class="upload-file__input" id="file_uploads" type="file" name="file_name">
									</div>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="field-group__item">
									<label class="field-group__label">Тип файла</label>
									<select class="select-choices" name="file_type" id="fileType">
										@php
											$fileTypes = FileHelper::fileType();
										@endphp
										@foreach ($fileTypes as $key => $file)
											<option
												value="{{$file['value']}}">
												{{$file['title']}}
											</option>
										@endforeach
									</select>
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
						<button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Отменить</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>