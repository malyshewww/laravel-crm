@component('components.modal')
	@slot('modal_id', 'addFile')
	@slot('modal_title', 'Добавить файл')
	@slot('modal_class', null)
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
								{{-- @php
									$fileTypes = FileHelper::fileType();
								@endphp
								@foreach ($fileTypes as $key => $file)
									<option
										value="{{$file['value']}}">
										{{$file['title']}}
									</option>
								@endforeach --}}
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>
		@include('components.modal_footer')
	</form>
@endcomponent
