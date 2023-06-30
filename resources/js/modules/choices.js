// Плагин для создания селектов
import Choices from "choices.js";
import { file } from "jszip";

// Общая конфигурация для всех селектов
export const choiceConfig = {
	noResultsText: "Ничего не найдено",
	itemSelectText: "",
	placeholder: true,
	searchPlaceholderValue: "Поиск",
	allowHTML: true,
	removeItemButton: true,
	searchResultLimit: 8,
	shouldSort: false,
	maxItemCount: 1,
	searchFloor: 2,
	noChoicesText: 'Варианты для выбора отсутствуют',
	maxItemText: (maxItemCount) => {
		return `Может быть выбрано только ${maxItemCount} значение`;
	},
};

export const initChoices = () => {
	const selectChoices = document.querySelectorAll('.choices');
	[...selectChoices].forEach((select) => {
		if (select) {
			let choices = new Choices(select, choiceConfig)
		}
	})
};
initChoices()
export const getSelectData = async () => {
	const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
	try {
		const response = await fetch('/selectData', {
			headers: {
				"X-CSRF-Token": token
			},
			method: 'POST'
		})
		const json = await response.json();
		const data = await json;
		const { genders, nationalities, cities, visaOptions,
			flightClasses, insuranceTypes, transferTypes, habitationFoodTypes,
			fileTypes, calculations, currencies } = data;
		const selectTouristGender = document.getElementById('selectTouristGender');
		const selectTouristNationality = document.getElementById('selectTouristNationality');
		const selectVisaCity = document.getElementById('selectVisaCity');
		const selectVisaInfo = document.getElementById('visaInfo');
		const selectFlightClass = document.getElementById('selectFlightClass');
		const selectInsuranceType = document.getElementById('insuranceType');
		const selectTransferType = document.getElementById('selectTransferType');
		const selectHabitationFoodType = document.getElementById('selectHabitationFoodType');
		const selectFileType = document.getElementById('fileType');
		const selectExposeCalculate = document.getElementById('exposeCalculate');
		const selectExposeCurrency = document.getElementById('exposeCurrency');
		if (selectTouristGender) {
			const dataSelectTouristGender = genders.map((item, index) => {
				return {
					label: item.title,
					value: item.value,
					id: index + 1,
					selected: false,
				}
			})
			setSelectOptions(selectTouristGender, dataSelectTouristGender, 'addTourist')
		}
		if (selectTouristNationality) {
			const dataSelectTouristNationality = nationalities.map((item, index) => {
				return {
					label: item.title,
					value: item.value,
					id: index + 1,
					selected: false,
				}
			})
			setSelectOptions(selectTouristNationality, dataSelectTouristNationality, 'addTourist')
		}
		if (selectVisaInfo) {
			const dataSelectVisaInfo = visaOptions.map((item, index) => {
				return {
					label: item.title,
					value: item.value,
					id: index + 1,
					selected: false,
				}
			})
			setSelectOptions(selectVisaInfo, dataSelectVisaInfo, 'addTourist')
		}
		if (selectVisaCity) {
			const dataSelectVisaCity = cities.map((item, index) => {
				return {
					label: item.name,
					value: index,
					id: index,
					selected: false,
				}
			})
			setSelectOptions(selectVisaCity, dataSelectVisaCity, 'addTourist')
		}
		if (selectFlightClass) {
			const dataSelectFlightClass = flightClasses.map((item, index) => {
				return {
					label: item.title,
					value: item.value,
					id: index + 1,
					selected: false,
				}
			})
			setSelectOptions(selectFlightClass, dataSelectFlightClass, 'addFlight')
		}
		if (selectInsuranceType) {
			const dataSelectInsuranceType = insuranceTypes.map((item, index) => {
				return {
					label: item.title,
					value: item.value,
					id: index + 1,
					selected: false,
				}
			})
			setSelectOptions(selectInsuranceType, dataSelectInsuranceType, 'addInsurance')
		}
		if (selectTransferType) {
			const dataSelectTransferType = transferTypes.map((item, index) => {
				return {
					label: item.title,
					value: item.value,
					id: index + 1,
					selected: false,
				}
			})
			setSelectOptions(selectTransferType, dataSelectTransferType, 'addTransfer')
		}
		if (selectHabitationFoodType) {
			const dataSelectHabitationFoodType = habitationFoodTypes.map((item, index) => {
				return {
					label: item.title,
					value: item.value,
					id: index + 1,
					selected: false,
				}
			})
			setSelectOptions(selectHabitationFoodType, dataSelectHabitationFoodType, 'addHabitation')
		}
		if (selectFileType) {
			const dataSelectFileType = fileTypes.map((item, index) => {
				return {
					label: item.title,
					value: item.value,
					id: index + 1,
					selected: item.value === 'doc_tourist' ? true : false,
				}
			})
			setSelectOptions(selectFileType, dataSelectFileType, 'addFile')
		}
		if (selectExposeCalculate) {
			const dataSelectExposeCalculate = calculations.map((item, index) => {
				return {
					label: item.title,
					value: item.value,
					id: index + 1,
					selected: false,
				}
			})
			setSelectOptions(selectExposeCalculate, dataSelectExposeCalculate, 'paymentInvoice')
		}
		if (selectExposeCurrency) {
			const dataSelectExposeCurrency = currencies.map((item, index) => {
				return {
					label: item.title,
					value: item.value,
					id: index + 1,
					selected: item.value === 'RUB' ? true : false,
				}
			})
			setSelectOptions(selectExposeCurrency, dataSelectExposeCurrency, 'paymentInvoice')
		}
	} catch (error) {
		console.log('Произошла ошибка при получении данных');
	}
}
function setSelectOptions(select, selectData, modalId) {
	const modal = document.getElementById(modalId);
	if (select) {
		let choice = new Choices(select, choiceConfig)
		modal.addEventListener('shown.bs.modal', (event) => {
			choice.setChoices(selectData, 'value', 'label');
		})
		modal.addEventListener('hidden.bs.modal', (event) => {
			choice.clearChoices();
		})
	}
}
getSelectData();

let forms = document.querySelectorAll('form');
[...forms].forEach((form) => {
	const selectVisaCity = form.querySelector('[data-name="visaCity"]');
	const selectVisaInfo = form.querySelector('[data-name="visaInfo"]');
	if (selectVisaCity && selectVisaInfo) {
		const parentCity = selectVisaCity.closest('.field-group__item');
		parentCity.style.display = "none";
		selectVisaInfo.addEventListener('change', (event) => {
			showFieldSelect(event, parentCity);
		});
	}
	const selectInsuranceType = form.querySelector('[data-name="insuranceType"]');
	const inputInsuranceTypeOther = form.querySelector('[data-name="insurance_type_other"]');
	if (selectInsuranceType && inputInsuranceTypeOther) {
		let inputInsuranceTypeOtherParent = inputInsuranceTypeOther.closest(".field-group__item");
		// inputInsuranceTypeOtherParent.setAttribute('hidden', true);
		selectInsuranceType.addEventListener('change', (event) => {
			let target = event.target;
			const currentSelectValue = target.value;
			if (currentSelectValue == "other") {
				inputInsuranceTypeOtherParent.removeAttribute('hidden');
				setTimeout(() => {
					inputInsuranceTypeOther.focus();
				}, 100)
			} else {
				inputInsuranceTypeOtherParent.setAttribute('hidden', true);
			}
		})
	}
})
function showFieldSelect(event, selector) {
	let target = event.target
	const currentSelectValue = target.value;
	currentSelectValue == "yes" ? selector.style.display = "block" : selector.style.display = "none";
}


