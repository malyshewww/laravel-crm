@if (count($claim->serviceExcursion) > 0)
	@foreach ($claim->serviceExcursion as $excursion)
		<tr> 
			<td><strong>ЭКСКУРСИОННАЯ ПРОГРАММА</strong></td>
			<td>% </td>
			<td>
				{{$excursion->excursion_description ?: ''}}
			</td>
			<td>
				@if ($excursion->excursion_date_start || $excursion->excursion_date_end)
					c {{$excursion->excursion_date_start ? $excursion->excursion_date_start->format('d.m.Y') : '-'}}
					до {{$excursion->excursion_date_end ? $excursion->excursion_date_end->format('d.m.Y') : '-'}}
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
							data-id="{{$excursion->id}}" 
							data-bs-toggle="modal" data-bs-target="#serviceUpdateModal"
							data-type="update"
							data-claim-id="{{$claim->id}}"
							data-url="{{route('excursion.update', $excursion->id)}}"
							data-path="{{route('excursion.loadModal', [$excursion->id, $claim->id, 'update'])}}"
							data-title="Экскурсионная программа (редактирование)">
							<i class="fa-solid fa-gear"></i>
						</button>
					</div>
					<div class="table__button-item" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Удалить услугу">
						<button class="btn-trash" type="button" 
							data-bs-toggle="modal" data-bs-target="#modalAction"
							data-method="DELETE"
							data-type="delete" data-id="{{$excursion->id}}" 
							data-url="{{route('excursion.destroy', $excursion->id)}}" 
							data-title="Вы действительно хотите удалить услугу?">
							<i class="fa-solid fa-trash-can"></i>
						</button>
					</div>
				</div>
			</td>
		</tr>
	@endforeach
@endif