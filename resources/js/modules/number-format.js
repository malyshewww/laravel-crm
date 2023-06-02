
export function numberFormatted() {
	const inputNumbers = document.querySelectorAll('[data-number]');
	[...inputNumbers].forEach((input) => {
		input.addEventListener('keypress', (event) => {
			check(event, input.value);
		})
		input.addEventListener('blur', (event) => {
			input.value = parseInt((input.value * 100)) / 100;
			console.log(input.value);
			// input.value = input.value.replace(/[^0-9.\d ]/g, "");
		})
	})
}
function check(event, value) {
	if ((event.charCode >= 48 && event.charCode <= 57) || event.charCode == 46 || event.charCode == 0) {
		if (value.indexOf('.') > -1) {
			if (event.charCode == 46)
				event.preventDefault();
		}
	} else
		event.preventDefault();
};