// import { Tooltip as BsTooltip } from "bootstrap";
// Всплывающие подсказки от bootstrap при наведении на элементы
let tooltipTriggerList = [].slice.call(
	document.querySelectorAll('[data-bs-toggle="tooltip"]')
);
let tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
	return new bootstrap.Tooltip(tooltipTriggerEl);
});