import Choices from "choices.js";
import { getTranslitValues } from "./translit.js";
import { initChoices, choiceConfig, getSelectData, changeVisaOptions } from "./select-choices.js";
import { initDatePicker } from "./calendar.js";
import { hiddenField } from "./currency.js";
import { numberFormatted } from "./number-format.js";
import { changeCustomer } from "./tabs.js";
import * as Loader from "./loader.js";
import { bootstrapTooltip } from "./bootstrap/bootstrapTooltip.js";
import { getCustomerDataList, getPersonItems } from "./customers.js";
import { removeAttributeDisabled, setAttributeDisabled } from "./common.js";
import { debounced } from "./search/debounce";
import { renderModifiedData } from "./search/render";

renderModifiedData();

function checkFormFields() {
	const formAllInputs = document.querySelectorAll('.field-group__input');
	const formAllSelects = document.querySelectorAll('select');
	const inputsFile = document.querySelectorAll('.upload-file__input');
	function removeErrorClass(event) {
		if (!event.target.classList.contains('error')) {
			return false;
		}
		event.target.classList.remove('error');
	};
	function removeErrorClassSelect(event) {
		const parent = event.target.parentNode;
		if (!parent.classList.contains('error')) {
			return false;
		}
		parent.classList.remove('error');
	};
	[...formAllInputs].forEach((item) => {
		item.addEventListener('input', removeErrorClass);
		item.addEventListener('change', removeErrorClass);
	});
	[...formAllSelects].forEach((select) => {
		select.addEventListener('change', removeErrorClassSelect);
	});
	[...inputsFile].forEach((input) => {
		input.addEventListener('change', (event) => {
			const parent = event.target.closest('.upload-file');
			if (!parent.classList.contains('error')) {
				return false;
			};
			parent.classList.remove('error');
		});
	})
}
const reloadPage = () => {
	return window.location.reload();
}
checkFormFields();
numberFormatted();
function formHandler(formId) {
	const form = document.getElementById(formId);
	if (form) {
		const formId = form.getAttribute('id');
		let route = form.getAttribute('action');
		form.addEventListener('submit', (event) => {
			event.preventDefault();
			const thisForm = event.target;
			const currentModal = thisForm.closest('.modal');
			const formData = new FormData(thisForm);
			const buttonSubmit = thisForm.querySelector('button[type="submit"]');
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
			const inputFileName = thisForm.file_name;
			const selectDocType = thisForm.doc_type;
			fetch(route, {
				headers: {
					// 'Accept': 'application/json',
					"X-CSRF-Token": token,
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
						reloadPage();
						// updateHtmlData(formId);
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
						if (result.doc_type) {
							selectDocType.parentNode.classList.add('error');
						}
						if (result.file_name) {
							inputFileName.closest('.upload-file').classList.add('error');
						}
					}
					buttonSubmit.removeAttribute('disabled');
				})
				.catch((error) => {
					buttonSubmit.removeAttribute('disabled');
				})
				.finally(() => {
					buttonSubmit.removeAttribute('disabled');
				})
		})
	}
}
function updateHtmlData(formId) {
	switch (formId) {
		case 'formComment':
			elementUpdate('.comment-claim__box')
			break;
		case 'formStatusDoc':
			elementUpdate('#groupDataStatusDocs')
			break;
		case 'formTourpackage':
			elementUpdate('#groupDataTourpackage')
			break;
		case 'formTouroperator':
			elementUpdate('#groupDataTouroperator')
			break;
		case 'formContract':
			elementUpdate('#groupDataContract')
			break;
		case 'formCustomer':
			elementUpdate('#groupDataCustomer')
			break;
		case 'formTouristUpdate':
			elementUpdate('#groupDataTourist')
			break;
		case 'formTourist':
			elementUpdate('#groupDataTourist');
			elementUpdate('#formTourist input[name="tourist_id"]')
			const form = document.getElementById('formTourist');
			form.reset();
			break;
		case 'formFile':
			elementUpdate('#groupDataFile')
			break;
		case 'formPaymentInvoice':
			elementUpdate('#groupDataCalculation')
			break;
		case 'formPaymentInvoiceUpdate':
			elementUpdate('#groupDataCalculation')
			break;
		case 'formPayment':
			elementUpdate('#groupDataCost')
			elementUpdate('#groupDataCalculation')
			break;
		case 'formFlights':
		case 'formInsurance':
		case 'formTransfer':
		case 'formVisa':
		case 'formHabitation':
		case 'formFuelSurchange':
		case 'formExcursion':
		case 'formOtherService':
		case 'formServiceUpdate':
			elementUpdate('#groupDataServices');
			break;
		default:
			reloadPage();
			break;
	}
}
// Создание заявки
formHandler('formCreateClaim');
// Создание/редактировани комментария
formHandler('formComment');
// Добавить туриста
formHandler('formTourist');
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
			const modalContent = thisModal.querySelector('.modal-content');
			const modalButtons = thisModal.querySelectorAll('.modal__buttons button')
			const form = thisModal.querySelector('form');
			const inputClaimId = form.claim_id;
			const inputTouristId = form.tourist_id;
			const inputRecordId = form.record_id;
			const token = form._token;
			form.setAttribute('action', `${dataUrl}`);
			inputClaimId ? inputClaimId.value = dataClaimId : null;
			inputTouristId ? inputTouristId.value = dataId : null;
			inputRecordId ? inputRecordId.value = dataId : null;
			Loader.loader.setAttribute('class', 'loader');
			modalContent.appendChild(Loader.loader);
			setAttributeDisabled(modalButtons);
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
					debounced();
					getCustomerDataList('personItems', 'persons');
					getCustomerDataList('companyItems', 'companies');
					formHandler(formId);
					getTranslitValues();
					hiddenField();
					numberFormatted();
					changeCustomer();
					checkFormFields();
					let selects = document.querySelectorAll('[data-select]');
					[...selects].forEach((select) => {
						if (select) {
							let choices = new Choices(select, choiceConfig);
						}
					})
					initDatePicker();
					removeAttributeDisabled(modalButtons)
					renderModifiedData();
					changeVisaOptions();
				})
				.catch((error) => {
					console.log(error);
					removeAttributeDisabled(modalButtons)
					Loader.hideLoading()
					Loader.loader.remove();
				})
				.finally(() => {
					removeAttributeDisabled(modalButtons)
					Loader.hideLoading()
					Loader.loader.remove();
				})
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
// КОММЕНТАРИЙ
modalUpdate('commentModal', 'formComment');
// ДОКУМЕНТЫ ТУРИСТУ
modalUpdate('docModal', 'formStatusDoc');
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

