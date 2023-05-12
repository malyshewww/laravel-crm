<div class="modal fade" id="tourpackageModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content modal__content">
			<div class="modal__header">
				<div class="modal__title">Турпакет</div>
				<button class="modal__close" type="button" data-bs-dismiss="modal" aria-label="Close">
					<i class="fa-solid fa-xmark"></i>
				</button>
			</div>
			<form action="{{route('tourpackage.store', $claim->id)}}" method="post" id="formTourpackage" class="form">
				@csrf
				<input type="hidden" name="id" value="{{$claim->id}}">
				<div class="modal__body">
					<div class="field-group">
						<div class="row">
							<div class="col-lg-6">
								<div class="field-group__item">
									<label class="field-group__label">Название</label>
									<div class="field-group__box">
										<input class="field-group__input" type="text" name="name" value="{{$claim->tourpackage ? $claim->tourpackage->name : ''}}">
									</div>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="field-group__item">
									<label class="field-group__label">Начало</label>
									<div class="field-group__box">
										<input class="field-group__input" type="text" data-name="date_start" data-format="date" name="date_start" 
										value="{{$claim->date_start->format('Y-m-d')}}">
										<div class="field-group__trigger"><i class="fa-regular fa-calendar-days calendar-icon"></i>
											<input class="input-trigger" type="text" data-trigger="date_start">
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="field-group__item">
									<label class="field-group__label">Окончание</label>
									<div class="field-group__box">
										<input class="field-group__input" type="text" data-name="date_end" data-format="date" name="date_end" 
										value="{{$claim->date_end->format('Y-m-d')}}">
										<div class="field-group__trigger">
											<i class="fa-regular fa-calendar-days calendar-icon"></i>
											<input class="input-trigger" type="text" data-trigger="date_end">
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="field-group__item">
									<label class="field-group__label">Город вылета</label>
									<select name="city_id" class="select-choices">
										<option value=""></option>
										@php
											$cities = TourPackageHelper::city();
										@endphp
										@foreach ($cities as $key => $city)
											<option
												{{$claim->tourpackage && $key === $claim->tourpackage->city_id ? ' selected' : ''}}
												value="{{$key}}">
												{{$city['name']}}
											</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="field-group__item">
									<label class="field-group__label">Страна прилета</label>
									<select name="country_id" class="select-choices">
										<option value=""></option>
										@php
											$countries = TourPackageHelper::country();
										@endphp
										@foreach ($countries as $key => $country)
											<option
												{{$claim->tourpackage && $key === $claim->tourpackage->country_id ? ' selected' : ''}}
												value="{{$key}}">
												{{$country['name']}}
											</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal__footer">
					<div class="modal__buttons">
						<button class="btn btn-create btn-primary" type="submit">
							<i class="fa-solid fa-check"></i>
							Сохранить
						</button>
						<button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Закрыть</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>