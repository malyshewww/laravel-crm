// Плагин для создания селектов
import Choices from "choices.js";

// Общая конфигурация для всех селектов
export const choiceConfig = {
	noResultsText: "Ничего не найдено",
	itemSelectText: "",
	searchPlaceholderValue: "Поиск",
	placeholder: false,
	allowHTML: true,
	removeItemButton: true,
	searchResultLimit: 8,
	shouldSort: false,
};
export function initChoices() {
	const selectChoices = document.querySelectorAll('.select-choices');
	[...selectChoices].forEach((select) => {
		if (select) {
			let choices = new Choices(select, choiceConfig)
		}
	})
}
initChoices();

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


