@if (count($claim->serviceFuelSurchange) > 0)
	@foreach ($claim->serviceFuelSurchange as $fs)
		<tr> 
			<td><strong>ТОПЛИВНЫЙ СБОР</strong></td>
			<td>% </td>
			<td>
				{{$fs->fuelsurchange_name ?: ''}}
			</td>
			<td>
				@if ($fs->fuelsurchange_date_start || $fs->fuelsurchange_date_end)
					c {{$fs->fuelsurchange_date_start ? $fs->fuelsurchange_date_start->format('d.m.Y') : '-'}}
					до {{$fs->fuelsurchange_date_end ? $fs->fuelsurchange_date_end->format('d.m.Y') : '-'}}
				@else
					Даты не указаны
				@endif
			</td>
			<td>
				@include('claim.tourists.quantity')
			</td>
			<td class="table__actions">
				<div class="table__buttons">
					<div class="table__button-item" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Редактировать услугу">
						<button class="btn-gear" type="button" 
							data-bs-toggle="modal" data-bs-target="#serviceUpdateModal"
							data-id="{{$fs->id}}" 
							data-type="update"
							data-claim-id="{{$claim->id}}"
							data-url="{{route('fuelsurchange.update', $fs->id)}}"
							data-path="{{route('fuelsurchange.loadModal', [$fs->id, $claim->id, request()->get('status')])}}"
							data-title="Топливный сбор (редактирование)">
							<i class="fa-solid fa-gear"></i>
						</button>
					</div>
					<div class="table__button-item" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Удалить услугу">
						<button class="btn-trash" type="button" 
							data-bs-toggle="modal" data-bs-target="#modalAction"
							data-method="DELETE"
							data-type="delete" data-id="{{$fs->id}}" 
							data-url="{{route('fuelsurchange.destroy', $fs->id)}}" 
							data-title="Вы действительно хотите удалить услугу?">
							<i class="fa-solid fa-trash-can"></i>
						</button>
					</div>
				</div>
			</td>
		</tr>
	@endforeach
@endif