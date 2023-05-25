<div class="data-claim__group group-data" id="groupDataTourist">
	<header class="group-data__header">
		<h2 class="group-data__title">Туристы</h2>
		<div class="group-data__buttons">
			{{-- <button class="btn btn-blue btn-primary" type="button">
				Отправить ссылку на заполнение данных
			</button> --}}
			<button class="btn btn-blue btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#addTourist">
				<i class="fa-regular fa-plus"></i>
				Добавить туриста
			</button>
		</div>
	</header>
	<div class="group-data__subheader">
		<i>Для граждан РФ при бронировании направления Россия заселение в отель и авиаперевозка производится 
			<strong>только по паспорту гражданина РФ</strong>
		</i>
		<br>
		<i>
			<strong>Важно!</strong>Замена данных в заявке с заграничного паспорта на российский и наоборот 
			<strong>является перебронированием.</strong>
		</i>
		<br>
		<i>
			<strong>Внимание!</strong> 
			Паспортные данные граждан СНГ и иностранных граждан других государств вносятся латиницей как в паспорте.	
		</i>
	</div>
	<div class="group-data__area area-group">
		<div class="area-group__body">
			@if ($claim->tourist && count($claim->tourist) > 0)
			<div class="table-responsive">
				<table class="tourist-table table" id="tourist-table"> 
					<thead> 
						<th style="width: 20%">Фио туриста</th>
						<th style="width: 5%">Пол</th>
						<th style="width: 15%">Дата рождения</th>
						<th style="width: 20%">Паспортные данные / Св-во о рождении</th>
						<th style="width: 20%">Контакты</th>
						<th style="width: 15%">Виза</th>
						<th style="width: 5%">Действия</th>
					</thead>
					<tbody>
							@foreach ($claim->tourist as $key => $tourist)
								<tr>
									<td class="tourist-table__name">
										{{$tourist->tourist_surname}}
										{{$tourist->tourist_name}}
										{{$tourist->tourist_patronymic ?: ''}}
									</td>
									<td class="tourist-table__gender">
										{{$tourist->common->tourist_gender == 'male' ? 'М' : 'Ж'}}
									</td>
									<td class="tourist-table__date">
										{{$tourist->common->tourist_birthday ?: ''}}
									</td>
									<td class="tourist-table__passport">
										@if ($tourist->passport || $tourist->certificate)
											<ul>
												@if ($tourist->passport)
													<li>
														<span>РФ:</span>
														<span>
															{{$tourist->passport->tourist_passport_series ?: '-'}} 
															{{$tourist->passport->tourist_passport_number ?: '-'}}
														</span>
													</li>
												@endif
												@if ($tourist->certificate)
													<li>
														<span>Св-во:</span>
														<span>
															{{$tourist->certificate->tourist_certificate_series ?: '-'}}
															{{$tourist->certificate->tourist_certificate_number ?: '-'}}
														</span>
													</li>
												@endif
											</ul>
										@else
											Не указаны	
										@endif
									</td>
									<td class="tourist-table__contacts">
										@if ($tourist->common && $tourist->common->tourist_phone || $tourist->common->tourist_email)
											<ul>
												@if ($tourist->common->tourist_phone)
													<li>
														<span>Тел:</span>
														@php
															$phone = preg_replace('/[^0-9]/', '', $tourist->common->tourist_phone);
														@endphp
														<span>
															<a href="tel:{{$phone}}">{{$phone}}</a>
														</span>
													</li>
												@endif
												@if ($tourist->common->tourist_email)
													<li>
														<span>Email:</span>
														<span>
															<a href="mailto:{{$tourist->common->tourist_email}}">
																{{$tourist->common->tourist_email}}
															</a>
														</span>
													</li>
												@endif
											</ul>
										@else
											Не указаны
										@endif
									</td>
									<td class="tourist-table__visa">
										@php
											$cities = TouristHelper::city();
										@endphp
										<ul>
											<li>
												<span>{{$tourist->common->visa_info == 'not' ? 'не требуется' : 'надо оформить визу'}}</span>
											</li>
											@if ($tourist->common && $tourist->common->visa_info == 'yes' )
												<li>
													<span>
														@foreach ($cities as $key => $city)
															{{$key == $tourist->common->visa_city ? $city['name'] : ''}}
														@endforeach
													</span>
												</li>
											@endif
										</ul>
									</td>
									<td class="tourist-table__actions">
										<div class="table__buttons">
											<div class="table__button-item" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Редактировать данные о туристе">
												<button class="btn-gear" type="button" data-claim-id="{{$claim->id}}" data-id="{{$tourist->id}}" data-action="update" data-url="{{route('tourist.update', $tourist->id)}}" data-bs-toggle="modal" data-bs-target="#updateTourist">
													<i class="fa-solid fa-gear"></i>
												</button>
											</div>
											<div class="table__button-item" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Удалить туриста">
												<button class="btn-trash" type="button" data-type="delete" data-id="{{$tourist->id}}" data-url="{{route('tourist.destroy', $tourist->id)}}" data-bs-toggle="modal" data-bs-target="#deleteRecord">
													<i class="fa-solid fa-trash-can"></i>
												</button>
											</div>
											{{-- <div class="table__button-item" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Добавить во все услуги заявки">
												<button class="btn-linkify" type="button">
													<i class="fa-solid fa-link"></i>
												</button>
											</div> --}}
										</div>
										{{-- @include('claim.tourists.modals.update_tourist', ['tourist' => $tourist]) --}}
									</td>
								</tr>
								<tr class="join">
									<td class="tourist-table__name">
										<span>
											{{$tourist->common && $tourist->common->tourist_surname_lat ? $tourist->common->tourist_surname_lat : ''}}
											{{$tourist->common && $tourist->common->tourist_name_lat ? $tourist->common->tourist_name_lat : ''}}
										</span>
									</td>
									<td class="tourist-table__gender"></td>
									<td class="tourist-table__date"></td>
									<td class="tourist-table__passport">
										@if ($tourist->internationalPassport)
											<ul>	
												<li> 
													<span>ЗГРН:</span>
													<span>
														{{$tourist->internationalPassport 
															&& $tourist->internationalPassport->tourist_international_passport_series
															? $tourist->internationalPassport->tourist_international_passport_series : '-'}}
														-
														{{$tourist->internationalPassport 
															&& $tourist->internationalPassport->tourist_international_passport_number
															? $tourist->internationalPassport->tourist_international_passport_number : '-'}}
													</span>
												</li>
											</ul>
										@endif
									</td>
									<td class="tourist-table__contacts"></td>
									<td class="ourist-table__visa"></td>
									<td class="tourist-table__actions"></td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			@else
				<div class="area-group__empty">
					Туристы не указаны
				</div>
			@endif
		</div>
	</div>
</div>