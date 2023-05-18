function formData() {
	const url = BASE_URL;
	let forms = document.querySelectorAll('.form');
	[...forms].forEach((form) => {
		if (form) {
			const formId = form.getAttribute('id');
			const route = form.getAttribute('action');
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
							// elementUpdate('#groupDataCustomer')
						} else {
							if (result.date_start) {
								inputDateStart.classList.add('error')
							}
							if (result.date_end) {
								inputDateEnd.classList.add('error')
							}
							if (result.person_surname || result.tourist_surname) {
								inputSurname.classList.add('error')
							}
							if (result.person_name || result.tourist_name) {
								inputName.classList.add('error')
							}
							if (result.person_gender || result.tourist_gender) {
								selectGender.parentNode.classList.add('error')
							}
							if (result.person_nationality || result.tourist_nationality) {
								selectNationality.parentNode.classList.add('error')
							}
							if (result.person_birthday || result.tourist_birthday) {
								inputBirthday.classList.add('error')
							}
						}
						buttonSubmit.removeAttribute('disabled');
					})
					.catch((error) => {
						buttonSubmit.removeAttribute('disabled');
					})
			})
		}
	})
}
function getRoute(formId, obj) {
	for (const [key, value] of Object.entries(obj)) {
		if (key == formId) return value;
	}
}
function getTouristData(currentForm) {
	const touristData = {
		surname: currentForm.tourist_surname,
		name: currentForm.tourist_name,
		patronymic: currentForm.tourist_patronymic,
		gender: currentForm.tourist_gender,
		surname_lat: currentForm.tourist_surname_lat,
		name_lat: currentForm.tourist_name_lat,
		nationality: currentForm.tourist_nationality,
		birthday: currentForm.tourist_birthday,
		address: currentForm.tourist_address,
		phone: currentForm.tourist_phone,
		email: currentForm.tourist_email,
		visa_info: currentForm.visa_info,
		visa_city: currentForm.visa_city,
		passport: {
			series: currentForm.tourist_passport_series,
			number: currentForm.tourist_passport_number,
			date: currentForm.tourist_passport_date,
			issued: currentForm.tourist_passport_issued,
			code: currentForm.tourist_passport_code,
			address: currentForm.tourist_passport_address,
		},
		certificate: {
			series: currentForm.tourist_certificate_series,
			number: currentForm.tourist_certificate_number,
			date: currentForm.tourist_certificate_date,
			issued: currentForm.tourist_certificate_issued,
		},
		internationalPassport: {
			series: currentForm.tourist_international_passport_series,
			number: currentForm.tourist_international_passport_number,
			date: currentForm.tourist_international_passport_date,
			period: currentForm.tourist_international_passport_period,
			issued: currentForm.tourist_international_passport_issued,
		}
	}
	return touristData;
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




const obj = {};
function updateModalFields(modalId) {
	const modalElement = document.getElementById(modalId)
	if (modalElement) {
		modalElement.addEventListener('shown.bs.modal', (event) => {
			let loader = `<div class="loader"><div class="loader__icon"></div></div>`;
			const form = modalElement.querySelector('#formCustomer');
			const url = form.dataset.url;
			fetch(`${url}`)
				.then(response => response.status === 200 ? response.json() : console.log('Подключения к сети нет '))
				.then((result) => {
					console.log(result);
					// var doc = parser.parseFromString(result, "text/html");
					// console.log(doc.querySelector('h1').innerHTML);
				});
			// async function data() {
			// 	const response = await fetch(`/comment`);
			// 	const data = await response.json();
			// 	const result = await data;
			// 	console.log(result);
			// }
			// data();
		})
	}
}
updateModalFields('addCustomer');

async function elementUpdate(selector) {
	try {
		var html = await (await fetch(location.href)).text();
		var newdoc = new DOMParser().parseFromString(html, 'text/html');
		document.querySelector(selector).outerHTML = newdoc.querySelector(selector).outerHTML;
		console.log('Элемент ' + selector + ' был успешно обновлен');
		return true;
	} catch (err) {
		console.log('При обновлении элемента ' + selector + ' произошла ошибка:');
		console.dir(err);
		return false;
	}
}

const modalDelete = document.getElementById('deleteRecord');
if (modalDelete) {
	modalDelete.addEventListener('show.bs.modal', (event) => {
		const thisModal = event.target;
		const modalTitle = thisModal.querySelector('.modal__title');
		const form = thisModal.querySelector('form');
		const btn = event.relatedTarget;
		const currentTable = btn.closest('table');
		const tableId = currentTable.getAttribute('id');
		const dataUrl = btn.dataset.url;
		const dataId = btn.dataset.id;
		const dataNumber = btn.dataset.number;
		form.setAttribute('action', dataUrl);
		const titles = {
			'table-id': `Вы действительно хотите удалить заявку № ${dataId}?`,
			'table-detailtour': 'Вы действительно хотите удалить услугу?',
			'table-file': 'Вы действительно хотите удалить файл?',
			'table-finance': `Вы действительно хотите удалить счёт № ${dataNumber}`,
		};
		modalTitle.textContent = getModalTitle(tableId, titles);
	})
}
function getModalTitle(tableId, obj) {
	for (const [key, value] of Object.entries(obj)) {
		if (key == tableId) return value;
	}
}
function deleteRecord() {
	if (modalDelete) {
		const form = modalDelete.querySelector('form');
		form.addEventListener('submit', (event) => {
			event.preventDefault();
			const thisForm = event.target;
			const currentModal = thisForm.closest('.modal');
			const formData = new FormData(thisForm);
			const buttonSubmit = thisForm.querySelector('button[type="submit"]');
			buttonSubmit.setAttribute('disabled', 'true');
			const route = thisForm.getAttribute('action');
			const token = form._token;
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
						$(currentModal).modal('hide');
					}
					buttonSubmit.removeAttribute('disabled');
				})
				.catch((error) => {
					console.log(error);
					buttonSubmit.removeAttribute('disabled');
				})
		})
	}
}
deleteRecord();