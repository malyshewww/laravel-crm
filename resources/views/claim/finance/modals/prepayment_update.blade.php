<div class="field-group"> 
	<div class="row">
		<div class="col-12"> 
			<div class="field-group__item">
				<label class="field-group__label">Предоплата не менее, %</label>
				<div class="field-group__box">
					<input class="field-group__input" type="text" name="percent" data-number
					value="{{$prepayment && $prepayment->percent ? $prepayment->percent : '' }}">
				</div>
			</div>
		</div>
		<div class="col-12">
			<div class="field-group__item">
				<label class="field-group__label">Полная оплата не позднее, дней</label>
				<div class="field-group__box">
					<input class="field-group__input" type="text" name="days" data-range
					value="{{$prepayment && $prepayment->days ? $prepayment->days : '' }}">
				</div>
			</div>
		</div>
	</div>
</div>