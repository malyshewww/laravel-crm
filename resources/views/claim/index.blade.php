@extends('layouts.app')
@section('title','Главная страница')
@section('content')
	<div class="container">
		<div class="main__top"> 
			<div class="main__title">Активные заявки</div>
			<div class="main__button">
				<button class="btn btn-request" type="button" data-bs-toggle="modal" data-bs-target="#createClaim">Создать заявку</button>
			</div>
		</div>
		<div class="filters">
			<form action="{{route('claim.records')}}" id="formFilter">
				@csrf
				<div class="filters__top">
					<div class="filters__column">
						<div class="filters__row field-group" style="--col: 3">
							<div class="field-group__item">
								<label class="field-group__label">ФИО ТУРИСТА</label>
								<div class="field-group__box">
									<input class="field-group__input" id="fio" type="text" name="fio" value={{request()->get('fio') ?: ''}}>
								</div>
							</div>
							<div class="field-group__item">
								<label class="field-group__label">НАЧАЛО ТУРА (ОТ)</label>
								<div class="field-group__box">
									<input class="field-group__input" id="tour_start" type="text" data-name="date_start" data-format="date" name="date_start"
									value="{{request()->get('date_start') ?: ''}}">
									<div class="field-group__trigger">
										<i class="fa-regular fa-calendar-days calendar-icon"></i>
										<input class="input-trigger" type="text" data-trigger="date_start">
									</div>
								</div>
							</div>
							<div class="field-group__item">
								<label class="field-group__label">НАЧАЛО ТУРА (ДО)</label>
								<div class="field-group__box">
									<input class="field-group__input" id="tour_end" type="text" data-name="date_end" data-format="date" name="date_end"
									value="{{request()->get('date_end') ?: ''}}">
									<div class="field-group__trigger">
										<i class="fa-regular fa-calendar-days calendar-icon"></i>
										<input class="input-trigger" type="text" data-trigger="date_end">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="filters__column">
						<div class="filters__buttons">
							<div class="filters__button">
								<button class="btn btn-reset" type="reset">
									<i class="fa-solid fa-xmark"></i>
									Сброс
								</button>
							</div>
							<div class="filters__button">
								<button class="btn btn-search" type="submit">
									<i class="fa-solid fa-binoculars"></i>
									Поиск
								</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
		<div class="table-responsive">
			<table class="tour-table table" id="tour-table">
				<thead> 
					<tr>
						<th tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width:130px;">Номер</th>
						<th tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width:auto">Начало тура</th>
						<th tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width:auto">Cтраны назначения</th>
						<th tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width:auto">Заказчик</th>
						<th tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width:auto">Туристы</th>
						<th tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width:auto">Заказчик, стоимость и долг заказчика</th>
						<th tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width:auto">Менеджер</th>
						<th tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width:auto"></th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
		<div class="table-bottom">
			<nav class="pagination"></nav>
			<div class="sorting-block"></div>
		</div>
	</div>
@endsection
@section('page-modal')
	@include('claim.indexmodals.createclaim')
	@include('claim.showmodals.delete_record')
@endsection
@section('page-script')
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
	<script src="{{asset('scripts/tables.js')}}"></script>
@endsection
