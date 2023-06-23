<div class="group-data__item item-group" id="groupDataTourpackage">
	<div class="item-group__top">
		<div class="item-group__title">ИНФОРМАЦИЯ О ТУРПАКЕТЕ</div>
		<button class="item-group__button btn-blue btn-redact" type="button" 
			data-bs-toggle="modal" data-bs-target="#tourpackageModal"
			data-id="{{$claim->id}}" 
			data-type="update"
			data-claim-id="{{$claim->id}}"
			data-url="{{route('tourpackage.store', $claim->id)}}"
			data-path="{{route('tourpackage.loadModal', [$claim->id, 'update'])}}"
			data-title="Турпакет">
			{{$claim->tourpackage ? '[изменить]' : '[добавить]'}}
		</button>
	</div>
	@php
		$start_ts = strtotime($claim->date_start);
		$end_ts = strtotime($claim->date_end); 
		$diff = $end_ts - $start_ts; 
		$resultDiff = round($diff / 86400);
	@endphp
	@if ($claim->tourpackage)
		<ul class="item-group__list list">
			<li class="list__item">
				<div class="list__label">СПО</div>
				<div class="list__value">{{$claim->tourpackage->name}}</div>
			</li>
			<li class="list__item">
				<div class="list__label">ДАТЫ ТУРА</div>
				<div class="list__value">{{$claim->date_start->format('d.m.Y')}} - {{$claim->date_end->format('d.m.Y')}}</div>
			</li>
			<li class="list__item">
				<div class="list__label">НАПРАВЛЕНИЕ</div>
				<div class="list__value">
					@php
						$countries = TourPackageHelper::country();
						$cities = TourPackageHelper::city();
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
				</div>
			</li>
			<li class="list__item">
				<div class="list__label">НОЧЕЙ</div>
				<div class="list__value">{{$resultDiff}} {{Lang::choice('ночь|ночи|ночей', $resultDiff, [], 'ru')}}</div>
			</li>
		</ul>
	@endif
</div>