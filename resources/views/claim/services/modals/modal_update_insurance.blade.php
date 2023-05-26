<div class="field-group"> 
	<div class="row"> 
		<div class="col-12">
			<div class="field-group__item">
				<label class="field-group__label">Название</label>
				<div class="field-group__box">
					<input class="field-group__input" type="text" name="insurance_name"
					value="{{$insurance->insurance_name ?: ''}}">
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="field-group__item">
				<label class="field-group__label">Компания страховщик</label>
				<div class="field-group__box">
					<input class="field-group__input" type="text" name="insurance_company"
					value="{{$insurance->insurance_company ?: ''}}">
				</div>
			</div>
		</div>
		<div class="col-lg-8">
			<div class="field-group__item">
				<label class="field-group__label">Тип страховки</label>
				<select data-select data-name="insuranceType" name="insurance_type" id="insuranceType">
					<option value="" selected></option>
					@php
						$insuranceTypes = ServiceHelper::insuranceType();
					@endphp
					@foreach ($insuranceTypes as $type)
						<option
							{{$type['value'] === $insurance->insurance_type ? ' selected' : ''}}
							value="{{$type['value']}}">
							{{$type['title']}}
						</option>
					@endforeach
				</select>
			</div>
			<div class="field-group__item mt-3" {{$insurance->insurance_type !== 'other' ? 'hidden' : ''}}>
				<label class="field-group__label">Тип страховки (заполняется вручную)</label>
				<div class="field-group__box">
					<input class="field-group__input" type="text" data-name="insurance_type_other" 
					name="insurance_type_other"
					value="{{$insurance->insurance_type_other ?: ''}}">
				</div>
			</div>
		</div>
		<div class="col-lg-2">
			<div class="field-group__item">
				<label class="field-group__label">Начало действия</label>
				<div class="field-group__box">
					<input class="field-group__input" type="text" 
					data-name="date_start" data-format="date"
					name="dateinsurance_start"
					value="{{$insurance->dateinsurance_start ? $insurance->dateinsurance_start->format('Y-m-d') : ''}}">
					<div class="field-group__trigger">
						<i class="fa-regular fa-calendar-days calendar-icon"></i>
						<input class="input-trigger" type="text" data-trigger="date_start"
						>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-2">
			<div class="field-group__item">
				<label class="field-group__label">Окончание действия</label>
				<div class="field-group__box">
					<input class="field-group__input" type="text" 
					data-name="date_end" data-format="date" 
					name="dateinsurance_end"
					value="{{$insurance->dateinsurance_end ? $insurance->dateinsurance_end->format('Y-m-d') : ''}}">
					<div class="field-group__trigger">
						<i class="fa-regular fa-calendar-days calendar-icon"></i>
						<input class="input-trigger" type="text" data-trigger="date_end"
						>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="field-group__item">
				<label class="field-group__label">Страховая сумма</label>
				<div class="field-group__box">
					<input class="field-group__input" type="text" name="insurance_sum"
					value="{{$insurance->insurance_sum ?: ''}}">
				</div>
			</div>
		</div>
		<div class="col-12">
			@include('claim.tourists.list_tourists')
		</div>
	</div>
</div>