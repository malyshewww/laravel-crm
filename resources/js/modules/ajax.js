import { getTranslitValues } from "./translit.js";
import { initChoices, choiceConfig } from "./choices.js";
import { initDatePicker } from "./calendar.js";
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

function formUpdate(formId) {
	const form = document.getElementById(formId);
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
			const inputSurname = thisForm.tourist_surname;
			const inputName = thisForm.tourist_name;
			const selectGender = thisForm.tourist_gender;
			const selectNationality = thisForm.tourist_nationality;
			const inputBirthday = thisForm.tourist_birthday;
			const selectVisa = thisForm.visa_info;
			const token = thisForm._token;
			const inputId = thisForm.id?.value;
			const formInputs = formGroup?.querySelectorAll('input');
			const formSelects = formGroup?.querySelectorAll('select');
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
					} else {
						if (result.date_start) {
							inputDateStart.classList.add('error');
						}
						if (result.date_end) {
							inputDateEnd.classList.add('error');
						}
						if (result.tourist_surname) {
							inputSurname.classList.add('error');
						}
						if (result.tourist_name) {
							inputName.classList.add('error');
						}
						if (result.tourist_gender) {
							selectGender.parentNode.classList.add('error');
						}
						if (result.tourist_nationality) {
							selectNationality.parentNode.classList.add('error');
						}
						if (result.tourist_birthday) {
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

function modalUpdate(modalUpdateId, formId) {
	const modal = document.getElementById(modalUpdateId);
	if (modal) {
		modal.addEventListener('shown.bs.modal', (event) => {
			const thisModal = event.target;
			const thisButton = event.relatedTarget;
			const dataId = thisButton.dataset.id;
			const dataClaimId = thisButton.dataset.claimId;
			const dataUrl = thisButton.dataset.url;
			const dataPath = thisButton.dataset.path;
			const modalBody = thisModal.querySelector('.modal__body');
			const form = thisModal.querySelector('form');
			const inputClaimId = form.claim_id;
			const inputTouristId = form.tourist_id;
			const inputRecordId = form.record_id;
			const token = form._token;
			form.setAttribute('action', dataUrl);
			inputClaimId.value = dataClaimId;
			inputTouristId ? inputTouristId.value = dataId : null;
			inputRecordId ? inputRecordId.value = dataId : null;
			fetch(`${dataPath}`, {
				headers: {
					"X-CSRF-Token": token
				},
				method: 'GET',
			})
				.then(response => response.status == 200 ? response.text() : console.log('status error'))
				.then((text) => {
					modalBody.innerHTML = text;
					formUpdate(formId);
					getTranslitValues();
					let selects = document.querySelectorAll('[data-select]');
					[...selects].forEach((select) => {
						if (select) {
							let choices = new Choices(select, choiceConfig);
						}
					})
					initDatePicker();
				})
				.catch((error) => {
					console.log(error);;
				})
		})
		modal.addEventListener('hidden.bs.modal', (event) => {
			const thisModal = event.target;
			const form = thisModal.querySelector('form');
			const modalBody = form.querySelector('.modal__body');
			modalBody.innerHTML = '';
		});
	}
}
modalUpdate('updateTourist', 'formTouristUpdate');
modalUpdate('updateTransfer', 'formTransferUpdate');
modalUpdate('updateInsurance', 'formInsuranceUpdate');
modalUpdate('updateFlight', 'formFlightUpdate');
modalUpdate('updateVisa', 'formVisaUpdate');
modalUpdate('updateHabitation', 'formHabitationUpdate');
modalUpdate('updateFuelSurchange', 'formFuelSurchangeUpdate');
modalUpdate('updateExcursionProgramm', 'formExcursionUpdate');
modalUpdate('updateOtherService', 'formOtherServiceUpdate');
modalUpdate('updatePaymentInvoice', 'formPaymentInvoiceUpdate');
modalUpdate('contractModal', 'formContract');
modalUpdate('touroperatorModal', 'formTouroperator');
modalUpdate('tourpackageModal', 'formTourpackage');

const modalDelete = document.getElementById('deleteRecord');
if (modalDelete) {
	modalDelete.addEventListener('show.bs.modal', (event) => {
		const thisModal = event.target;
		const modalTitle = thisModal.querySelector('.modal__title');
		const form = thisModal.querySelector('form');
		const btn = event.relatedTarget;
		const dataUrl = btn.dataset.url;
		const dataTitle = btn.dataset.title;
		form.setAttribute('action', dataUrl);
		modalTitle.textContent = dataTitle !== "" ? dataTitle : "Вы действительно хотите удалить запись?";
	})
}
function deleteRecord() {
	if (modalDelete) {
		const form = modalDelete.querySelector('form');
		form.addEventListener('submit', (event) => {
			event.preventDefault();
			const thisForm = event.target;
			const formData = new FormData(thisForm);
			const currentModal = thisForm.closest('.modal');
			const buttonSubmit = thisForm.querySelector('button[type="submit"]');
			buttonSubmit.setAttribute('disabled', 'true');
			const route = thisForm.getAttribute('action');
			const token = thisForm._token;
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