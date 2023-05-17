@extends('layouts.app')
@section('title','Главная страница')
@section('header')
	@include('layouts.header')
@endsection
@section('content')
	<div class="container">
		<div class="main__top"> 
			<div class="main__title">Активные заявки</div>
			<div class="main__button">
				<button class="btn btn-request" type="button" data-bs-toggle="modal" data-bs-target="#createClaim">Создать заявку</button>
			</div>
		</div>
		<div class="filters">
			<form action="" class="form">
				<div class="filters__top">
					<div class="filters__column">
						<div class="filters__row field-group" style="--col: 3">
							<div class="field-group__item">
								<label class="field-group__label">ФИО ТУРИСТА</label>
								<div class="field-group__box">
								<input class="field-group__input" type="text" name="fio">
								</div>
							</div>
							<div class="field-group__item">
								<label class="field-group__label">НАЧАЛО ТУРА (ОТ)</label>
								<div class="field-group__box">
									<input class="field-group__input" type="text" data-name="date_start" data-format="date" name="date_start">
									<div class="field-group__trigger">
										<i class="fa-regular fa-calendar-days calendar-icon"></i>
										<input class="input-trigger" type="text" data-trigger="date_start">
									</div>
								</div>
							</div>
							<div class="field-group__item">
								<label class="field-group__label">НАЧАЛО ТУРА (ДО)</label>
								<div class="field-group__box">
									<input class="field-group__input" type="text" data-name="date_end" data-format="date" name="date_end">
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
								<button class="btn btn-reset" type="button">
									<i class="fa-solid fa-xmark"></i>
									Сброс
								</button>
							</div>
							<div class="filters__button">
								<button class="btn btn-search" type="button">
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
			<table class="tour-table table" id="table-id">
				<thead> 
					<tr>
						<th tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width:130px;">Номер</th>
						<th tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width:auto">Начало тура</th>
						<th tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width:auto">Cтраны назначения</th>
						<th tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width:auto">Заказчик, туристы</th>
						<th tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width:auto">Поставщик, стоимость у ТО и оплата ТА</th>
						<th tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width:auto">Заказчик, стоимость и долг заказчика</th>
						<th tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width:auto">Менеджер</th>
						<th tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width:auto"></th>
						{{-- <th tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width:auto"></th> --}}
					</tr>
				</thead>
				<tbody>
					
					@foreach ($claims as $claim)
						@php
							$start_ts = strtotime($claim->date_start);
							$end_ts = strtotime($claim->date_end); 
							$diff = $end_ts - $start_ts; 
							$resultDiff = round($diff / 86400);
						@endphp
						<tr>
							<td class="tour-table__number">
								<a class="tour-table__link" href="{{route('claim.show', $claim->id)}}">{{$claim->id}}</a>
							</td>
							<td class="tour-table__data">
								<span class="fw-600">{{$claim->date_start ? $claim->date_start->format('d.m.Y') : ''}} </span>
								</br>
								({{$resultDiff}} {{Lang::choice('ночь|ночи|ночей', $resultDiff, [], 'ru')}})
							</td>
							<td class="tour-table__data">
								@if ($claim->tourpackage)
									@php
										$cities = TourPackageHelper::city();
										$countries = TourPackageHelper::country();
									@endphp
									<span>
										@foreach ($cities as $key => $city)
											{{$key === $claim->tourpackage->city_id ? $city['name'] : ''}}
										@endforeach
									</span>
									- 
									<span>
										@foreach ($countries as $key => $country)
											{{$key === $claim->tourpackage->country_id ? $country['name'] : ''}}
										@endforeach
									</span>
								@else
									<span>Не указано - Не указано</span>
								@endif
							</td>
							<td class="tour-table__customer">
								@if ($claim->customer)
									@if ($claim->customer->type === 'person')
										<div class="text-clamp fw-600"
										title="{{$claim->customer->person ? $claim->customer->person->person_surname : ''}} {{$claim->customer->person ? $claim->customer->person->person_name : ''}} {{$claim->customer->person ? $claim->customer->person->person_patronymic : ''}}">
											{{$claim->customer->person ? $claim->customer->person->person_surname : ''}} 
											{{$claim->customer->person ? $claim->customer->person->person_name : ''}} 
											{{$claim->customer->person ? $claim->customer->person->person_patronymic : ''}}
										</div>
									@elseif($claim->customer->type === 'company')
										<div class="text-clamp fw-600"
										title="{{$claim->customer->company->company_fullname ?: 'Полное наименование юр. лица не указано'}}">
											{{$claim->customer->company->company_fullname ?: 'Полное наименование юр. лица не указано'}}
										</div>
									@endif
								@else
									<div class="fw-600">
										Заказчик не указан
									</div>
								@endif
								@if ($claim->tourist && count($claim->tourist) > 0)
									@php
										$tourists = [];
										$stringTourists = '';
										foreach ($claim->tourist as $key => $item) {
											$currentTourist = [
												'surname' => $item->tourist_surname,
												'name' => Str::limit($item->tourist_name, 1, '.'),
												'patronymic' => Str::limit($item->tourist_patronymic, 1, '.')
											];
											array_push($tourists, $currentTourist);
										}
										foreach ($tourists as $key => $item) {
											$stringTourists .= $item['surname'] . ' ';
											$stringTourists .= $item['name'] . ' ';
											$stringTourists .= $item['patronymic'] . '';
											if (count($tourists) > 1) {
												$stringTourists .= ", ";
											}
										}
									@endphp
									<div class="text-clamp" title="{{$stringTourists}}">
										<b>{{count($claim->tourist)}}:</b>
											{{$stringTourists}}
									</div>
								@else
									<div>
										Туристы не указаны
									</div>
								@endif
							</td>
							<td></td>
							<td></td>
							<td class="tour-table__manager">
								<div> 
									<a class="tour-table__link" href="#">Тихановская И. В.</a>
									<div>{{$claim->created_at}}</div>
								</div>
							</td>
							<td>
								<div class="table__button" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Перенести в архив">
									<button class="btn-archive" type="button" data-bs-toggle="modal" data-bs-target="#deleteRecord" data-type="delete" data-id="{{$claim->id}}" data-url="{{route('claim.destroy', $claim->id)}}">
										<i class="fa-solid fa-box-archive"></i>
									</button>
								</div>
							</td>
							{{-- <td>
								<button class="btn-copy" type="button" data-bs-toggle="tooltip" aria-label="Клонировать заявку" data-bs-original-title="Клонировать заявку">
									<i class="fa-solid fa-copy"></i>
								</button>
							</td> --}}
						</tr>
					@endforeach
				</tbody>
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
{{-- @section('page-script')
@endsection --}}