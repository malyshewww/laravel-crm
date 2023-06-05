import { getTranslitValues } from "./translit.js";
import { initChoices, choiceConfig } from "./choices.js";
import { initDatePicker } from "./calendar.js";
import { hiddenField } from "./currency.js";
import { numberFormatted } from "./number-format.js";
import { changeCustomer } from "./tabs.js";
import * as Loader from "./loader.js";
function formHandler(formId) {
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
						window.location.reload();
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
// Создание заявки
formHandler('formCreateClaim');
// Создание/редактировани комментария
formHandler('formComment');
// ДЕТАЛИ ТУРА
formHandler('formFlights');
formHandler('formInsurance');
formHandler('formTransfer');
formHandler('formVisa');
formHandler('formHabitation');
formHandler('formFuelSurchange');
formHandler('formExcursion');
formHandler('formOtherService');
// ДОБАВИТЬ ФАЙЛЫ
formHandler('formFile');
// Добавить счеёт на оплату
formHandler('formPaymentInvoice');

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
			const dataTitle = thisButton.dataset.title;
			const modalBody = thisModal.querySelector('.modal__body');
			const modalTitle = thisModal.querySelector('.modal__title');
			const form = thisModal.querySelector('form');
			const inputClaimId = form.claim_id;
			const inputTouristId = form.tourist_id;
			const inputRecordId = form.record_id;
			const token = form._token;
			form.setAttribute('action', dataUrl);
			inputClaimId ? inputClaimId.value = dataClaimId : null;
			inputTouristId ? inputTouristId.value = dataId : null;
			inputRecordId ? inputRecordId.value = dataId : null;
			Loader.displayLoading();
			fetch(`${dataPath}`, {
				headers: {
					"X-CSRF-Token": token
				},
				method: 'GET',
			})
				.then(response => response.status == 200 ? response.text() : console.log('status error'))
				.then((text) => {
					dataTitle ? modalTitle.textContent = dataTitle : null;
					modalBody.innerHTML = text;
					formHandler(formId);
					getTranslitValues();
					hiddenField();
					numberFormatted();
					changeCustomer();
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
				.finally(() => Loader.hideLoading())
		})
		modal.addEventListener('hidden.bs.modal', (event) => {
			const thisModal = event.target;
			const form = thisModal.querySelector('form');
			const modalBody = form.querySelector('.modal__body');
			const modalTitle = thisModal.querySelector('.modal__title');
			modalBody.innerHTML = '';
			modalTitle.textContent = '';
		});
	}
}
// ИНФОРМАЦИЯ О ТУРПАКЕТЕ
modalUpdate('tourpackageModal', 'formTourpackage');
// ИНФОРМАЦИЯ О ТУРОПЕРАТОРЕ
modalUpdate('touroperatorModal', 'formTouroperator');
// ДАННЫЕ ДОГОВОРА И БРОНИРОВАНИЯ
modalUpdate('contractModal', 'formContract');
// Заказчик
modalUpdate('addCustomer', 'formCustomer');
// Туристы
modalUpdate('updateTourist', 'formTouristUpdate');
// Детали тура
modalUpdate('serviceUpdateModal', 'formServiceUpdate');
// Финансы
modalUpdate('prepaymentParameters', 'formPrepayment');
modalUpdate('parametersPayment', 'formPayment');
modalUpdate('updatePaymentInvoice', 'formPaymentInvoiceUpdate');

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