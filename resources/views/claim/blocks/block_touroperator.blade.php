<div class="group-data__item item-group" id="groupDataTouroperator">
	<div class="item-group__top"> 
		<div class="item-group__title">ИНФОРМАЦИЯ О ТУРОПЕРАТОРЕ</div>
		<button class="item-group__button btn-blue btn-redact" type="button" 
			data-bs-toggle="modal" data-bs-target="#touroperatorModal"
			data-id="{{$claim->id}}" 
			data-type="update"
			data-claim-id="{{$claim->id}}"
			data-url="{{route('touroperator.store', $claim->id)}}"
			data-path="{{route('touroperator.loadModal', [$claim->id, 'update'])}}"
			data-title="Туроператор - поставщик тура">
			[изменить]
		</button>
	</div>
	@if ($claim->touroperator)
		@if ($claim->touroperator->title)
			<ul class="item-group__list list">
				<li class="list__item">
					<div class="list__label">ТУРОПЕРАТОР</div>
					<div class="list__value">{{$claim->touroperator->title}}</div>
				</li>
			</ul>
		@endif
	@endif
</div>