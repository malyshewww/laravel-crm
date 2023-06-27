import bootstrap, { Tooltip, Dropdown } from "bootstrap";
// Всплывающие подсказки от bootstrap при наведении на элементы
export function bootstrapTooltip() {
	let tooltipTriggerList = [].slice.call(
		document.querySelectorAll('[data-bs-toggle="tooltip"]')
	);
	let tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
		return new Tooltip(tooltipTriggerEl);
	});
}
bootstrapTooltip();