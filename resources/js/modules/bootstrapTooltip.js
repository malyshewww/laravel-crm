// import bootstrap, { Tooltip, Dropdown } from "bootstrap";
// Всплывающие подсказки от bootstrap при наведении на элементы
const bootstrapTooltip = () => {
	let tooltipTriggerList = [].slice.call(
		document.querySelectorAll('[data-bs-toggle="tooltip"]')
	);
	let tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
		return new bootstrap.Tooltip(tooltipTriggerEl);
	});
}
bootstrapTooltip();
export default bootstrapTooltip;