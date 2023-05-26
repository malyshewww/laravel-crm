@if (count($claim->serviceVisa) > 0)
	@foreach ($claim->serviceVisa as $visa)
		<tr> 
			<td><strong>ВИЗА</strong></td>
			<td>% </td>
			<td>
				{{$visa->visa_name ?: ''}}
			</td>
			<td>
				@if ($visa->datevisa_start || $visa->datevisa_end)
					c {{$visa->datevisa_start ? $visa->datevisa_start->format('d.m.Y') : '-'}}
					до {{$visa->datevisa_end ? $visa->datevisa_end->format('d.m.Y') : '-'}}
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
							data-bs-toggle="modal" data-bs-target="#updateVisa"
							data-id="{{$visa->id}}" 
							data-type="update"
							data-claim-id="{{$claim->id}}"
							data-url="{{route('visa.update', $visa->id)}}"
							data-path="{{route('visa.loadModal', [$visa->id, 'update'])}}">
							<i class="fa-solid fa-gear"></i>
						</button>
					</div>
					<div class="table__button-item" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Удалить услугу">
						<button class="btn-trash" type="button" 
							data-bs-toggle="modal" data-bs-target="#deleteRecord"
							data-type="delete" 
							data-id="{{$visa->id}}" data-url="{{route('visa.destroy', $visa->id)}}" 
							data-title="Вы действительно хотите удалить услугу?">
							<i class="fa-solid fa-trash-can"></i>
						</button>
					</div>
				</div>
				@include('claim.services.modals.update_visa', ['visa' => $visa])
			</td>
		</tr>
	@endforeach
@endif