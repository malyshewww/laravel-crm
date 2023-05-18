@if (count($claim->serviceFlight) > 0)
	@foreach ($claim->serviceFlight as $flight)
		<tr> 
			<td><strong>ПЕРЕЛЁТ</strong></td>
			<td>% </td>
			<td>
				{{$flight->flight_route ?: ''}}
			</td>
			<td>
				@if ($flight->dateflight_start || $flight->dateflight_end)
					c {{$flight->dateflight_start ? $flight->dateflight_start->format('d.m.Y') : '-'}}
					до {{$flight->dateflight_end ? $flight->dateflight_end->format('d.m.Y') : '-'}}
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
						<button class="btn-gear" type="button" data-id="{{$flight->id}}" data-bs-toggle="modal" data-bs-target="#updateFlights-{{$flight->id}}">
							<i class="fa-solid fa-gear"></i>
						</button>
					</div>
					<div class="table__button-item" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Удалить услугу">
						<button class="btn-trash" type="button" data-type="delete" data-id="{{$flight->id}}" data-url="{{route('flight.destroy', $flight->id)}}" data-bs-toggle="modal" data-bs-target="#deleteRecord">
							<i class="fa-solid fa-trash-can"></i>
						</button>
					</div>
				</div>
				@include('claim.services.modals.update_flights', ['flight' => $flight])
			</td>
		</tr>
	@endforeach
@endif