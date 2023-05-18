@if (count($claim->serviceInsurance) > 0)
	@foreach ($claim->serviceInsurance as $insurance)
		<tr> 
			<td><strong>СТРАХОВКА</strong></td>
			<td>% </td>
			<td>
				{{$insurance->insurance_name ?: ''}}
			</td>
			<td>
				@if ($insurance->dateinsurance_start || $insurance->dateinsurance_end)
					c {{$insurance->dateinsurance_start ? $insurance->dateinsurance_start->format('d.m.Y') : '-'}}
					до {{$insurance->dateinsurance_end ? $insurance->dateinsurance_end->format('d.m.Y') : '-'}}
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
						<button class="btn-gear" type="button" data-id="{{$insurance->id}}" data-bs-toggle="modal" data-bs-target="#updateInsurance-{{$insurance->id}}">
							<i class="fa-solid fa-gear"></i>
						</button>
					</div>
					<div class="table__button-item" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Удалить услугу">
						<button class="btn-trash" type="button" data-type="delete" data-id="{{$insurance->id}}" data-url="{{route('insurance.destroy', $insurance->id)}}" data-bs-toggle="modal" data-bs-target="#deleteRecord">
							<i class="fa-solid fa-trash-can"></i>
						</button>
					</div>
				</div>
				@include('claim.services.modals.update_insurance', ['insurance' => $insurance])
			</td>
		</tr>
	@endforeach
@endif