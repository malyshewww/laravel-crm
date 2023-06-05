<div class="group-data__item item-group">
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
			[изменить]
		</button>
	</div>
	@if ($claim->contract)
		<ul class="item-group__list list">
			<li class="list__item">
				<div class="list__label">ДАТА</div>
				<div class="list__value">{{$claim->contract->date->format('d.m.Y')}}</div>
			</li>
			<li class="list__item">
				<div class="list__label">НОМЕР БРОНИ</div>
				<div class="list__value">{{$claim->contract->number}}</div>
			</li>
		</ul>
	@endif
</div>