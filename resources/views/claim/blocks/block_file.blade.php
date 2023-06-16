<div class="data-claim__group group-data" id="groupDataFile">
	<header class="group-data__header">
		<h2 class="group-data__title">Файлы</h2>
		<div class="group-data__buttons">
			<button class="btn btn-blue btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#addFile">
				<i class="fa-regular fa-plus"></i>
				Добавить файл
			</button>
		</div>
	</header>
	<div class="group-data__area area-group">
		<div class="area-group__body">
			<div class="area-group__header"> 
				<h3 class="area-group__title">ФАЙЛЫ, КОТОРЫЕ ВИДНЫ ТОЛЬКО ВАМ</h3>
			</div>
		</div>
		@if (count($claim->file) > 0)
			<div class="table-responsive">
				<table class="documents-table table" id="table-file">
					<thead> 
						<th style="width: 15%;">Дата добавления</th>
						<th style="width: 50%;">Название файла</th>
						<th style="width: 20%;">Тип</th>
						<th style="width: 15%;">Действия</th>
					</thead>
					<tbody>
						@foreach ($claim->file as $fileItem)
							<tr> 
								<td>{{$fileItem->created_at->format('d.m.Y H:i:s')}}</td>
								<td>
									<span style="word-break: break-all;">{{$fileItem->file_name}}</span>
								</td>
								<td>
									@if ($fileItem->file_type == 'doc_tourist')
										Документ туриста
									@elseif ($fileItem->file_type == 'doc_tour')
										Документ тура
									@elseif ($fileItem->file_type == 'doc_payment')
										Платежный документ
									@endif
								</td>
								<td class="table__actions">
									<div class="table__buttons">
										<div class="table__button-item" data-bs-toggle="tooltip" title="Скачать файл" data-bs-trigger="hover">
											<a href="{{url('storage/' . $fileItem->file_name)}}" download>
												<i class="fa-solid fa-download"></i>
											</a>
										</div>
										<div class="table__button-item" data-bs-toggle="tooltip" title="Удалить файл" data-bs-trigger="hover">
											<button class="btn-trash" type="button" data-type="delete" data-id="{{$fileItem->id}}" 
												data-url="{{route('file.destroy', $fileItem->id)}}" data-bs-toggle="modal" data-bs-target="#deleteRecord"
												data-title="Вы действительно хотите удалить файл?">
												<i class="fa-solid fa-trash-can"></i>
											</button>
										</div>
									</div>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		@else
		<div class="area-group__empty">
			Нет файлов
		</div>
		@endif
	</div>
</div>