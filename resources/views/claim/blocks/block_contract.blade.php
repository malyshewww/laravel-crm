<div class="group-data__item item-group" id="groupDataContract">
	<div class="item-group__top"> 
		<div class="item-group__title">ДАННЫЕ ДОГОВОРА И БРОНИРОВАНИЯ</div>
		<button class="item-group__button btn-blue btn-redact" type="button" 
			data-bs-toggle="modal" data-bs-target="#contractModal"
			data-id="{{$claim->id}}" 
			data-type="update"
			data-claim-id="{{$claim->id}}"
			data-url="{{route('contract.store', $claim->id)}}"
			data-path="{{route('contract.loadModal', [$claim->id, 'update'])}}"
			data-title="Договор">
			{{$claim->contract ? '[изменить]' : '[добавить]'}}
		</button>
	</div>
	@if ($claim->contract)
		@php
			$contractList = [
				['label' => 'ДАТА', 'value' => $claim->contract->date ? $claim->contract->date->format('d.m.Y') : ''],
				['label' => 'НОМЕР БРОНИ', 'value' => $claim->contract->number ?: '']
			];
		@endphp
		<ul class="item-group__list list">
			@foreach ($contractList as $item)
				<li class="list__item">
					<div class="list__label">{{$item['label']}}</div>
					<div class="list__value">{{$item['value']}}</div>
				</li>
			@endforeach
		</ul>
	@endif
</div>