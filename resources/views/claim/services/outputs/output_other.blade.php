@if (count($claim->serviceOther) > 0)
	@foreach ($claim->serviceOther as $other)
		<tr> 
			<td><strong>ДРУГАЯ УСЛУГА</strong></td>
			<td>% </td>
			<td>
				{{$other->other_service_name ?: ''}}
			</td>
			<td>
				@if ($other->otherservice_date_start || $other->otherservice_date_end)
					c {{$other->otherservice_date_start ? $other->otherservice_date_start->format('d.m.Y') : '-'}}
					до {{$other->otherservice_date_end ? $other->otherservice_date_end->format('d.m.Y') : '-'}}
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
						<button class="btn-gear" type="button" data-id="{{$other->id}}" data-bs-toggle="modal" data-bs-target="#updateOtherService-{{$other->id}}">
							<i class="fa-solid fa-gear"></i>
						</button>
					</div>
					<div class="table__button-item" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Удалить услугу">
						<button class="btn-trash" type="button" data-type="delete" data-id="{{$other->id}}" data-url="{{route('otherservice.destroy', $other->id)}}" data-bs-toggle="modal" data-bs-target="#deleteRecord">
							<i class="fa-solid fa-trash-can"></i>
						</button>
					</div>
				</div>
				@include('claim.services.modals.update_other', ['other' => $other])
			</td>
		</tr>
	@endforeach
@endif