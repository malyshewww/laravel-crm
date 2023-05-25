function formData() {
	const url = BASE_URL;
	let forms = document.querySelectorAll('.form');
	[...forms].forEach((form) => {
		if (form) {
			const formId = form.getAttribute('id');
			const route = form.getAttribute('action');
			if (formId != 'formTouristUpdate') {
				form.addEventListener('submit', (event) => {
					event.preventDefault();
					const thisForm = event.target;
					const currentModal = thisForm.closest('.modal');
					const formData = new FormData(thisForm);
					const buttonSubmit = thisForm.querySelector('button[type="submit"]');
					const formGroup = thisForm.querySelector('.field-group')
					buttonSubmit.setAttribute('disabled', 'true');
					const inputDateStart = thisForm.date_start;
					const inputDateEnd = thisForm.date_end;
					const inputComment = thisForm.comment;
					const inputSurname = formId == 'formCustomer' ? thisForm.person_surname : thisForm.tourist_surname;
					const inputName = formId == 'formCustomer' ? thisForm.person_name : thisForm.tourist_name;
					const selectGender = formId == 'formCustomer' ? thisForm.person_gender : thisForm.tourist_gender;
					const selectNationality = formId == 'formCustomer' ? thisForm.person_nationality : thisForm.tourist_nationality;
					const inputBirthday = formId == 'formCustomer' ? thisForm.person_birthday : thisForm.tourist_birthday;
					const selectVisa = thisForm.visa_info;
					const token = thisForm._token;
					const inputId = thisForm.id?.value;
					const formInputs = formGroup?.querySelectorAll('input');
					const formSelects = formGroup?.querySelectorAll('select');
					// const routes = {
					// 	'formCreateClaim': `${url}/claims`,
					// 	'formComment': `${url}/claims/${inputId}`,
					// 	'formTourpackage': `${url}/tourpackages/${inputId}`,
					// 	'formTouroperator': `${url}/touroperators/${inputId}`,
					// 	'formCustomer': `${url}/customers/${inputClaimId}`,
					// 	'formTourist': `${url}/tourists/${inputTouristId}`,
					// 	'formFlights': `${url}/flights`,
					// 	'formInsurance': `${url}/insurances`,
					// 	'formTransfer': `${url}/transfers`,
					// 	'formVisa': `${url}/visas`,
					// 	'formHabitation': `${url}/habitations`,
					// 	'formFuelSurchange': `${url}/fuelsurchanges`,
					// 	'formExcursion': `${url}/excursions`,
					// 	'formOtherService': `${url}/otherservices`,
					// 	'formTouristUpdate': `${url}/tourists/update/${inputTouristId}`,
					// 	'formFlightsUpdate': `${url}/flights/update`,
					// 	'formInsuranceUpdate': `${url}/insurances/update`,
					// 	'formTransferUpdate': `${url}/transfers/update`,
					// 	'formVisaUpdate': `${url}/visas/update`,
					// 	'formHabitationUpdate': `${url}/habitations/update`,
					// };
					// const route = getRoute(formId, routes);
					fetch(route, {
						headers: {
							"X-CSRF-Token": token
						},
						method: 'POST',
						body: formData,
					})
						.then((response) => response.json())
						.then((result) => {
							if (result.status === 'success') {
								inputDateStart ? inputDateStart.value = '' : null;
								inputDateEnd ? inputDateEnd.value = '' : null;
								inputComment ? inputComment.value = '' : null;
								$(currentModal).modal('hide');
								if (formId == 'formCreateClaim') {
									setTimeout(() => {
										window.location.href = `${url}/claims/${inputId}`;
									}, 500);
								}
								if (formId == 'formComment') {
									elementUpdate('.comment-claim__text')
								}
							} else {
								if (result.date_start) {
									inputDateStart.classList.add('error');
								}
								if (result.date_end) {
									inputDateEnd.classList.add('error');
								}
								if (result.person_surname || result.tourist_surname) {
									inputSurname.classList.add('error');
								}
								if (result.person_name || result.tourist_name) {
									inputName.classList.add('error');
								}
								if (result.person_gender || result.tourist_gender) {
									selectGender.parentNode.classList.add('error');
								}
								if (result.person_nationality || result.tourist_nationality) {
									selectNationality.parentNode.classList.add('error');
								}
								if (result.person_birthday || result.tourist_birthday) {
									inputBirthday.classList.add('error');
								}
								if (result.visa_info) {
									selectVisa.parentNode.classList.add('error');
								}
							}
							buttonSubmit.removeAttribute('disabled');
						})
						.catch((error) => {
							buttonSubmit.removeAttribute('disabled');
						})
				})
			}
		}
	})
}
function getRoute(formId, obj) {
	for (const [key, value] of Object.entries(obj)) {
		if (key == formId) return value;
	}
}
formData();

