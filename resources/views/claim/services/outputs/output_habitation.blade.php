@if (count($claim->serviceHabitation) > 0)
	@foreach ($claim->serviceHabitation as $habitation)
		<tr> 
			<td><strong>ПРОЖИВАНИЕ</strong></td>
			<td>% </td>
			<td>
				{{$habitation->habitation_name ?: ''}}
			</td>
			<td>
				@if ($habitation->datehabitation_start || $habitation->datehabitation_end)
					c {{$habitation->datehabitation_start ? $habitation->datehabitation_start->format('d.m.Y') : '-'}}
					до {{$habitation->datehabitation_end ? $habitation->datehabitation_end->format('d.m.Y') : '-'}}
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
							data-id="{{$habitation->id}}" 
							data-type="update"
							data-claim-id="{{$claim->id}}"
							data-url="{{route('habitation.update', $habitation->id)}}"
							data-path="{{route('habitation.loadModal', [$habitation->id, $claim->id, request()->get('status')])}}"
							data-title="Проживание (редактирование)">
							<i class="fa-solid fa-gear"></i>
						</button>
					</div>
					<div class="table__button-item" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Удалить услугу">
						<button class="btn-trash" type="button" 
							data-bs-toggle="modal" data-bs-target="#modalAction"
							data-method="DELETE"
							data-type="delete" data-id="{{$habitation->id}}" 
							data-url="{{route('habitation.destroy', $habitation->id)}}" 
							data-title="Вы действительно хотите удалить услугу?">
							<i class="fa-solid fa-trash-can"></i>
						</button>
					</div>
				</div>
			</td>
		</tr>
	@endforeach
@endif