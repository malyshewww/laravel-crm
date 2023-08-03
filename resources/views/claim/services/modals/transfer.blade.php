@component('components.modal')
	@slot('modal_id', 'addTransfer')
	@slot('modal_title', 'Трансфер (добавление)')
	@slot('modal_class', ' modal-extended')
	<form action="{{route('transfer.store')}}" method="post" id="formTransfer" class="form">
		@csrf
		<input type="hidden" name="type" value="transfer">
		<input type="hidden" name="claim_id" value="{{$claim->id}}">
		<div class="modal__body">
			<div class="field-group"> 
				<div class="row">
					<div class="col-lg-6">
						<div class="field-group__item">
							<label class="field-group__label">Маршрут</label>
							<div class="field-group__box">
								<input class="field-group__input" type="text" name="transfer_route" autocomplete="off">
							</div>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="field-group__item">
							<label class="field-group__label">Начало</label>
							<div class="field-group__box">
								<input class="field-group__input" type="text" data-name="date_start" data-format="date" name="datetransfer_start"
								autocomplete="off">
								<div class="field-group__trigger">
									<i class="fa-regular fa-calendar-days calendar-icon"></i>
									<input class="input-trigger" type="text" data-trigger="date_start" autocomplete="off">
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="field-group__item">
							<label class="field-group__label">Окончание</label>
							<div class="field-group__box">
								<input class="field-group__input" type="text" data-name="date_end" data-format="date" name="datetransfer_end"
								autocomplete="off">
								<div class="field-group__trigger">
									<i class="fa-regular fa-calendar-days calendar-icon"></i>
									<input class="input-trigger" type="text" data-trigger="date_end" autocomplete="off">
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="field-group__item">
							<label class="field-group__label">Тип трансфера</label>
							<select class="select-choices" name="transfer_type" id="selectTransferType">
								{{-- <option value="" selected></option>
								@php
									$transferTypes = ServiceHelper::transferType();
								@endphp
								@foreach ($transferTypes as $transfer)
									<option
										value="{{old($transfer['value']) ?: $transfer['value']}}">
										{{old($transfer['title']) ?: $transfer['title']}}
									</option>
								@endforeach --}}
							</select>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="field-group__item">
							<label class="field-group__label">Вид транспорта</label>
							<div class="field-group__box">
								<input class="field-group__input" type="text" name="transfer_transport" autocomplete="off">
							</div>
						</div>
					</div>
					<div class="col-12">
						@include('claim.tourists.list_tourists')
					</div>
				</div>
			</div>
		</div>
		@include('components.modal_footer')
	</form>
@endcomponent