// // Создание заявки
// formData('formCreateClaim');
// // Добавление/Редактирование комментария
// formData('formComment');
// // Добавление/Редактирование данных турпакета
// formData('formTourpackage');
// // Добавление/Редактирование данных туроператора
// formData('formTouroperator');
// // Добавление/Редактирование данных о заказчике
// formData('formCustomer');
// // Добавление данных о туристе
// formData('formTourist');
// // Обновление данных о туристе
// formData('formTouristUpdate');
// // Добавление данных об услуге - Перелёт
// formData('formFlights');
// // Обновление данных об услуге - Перелёт
// formData('formFlightsUpdate');
// // Добавление данных об услуге - Страховка
// formData('formInsurance');
// // Обновление данных об услуге - Страховка
// formData('formInsuranceUpdate');
// // Добавление данных об услуге - Трансфер
// formData('formTransfer');
// // Обновление данных об услуге - Трансфер
// formData('formTransferUpdate');
// // Добавление данных об услуге - Виза
// formData('formVisa');
// // Обновление данных об услуге - Виза
// formData('formVisaUpdate');
// // Добавление данных об услуге - Проживание
// formData('formHabitation');
// // Обновление данных об услуге - Проживание
// formData('formHabitationUpdate');

// // Добавление данных об услуге - Топливный сбор
// formData('formFuelSurchange');
// // Добавление данных об услуге - Экскурсионная программа
// formData('formExcursion');
// // Добавление данных об услуге - Другая услуга
// formData('formOtherService');





