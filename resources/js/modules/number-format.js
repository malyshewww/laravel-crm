
export function numberFormatted() {
	const inputNumbers = document.querySelectorAll('[data-number]');
	[...inputNumbers].forEach((input) => {
		input.addEventListener('keypress', (event) => {
			check(event, input.value);
		})
		input.addEventListener('change', validateQtyWithDot);
		input.addEventListener('input', validateQtyWithDot);
		input.addEventListener('blur', (event) => {
			input.value = parseInt((input.value * 100)) / 100;
			if (isNaN(input.value)) {
				input.value = input.value.replace(/[^0-9\.]/g, '');
			}
			// input.value = input.value.replace(/[^0-9.\d ]/g, "");
		})
	})
	const inputsTel = document.querySelectorAll('input[type="tel"]');
	[...inputsTel].forEach((tel) => {
		tel.addEventListener('keypress', (event) => {
			let target = event.target;
			decimalNumber(event, target);
			validateQty(event);
		})
		tel.addEventListener('change', validateQty)
		tel.addEventListener('input', validateQty)
	});
}

// Ввод только цифр и точки
function check(event, value) {
	if ((event.charCode >= 48 && event.charCode <= 57) || event.charCode == 46 || event.charCode == 0) {
		if (value.indexOf('.') > -1) {
			if (event.charCode == 46)
				event.preventDefault();
		}
	} else {
		event.preventDefault();
	}
};
// Ввод только цифр и плюса
function decimalNumber(event, target) {
	if ((event.charCode >= 48 && event.charCode <= 57) || event.charCode == 43 || event.charCode == 0) {
		if (target.value.indexOf('+') > -1) {
			if (event.charCode == 43)
				event.preventDefault();
		}
	} else {
		event.preventDefault();
	}
}
function validateQty(event) {
	if (isNaN(event.target.value)) {
		event.target.value = event.target.value.replace(/[^0-9+]/g, '');
	}
}
function validateQtyWithDot(event) {
	if (isNaN(event.target.value)) {
		event.target.value = event.target.value.replace(/[^0-9\.]/g, '');
	}
}