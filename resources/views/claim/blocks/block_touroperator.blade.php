<div class="group-data__item item-group">
	<div class="item-group__top"> 
		<div class="item-group__title">ИНФОРМАЦИЯ О ТУРОПЕРАТОРЕ</div>
		<button class="item-group__button btn-blue btn-redact" type="button" data-bs-toggle="modal" data-bs-target="#touroperatorModal">
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