const modalAction = document.getElementById('modalAction');
if (modalAction) {
	modalAction.addEventListener('show.bs.modal', (event) => {
		const thisModal = event.target;
		const modalTitle = thisModal.querySelector('.modal__title');
		const form = thisModal.querySelector('form');
		const btn = event.relatedTarget;
		const dataUrl = btn.dataset.url;
		const dataTitle = btn.dataset.title;
		const dataId = btn.dataset.id;
		const dataMethod = btn.dataset.method
		form.setAttribute('action', dataUrl);
		const inputClaimId = form.claim_id;
		const inputMethod = form._method;
		inputClaimId ? inputClaimId.value = dataId : null;
		inputMethod ? inputMethod.value = dataMethod : null;
		modalTitle.textContent = dataTitle !== "" ? dataTitle : "Вы действительно хотите удалить запись?";
	})
}
function formButtonActionHandler() {
	if (modalAction) {
		const form = modalAction.querySelector('form');
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
						reloadPage();
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
formButtonActionHandler();

async function elementUpdate(selector) {
	try {
		let html = await (await fetch(location.href)).text();
		let newdoc = new DOMParser().parseFromString(html, 'text/html');
		document.querySelector(selector).outerHTML = newdoc.querySelector(selector).outerHTML;
		console.log('Элемент ' + selector + ' был успешно обновлен');
		bootstrapTooltip();
		return true;
	} catch (err) {
		console.log('При обновлении элемента ' + selector + ' произошла ошибка:');
		console.dir(err);
		return false;
	}
}
