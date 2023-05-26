<div class="field-group"> 
	<div class="row">
		<div class="col-lg-6">
			<div class="field-group__item">
				<label class="field-group__label">Маршрут</label>
				<div class="field-group__box">
					<input class="field-group__input" type="text" name="transfer_route"
					value="{{$transfer->transfer_route ?: ''}}">
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="field-group__item">
				<label class="field-group__label">Начало</label>
				<div class="field-group__box">
					<input class="field-group__input" type="text" 
					data-name="date_start" data-format="datetime"
					name="datetransfer_start"
					value="{{$transfer->datetransfer_start ? $transfer->datetransfer_start->format('Y-m-d H:i') : ''}}">
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
					data-name="date_end" data-format="datetime"
					name="datetransfer_end"
					value="{{$transfer->datetransfer_end ? $transfer->datetransfer_end->format('Y-m-d H:i') : ''}}">
					<div class="field-group__trigger">
						<i class="fa-regular fa-calendar-days calendar-icon"></i>
						<input class="input-trigger" type="text" data-trigger="date_end">
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="field-group__item">
				<label class="field-group__label">Тип трансфера</label>
				<select data-select name="transfer_type">
					<option value="" selected></option>
					@php
						$transferTypes = ServiceHelper::transferType();
					@endphp
					@foreach ($transferTypes as $transferItem)
						<option
							{{$transferItem['value'] === $transfer->transfer_type ? ' selected' : ''}}
							value="{{$transferItem['value']}}">
							{{$transferItem['title']}}
						</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="field-group__item">
				<label class="field-group__label">Вид транспорта</label>
				<div class="field-group__box">
					<input class="field-group__input" type="text" name="transfer_transport"
					value="{{$transfer->transfer_transport ?: ''}}">
				</div>
			</div>
		</div>
		<div class="col-12">
			@include('claim.tourists.list_tourists')
		</div>
	</div>
</div>