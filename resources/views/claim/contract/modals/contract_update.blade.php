<div class="field-group">
	<div class="row">
		<div class="col-lg-4">
			<div class="field-group__item">
				<label class="field-group__label">Дата договора</label>
				<div class="field-group__box">
					<input class="field-group__input" type="text" data-name="date" data-format="date" name="date"
					value="{{$contract->date ? $contract->date->format('Y-m-d') : ''}}">
					<div class="field-group__trigger">
						<i class="fa-regular fa-calendar-days calendar-icon"></i>
						<input class="input-trigger" type="text" data-trigger="date">
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="field-group__item">
				<label class="field-group__label">Номер брони</label>
				<div class="field-group__box">
					<input class="field-group__input" type="text" name="number" 
					value="{{$contract && $contract->number ? $contract->number : ''}}">
				</div>
			</div>
		</div>
	</div>
</div>