// const modalUpdateTourist = document.getElementById('updateTourist');
// if (modalUpdateTourist) {
// 	modalUpdateTourist.addEventListener('shown.bs.modal', (event) => {
// 		const thisModal = event.target;
// 		const form = thisModal.querySelector('form');
// 		const formData = new FormData(form);
// 		const modalBody = form.querySelector('.modal__body');
// 		const btn = event.relatedTarget;
// 		const dataId = btn.dataset.id;
// 		const dataClaimId = btn.dataset.claimId;
// 		const dataUrl = btn.dataset.url;
// 		const inputClaimId = form.claim_id;
// 		const inputTouristId = form.tourist_id;
// 		const inputSurname = form.tourist_surname;
// 		const token = form._token;
// 		form.setAttribute('action', dataUrl);
// 		inputClaimId.value = dataClaimId;
// 		inputTouristId.value = dataId;
// 		fetch(`/tourists/${dataId}/data`, {
// 			headers: {
// 				"X-CSRF-Token": token
// 			},
// 			method: 'GET',
// 		})
// 			.then(response => response.status === 200 ? response.json() : console.log('Подключения к сети нет '))
// 			.then((data) => {
// 				// inputSurname.value = data.tourist.tourist_surname;
// 				console.log(data);
// 				const choiceConfig = {
// 					searchEnabled: false,
// 					noResultsText: "Ничего не найдено",
// 					itemSelectText: "",
// 					searchPlaceholderValue: "Поиск",
// 					placeholder: false,
// 					allowHTML: true,
// 					removeItemButton: true,
// 					searchResultLimit: 8,
// 					shouldSort: false,
// 				};
// 				let newArrGender = data.genders.map((gender, index) => {
// 					return {
// 						label: gender.title,
// 						value: gender.value,
// 						id: index + 1,
// 						selected: gender.value == data.common.tourist_gender ? true : false,
// 					}
// 				})
// 				let newArrNationality = data.nationalities.map((nationality, index) => {
// 					return {
// 						label: nationality.title,
// 						value: nationality.value,
// 						id: index + 1,
// 						selected: nationality.value == data.common.tourist_nationality ? true : false,
// 					}
// 				})
// 				let newArrVisa = data.visaOpts.map((visa, index) => {
// 					return {
// 						label: visa.title,
// 						value: visa.value,
// 						id: index + 1,
// 						selected: visa.value == data.common.visa_info ? true : false,
// 					}
// 				})
// 				let newArrCities = data.cities.map((city, index) => {
// 					return {
// 						label: city.name,
// 						value: index,
// 						id: index,
// 						selected: index == data.common.visa_city ? true : false,
// 					}
// 				})
// 				setTimeout(() => {
// 					const selectTouristGender = form.querySelectorAll('[data-gender]');
// 					[...selectTouristGender].forEach((select) => {
// 						let choices = new Choices(select, choiceConfig);
// 						choices.setChoices(newArrGender, 'value', 'label');
// 					})
// 					const selectTouristNatinality = form.querySelectorAll('[data-nationality]');
// 					[...selectTouristNatinality].forEach((select) => {
// 						let choices = new Choices(select, choiceConfig);
// 						choices.setChoices(newArrNationality, 'value', 'label');
// 					})
// 					const selectTouristVisa = form.querySelectorAll('[data-visas]');
// 					[...selectTouristVisa].forEach((select) => {
// 						let choices = new Choices(select, choiceConfig);
// 						choices.setChoices(newArrVisa, 'value', 'label');
// 					})
// 					const selectTouristCities = form.querySelectorAll('[data-cities]');
// 					[...selectTouristCities].forEach((select) => {
// 						let choices = new Choices(select, choiceConfig);
// 						choices.setChoices(newArrCities, 'value', 'label');
// 					})
// 				}, 100)
// 				formBody = `
// 					<div class="field-group">
// 						<div class="row">
// 							<div class="col-12">
// 								<div class="checkbox">
// 									<label>
// 										<input class="checkbox__input" type="checkbox" data-trigger="translit" name="translit_tourist">
// 										<span class="checkbox__label">
// 											Включить транслитерацию по госту 2016
// 										</span>
// 									</label>
// 								</div>
// 							</div>
// 							<div class="col-lg-3 col-md-6">
// 								<div class="field-group__item">
// 									<label class="field-group__label required">Фамилия</label>
// 									<div class="field-group__box">
// 										<input class="field-group__input" type="text" data-name="surname" name="tourist_surname" required
// 										value="${data.tourist.tourist_surname ? data.tourist.tourist_surname : ''}">
// 									</div>
// 								</div>
// 							</div>
// 							<div class="col-lg-3 col-md-6">
// 								<div class="field-group__item">
// 									<label class="field-group__label required">Имя</label>
// 									<div class="field-group__box">
// 										<input class="field-group__input" type="text" data-name="name" name="tourist_name" required
// 										value="${data.tourist.tourist_name ? data.tourist.tourist_name : ''}">
// 									</div>
// 								</div>
// 							</div>
// 							<div class="col-lg-3 col-md-6">
// 								<div class="field-group__item">
// 									<label class="field-group__label">Отчество</label>
// 									<div class="field-group__box">
// 										<input class="field-group__input" type="text" name="tourist_patronymic"
// 										value="${data.tourist.tourist_patronymic ? data.tourist.tourist_patronymic : ''}">
// 									</div>
// 								</div>
// 							</div>
// 							<div class="col-lg-3 col-md-6">
// 								<div class="field-group__item">
// 									<label class="field-group__label required">Пол</label>
// 									<select name="tourist_gender" required data-gender="tourist_gender"></select>
// 								</div>
// 							</div>
// 							<div class="col-lg-3 col-md-6">
// 								<div class="field-group__item">
// 									<label class="field-group__label">Фамилия (LAT)</label>
// 									<div class="field-group__box">
// 										<input class="field-group__input" type="text" data-name="surname_lat" name="tourist_surname_lat"
// 										value="${data.common.tourist_surname_lat ? data.common.tourist_surname_lat : ''}">
// 									</div>
// 								</div>
// 							</div>
// 							<div class="col-lg-3 col-md-6">
// 								<div class="field-group__item">
// 									<label class="field-group__label">Имя (LAT)</label>
// 									<div class="field-group__box">
// 										<input class="field-group__input" type="text" data-name="name_lat" name="tourist_name_lat"
// 										value="${data.common.tourist_name_lat ? data.common.tourist_name_lat : ''}">
// 									</div>
// 								</div>
// 							</div>
// 							<div class="col-lg-3 col-md-6">
// 								<div class="field-group__item">
// 									<label class="field-group__label required">Гражданство</label>
// 									<select name="tourist_nationality" required data-nationality>
// 									</select>
// 								</div>
// 							</div>
// 							<div class="col-lg-3 col-md-6">
// 								<div class="field-group__item">
// 									<label class="field-group__label required">Дата рождения</label>
// 									<div class="field-group__box">
// 										<input class="field-group__input" type="text" name="tourist_birthday" required
// 										value="${data.common.tourist_birthday ? data.common.tourist_birthday : ''}">
// 									</div>
// 								</div>
// 							</div>
// 							<div class="col-lg-3 col-md-6">
// 								<div class="field-group__item">
// 									<label class="field-group__label">Фактический адрес</label>
// 									<div class="field-group__box">
// 										<input class="field-group__input" type="text" name="tourist_address"
// 										value="${data.common.tourist_address ? data.common.tourist_address : ''}">
// 									</div>
// 								</div>
// 							</div>
// 							<div class="col-lg-3 col-md-6">
// 								<div class="field-group__item">
// 									<label class="field-group__label">Телефон</label>
// 									<div class="field-group__box">
// 										<input class="field-group__input" type="tel" name="tourist_phone"
// 										value="${data.common.tourist_phone ? data.common.tourist_phone : ''}">
// 									</div>
// 								</div>
// 							</div>
// 							<div class="col-lg-3 col-md-6">
// 								<div class="field-group__item">
// 									<label class="field-group__label">Email</label>
// 									<div class="field-group__box">
// 										<input class="field-group__input" type="email" name="tourist_email"
// 										value="${data.common.tourist_email ? data.common.tourist_email : ''}">
// 									</div>
// 								</div>
// 							</div>
// 						</div>
// 						<hr>
// 							<div class="row">
// 								<div class="col-lg-4">
// 									<div class="text-label text-center mb-2">Национальный паспорт</div>
// 									<div class="row">
// 										<div class="col-sm-3">
// 											<div class="field-group__item">
// 												<label class="field-group__label">Серия</label>
// 												<div class="field-group__box">
// 													<input class="field-group__input" type="number" name="tourist_passport_series"
// 													value="${data.passport.tourist_passport_series ? data.passport.tourist_passport_series : ''}">
// 												</div>
// 											</div>
// 										</div>
// 										<div class="col-sm-3">
// 											<div class="field-group__item">
// 												<label class="field-group__label">Номер</label>
// 												<div class="field-group__box">
// 													<input class="field-group__input" type="number" name="tourist_passport_number"
// 													value="${data.passport.tourist_passport_number ? data.passport.tourist_passport_number : ''}">
// 												</div>
// 											</div>
// 										</div>
// 										<div class="col-sm-6">
// 											<div class="field-group__item">
// 												<label class="field-group__label">Дата выдачи</label>
// 												<div class="field-group__box">
// 													<input class="field-group__input" type="text" name="tourist_passport_date"
// 													value="${data.passport.tourist_passport_date ? data.passport.tourist_passport_date : ''}">
// 												</div>
// 											</div>
// 										</div>
// 										<div class="col-sm-8">
// 											<div class="field-group__item">
// 												<label class="field-group__label">Кем выдан</label>
// 												<div class="field-group__box">
// 													<input class="field-group__input" type="text" name="tourist_passport_issued"
// 													value="${data.passport.tourist_passport_issued ? data.passport.tourist_passport_issued : ''}">
// 												</div>
// 											</div>
// 										</div>
// 										<div class="col-sm-4">
// 											<div class="field-group__item">
// 												<label class="field-group__label">Код</label>
// 												<div class="field-group__box">
// 													<input class="field-group__input" type="text" name="tourist_passport_code"
// 													value="${data.passport.tourist_passport_code ? data.passport.tourist_passport_code : ''}">
// 												</div>
// 											</div>
// 										</div>
// 										<div class="col-12">
// 											<div class="field-group__item">
// 												<label class="field-group__label">Адрес регистрации</label>
// 												<div class="field-group__box">
// 													<input class="field-group__input" type="text" name="tourist_passport_address"
// 													value="${data.passport.tourist_passport_address ? data.passport.tourist_passport_address : ''}">
// 												</div>
// 											</div>
// 										</div>
// 									</div>
// 								</div>
// 								<div class="col-lg-4">
// 									<div class="text-label text-center mb-2">Свидетельство о рождении</div>
// 									<div class="row">
// 										<div class="col-sm-4">
// 											<div class="field-group__item">
// 												<label class="field-group__label">Серия</label>
// 												<div class="field-group__box">
// 													<input class="field-group__input" type="text" name="tourist_certificate_series"
// 													value="${data.certificate.tourist_certificate_series ? data.certificate.tourist_certificate_series : ''}">
// 												</div>
// 											</div>
// 										</div>
// 										<div class="col-sm-8">
// 											<div class="field-group__item">
// 												<label class="field-group__label">Номер</label>
// 												<div class="field-group__box">
// 													<input class="field-group__input" type="text" name="tourist_certificate_number"
// 													value="${data.certificate.tourist_certificate_number ? data.certificate.tourist_certificate_number : ''}">
// 												</div>
// 											</div>
// 										</div>
// 										<div class="col-12">
// 											<div class="field-group__item">
// 												<label class="field-group__label">Дата выдачи</label>
// 												<div class="field-group__box">
// 													<input class="field-group__input" type="text" data-name="date" data-format="date" name="tourist_certificate_date"
// 													value="${data.certificate.tourist_certificate_date ? data.certificate.tourist_certificate_date : ''}">
// 													<div class="field-group__trigger">
// 														<i class="fa-regular fa-calendar-days calendar-icon"></i>
// 														<input class="input-trigger" type="text" data-trigger="date">
// 													</div>
// 												</div>
// 											</div>
// 										</div>
// 										<div class="col-12">
// 											<div class="field-group__item">
// 												<label class="field-group__label">Кем выдан</label>
// 												<div class="field-group__box">
// 													<input class="field-group__input" type="text" name="tourist_certificate_issued"
// 													value="${data.certificate.tourist_certificate_issued ? data.certificate.tourist_certificate_issued : ''}">
// 												</div>
// 											</div>
// 										</div>
// 									</div>
// 								</div>
// 								<div class="col-lg-4">
// 									<div class="text-label text-center mb-2">Заграничный паспорт</div>
// 									<div class="row">
// 										<div class="col-sm-4">
// 											<div class="field-group__item">
// 												<label class="field-group__label">Серия</label>
// 												<div class="field-group__box">
// 													<input class="field-group__input" type="text" name="tourist_international_passport_series"
// 													value="${data.internationalPassport.tourist_international_passport_series ? data.internationalPassport.tourist_international_passport_series : ''}">
// 												</div>
// 											</div>
// 										</div>
// 										<div class="col-sm-8">
// 											<div class="field-group__item">
// 												<label class="field-group__label">Номер</label>
// 												<div class="field-group__box">
// 													<input class="field-group__input" type="text" name="tourist_international_passport_number"
// 													value="${data.internationalPassport.tourist_international_passport_number ? data.internationalPassport.tourist_international_passport_number : ''}">
// 												</div>
// 											</div>
// 										</div>
// 										<div class="col-sm-6">
// 											<div class="field-group__item">
// 												<label class="field-group__label">Дата выдачи</label>
// 												<div class="field-group__box">
// 													<input class="field-group__input" type="text" data-name="date" data-format="date" name="tourist_international_passport_date"
// 													value="${data.internationalPassport.tourist_international_passport_date ? data.internationalPassport.tourist_international_passport_date : ''}">
// 													<div class="field-group__trigger">
// 														<i class="fa-regular fa-calendar-days calendar-icon"></i>
// 														<input class="input-trigger" type="text" data-trigger="date">
// 													</div>
// 												</div>
// 											</div>
// 										</div>
// 										<div class="col-sm-6">
// 											<div class="field-group__item">
// 												<label class="field-group__label">Срок действия</label>
// 												<div class="field-group__box">
// 													<input class="field-group__input" type="text" data-name="date" data-format="date" name="tourist_international_passport_period"
// 													value="${data.internationalPassport.tourist_international_passport_period ? data.internationalPassport.tourist_international_passport_period : ''}">
// 													<div class="field-group__trigger">
// 														<i class="fa-regular fa-calendar-days calendar-icon"></i>
// 														<input class="input-trigger" type="text" data-trigger="date">
// 													</div>
// 												</div>
// 											</div>
// 										</div>
// 										<div class="col-sm-12">
// 											<div class="field-group__item">
// 												<label class="field-group__label">Кем выдан</label>
// 												<div class="field-group__box">
// 													<input class="field-group__input" type="text" name="tourist_international_passport_issued"
// 													value="${data.internationalPassport.tourist_international_passport_issued ? data.internationalPassport.tourist_international_passport_issued : ''}">
// 												</div>
// 											</div>
// 											<div class="text-label mt-2">Пример: UFMS-12</div>
// 										</div>
// 									</div>
// 								</div>
// 							</div>
// 							<div class="row">
// 								<div class="col-lg-4">
// 									<div class="text-label mb-2">Информация и визе</div>
// 									<div class="select-items">
// 										<div class="field-group__item">
// 											<label class="field-group__label required">Необходимость визы</label>
// 											<select name="visa_info" id="visaInfo" required data-visas>
// 												<option value=""></option>
// 											</select>
// 										</div>
// 										<div class="field-group__item">
// 											<label class="field-group__label">Город подачи визы</label>
// 											<select name="visa_city" data-cities ${data.common.visa_info === "not" ? " disabled" : ""}>
// 												<option value=""></option>
// 											</select>
// 										</div>
// 									</div>
// 								</div>
// 							</div>
// 						</div>
// 					</div>
// 				`
// 				modalBody.innerHTML = formBody;
// 				formUpdate('#formTouristUpdate');
// 			});
// 	})
// 	modalUpdateTourist.addEventListener('hidden.bs.modal', (event) => {
// 		const thisModal = event.target;
// 		const form = thisModal.querySelector('form');
// 		const modalBody = form.querySelector('.modal__body');
// 		setTimeout(() => {
// 			modalBody.innerHTML = '';
// 		}, 200)
// 	});
// }