// import { rates } from "./../api/api.js";
// Функция для получения селекторов и вызова функции с калькуляцией
function getValute(selectId, inputName) {
	const select = document.getElementById(`${selectId}`)
	const input = document.querySelector(`[data-name=${inputName}]`)
	input.addEventListener('change', () => {
		convertValue(select, input);
	});
	select.addEventListener('change', () => {
		convertValue(select, input);
	});
}
// Функция для калькуляции стоимости с текущим курсом
function convertValue(select, input) {
	if (input.value == "" || select.value == "") {
		return;
	}
	if (select.value != "RUB" && input.value != "") {
		input.value = (parseFloat(input.value) / rates[select.value].Value).toFixed(2);
		// input.value = Math.ceil((parseFloat(input.value) / rates[select.value].Value) * 100) / 100;
	}
}
// getValute("exposeCurrency", "expose_payment_sum");
// getValute("tourPackageCurrency", "parameters_course_tourist");

// Функция для скрытия | показа поля с курсом в зависимости от выбранного значения в селекте
export function hiddenField() {
	let forms = document.querySelectorAll('form');
	[...forms].forEach((form) => {
		if (form) {
			const selectTourPackageCurrency = form.querySelector('[data-id="tourPackageCurrency"]');
			if (selectTourPackageCurrency) {
				const inputCourseTourist = form.querySelector('[data-name="parameters_course_tourist"]')
				const parentField = inputCourseTourist.closest('.field-group__item');
				// parentField.setAttribute('hidden', true);
				selectTourPackageCurrency.addEventListener('change', (event) => {
					let self = event.target;
					const parametersPrices = document.querySelectorAll('.parameters-price');
					[...parametersPrices].forEach((parametr) => {
						const label = parametr.querySelector('.field-group__label')
						label.innerHTML = self.value;
					})
					if (self.value == "RUB" || self.value == "") {
						parentField.setAttribute('hidden', true);
						inputCourseTourist.value = "";
					} else {
						parentField.removeAttribute('hidden');
					}
				})
			}
		}
	})
}
hiddenField();