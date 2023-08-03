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
	@if ($claim->tourpackage)
		@php
			$start_ts = strtotime($claim->date_start);
			$end_ts = strtotime($claim->date_end); 
			$diff = $end_ts - $start_ts; 
			$resultDiff = round($diff / 86400);
			$countries = TourPackageHelper::country();
			$cities = TourPackageHelper::city();
			$currentCity = '';
			$currentCountry = '';
			foreach ($cities as $keyCity => $city) {
				if ($keyCity === $claim->tourpackage->city_id) $currentCity = $city['name'];
			}
			foreach ($countries as $keyCountry => $country) {
				if ( $keyCountry === $claim->tourpackage->country_id) $currentCountry = $country['name'];
			}
			$dateStart = $claim->date_start ? $claim->date_start->format('d.m.Y') : '';
			$dateEnd = $claim->date_end ? $claim->date_end->format('d.m.Y') : '';
			$tourpackageList = [
				['label' => 'СПО', 'value' => $claim->tourpackage->name ?: ''], 
				['label' => 'ДАТЫ ТУРА', 'value' => $dateStart . ' - ' . $dateEnd],
				['label' => 'НАПРАВЛЕНИЕ', 'value' => $currentCity . ' - ' . $currentCountry],
				['label' => 'НОЧЕЙ', 'value' => $resultDiff . ' ' . Lang::choice('ночь|ночи|ночей', $resultDiff, [], 'ru')],
			];
			@endphp
		<ul class="item-group__list list">
			@foreach ($tourpackageList as $item)
				<li class="list__item">
					<div class="list__label">{{$item['label']}}</div>
					<div class="list__value">{{$item['value']}}</div>
				</li>
			@endforeach
		</ul>
	@endif
</div>