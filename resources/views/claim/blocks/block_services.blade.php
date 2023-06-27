<div class="data-claim__group group-data" id="groupDataServices">
	<header class="group-data__header">
		<h1 class="group-data__title">Детали тура</h1>
		<div class="group-data__buttons">
			<button class="btn btn-blue btn-primary" type="button">
				Создать заявку на доп.услугу
			</button>
			<div class="dropdown">
				<button class="btn btn-blue btn-primary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
					<i class="fa-regular fa-plus"> </i>
					Добавить услугу
				</button>
				@php
					$serviceButtons = [
						['title' => 'Перелёт', 'modalId' => '#addFlight'],
						['title' => 'Страховка', 'modalId' => '#addInsurance'],
						['title' => 'Трансфер', 'modalId' => '#addTransfer'],
						['title' => 'Виза', 'modalId' => '#addVisa'],
						['title' => 'Проживание', 'modalId' => '#addHabitation'],
						['title' => 'Топливный сбор', 'modalId' => '#addFuelSurcharge'],
						['title' => 'Экскурсионная программа', 'modalId' => '#addExcursionProgram'],
						['title' => 'Другая услуга', 'modalId' => '#addOtherService'],
					];
				@endphp
				<ul class="dropdown-menu dropdown__menu">
					@foreach ($serviceButtons as $item)
						<li class="dropdown-menu__item">
							<button class="dropdown-menu__button" type="button" data-bs-toggle="modal" data-bs-target={{$item['modalId']}}>{{$item['title']}}</button>
						</li>
					@endforeach
				</ul>
			</div>
		</div>
	</header>
	<div class="group-data__area area-group">
		<div class="area-group__body">
			<div class="area-group__header"> 
				<h3 class="area-group__title">УСЛУГИ В ТУРПАКЕТЕ</h3>
			</div>
		</div>
		@if (count($claim->serviceFlight) > 0 || count($claim->serviceInsurance) > 0 
			|| count($claim->serviceTransfer) > 0 || count($claim->serviceVisa) > 0 
			|| count($claim->serviceHabitation) > 0 || count($claim->serviceFuelSurchange) > 0
			|| count($claim->serviceExcursion) > 0 || count($claim->serviceOther) > 0)
			<div class="table-responsive">
				<table class="detailtour-table table" id="table-detailtour">
					<thead> 
						<th style="width: 160px;">Услуга</th>
						<th style="width: 40px;"></th>
						<th style="width: auto;">Описание</th>
						<th style="width: 270px;">Даты</th>
						<th style="width: 100px;">Туристы</th>
						<th style="width: 80px;">Действия</th>
					</thead>
					<tbody>
						@include('claim.services.outputs.output_flight')
						@include('claim.services.outputs.output_insurance')
						@include('claim.services.outputs.output_transfer')
						@include('claim.services.outputs.output_visa')
						@include('claim.services.outputs.output_habitation')
						@include('claim.services.outputs.output_fuel_surchange')
						@include('claim.services.outputs.output_excursion')
						@include('claim.services.outputs.output_other')
					</tbody>
				</table>
			</div>
		@else
			<div class="area-group__empty">
				Услуги не указаны
			</div>
		@endif
	</div>
</div>