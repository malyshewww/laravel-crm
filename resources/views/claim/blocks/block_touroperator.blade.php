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
			{{$claim->touroperator ? '[изменить]' : '[добавить]'}}
		</button>
	</div>
	@if ($claim->touroperator)
		@php
			$touroperatorList = [
				['label' => 'ТУРОПЕРАТОР', 'value' => $claim->touroperator->title ?: '']
			];
		@endphp
		<ul class="item-group__list list">
			@foreach ($touroperatorList as $item)
			<li class="list__item">
				<div class="list__label">{{$item['label']}}</div>
				<div class="list__value">{{$item['value']}}</div>
			</li>
			@endforeach
		</ul>
	@endif
</div>