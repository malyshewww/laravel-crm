<div class="field-group">
	<div class="row">
		<div class="col-12"> 
			<div class="field-group__item">
				<label class="field-group__label">Название</label>
				<div class="field-group__box">
					<input class="field-group__input" type="text" name="fuelsurchange_name"
					value="{{$fs->fuelsurchange_name ?: ''}}">
				</div>
			</div>
		</div>
			<div class="col-lg-3">
				<div class="field-group__item">
					<label class="field-group__label">Начало</label>
					<div class="field-group__box">
						<input class="field-group__input" type="text" 
						data-name="date_start" data-format="date"
						name="fuelsurchange_date_start"
						value="{{$fs->fuelsurchange_date_start ? $fs->fuelsurchange_date_start->format('Y-m-d') : ''}}">
						<div class="field-group__trigger">
							<i class="fa-regular fa-calendar-days calendar-icon"></i>
							<input class="input-trigger" type="text" data-trigger="date_start">
						</div>
					</div>
				</div>
		</div>
		<div class="col-lg-3">
			<div class="field-group__item">
				<label class="field-group__label">Окончание</label>
				<div class="field-group__box">
					<input class="field-group__input" type="text" 
					data-name="date_end" data-format="date"
					name="fuelsurchange_date_end"
					value="{{$fs->fuelsurchange_date_end ? $fs->fuelsurchange_date_end->format('Y-m-d') : ''}}">
					<div class="field-group__trigger">
						<i class="fa-regular fa-calendar-days calendar-icon"></i>
						<input class="input-trigger" type="text" data-trigger="date_end">
					</div>
				</div>
			</div>
		</div>
		<div class="col-12">
			@include('claim.tourists.list_tourists')
		</div>
	</div>
</div>