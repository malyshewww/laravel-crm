@if (count($claim->serviceTransfer) > 0)
	@foreach ($claim->serviceTransfer as $transfer)
		<tr> 
			<td><strong>ТРАНСФЕР</strong></td>
			<td>% </td>
			<td>
				{{$transfer->transfer_route}}
			</td>
			<td>
				@if ($transfer->datetransfer_start || $transfer->datetransfer_end)
					c {{$transfer->datetransfer_start ? $transfer->datetransfer_start->format('d.m.Y') : '-'}}
					до {{$transfer->datetransfer_end ? $transfer->datetransfer_end->format('d.m.Y') : '-'}}
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
						<button class="btn-gear" type="button" data-id="{{$transfer->id}}" data-bs-toggle="modal" data-bs-target="#updateTransfer-{{$transfer->id}}">
							<i class="fa-solid fa-gear"></i>
						</button>
					</div>
					<div class="table__button-item" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Удалить услугу">
						<button class="btn-trash" type="button" data-type="delete" data-id="{{$transfer->id}}" data-url="{{route('transfer.destroy', $transfer->id)}}" data-bs-toggle="modal" data-bs-target="#deleteRecord">
							<i class="fa-solid fa-trash-can"></i>
						</button>
					</div>
				</div>
				@include('claim.services.modals.update_transfer', ['transfer' => $transfer])
			</td>
		</tr>
	@endforeach
@endif