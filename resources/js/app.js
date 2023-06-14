// require('./bootstrap');
console.log('app.js');

import './modules/bootstrapTooltip.js';

import './modules/tabs.js';
import './modules/calendar.js';
import './modules/currency.js';
import './modules/choices.js';
import './modules/uploadFiles.js';
import './modules/number-format.js';
// import './modules/mask-phone.js';

// import './modules/tables.js';

import './modules/ajax.js';

document.addEventListener('click', documentActions);

function documentActions(event) {
	const target = event.target;
	if (target.closest('#passport-data')) {
		showHide("#passport-data", ".customer-passport");
	}
	if (target.closest('#tourist-price')) {
		showHide("#tourist-price", ".tourist-price-content");
	}
	if (target.closest('#finance-price')) {
		showHide("#finance-price", ".finance-price-content");
	}
	if (target.closest('#history-price')) {
		showHide("#history-price", ".finance-table");
	}
}
function showHide(target, contentBlock) {
	const btn = document.querySelector(target);
	const content = document.querySelector(contentBlock);
	btn.classList.toggle('isActive');
	if (content) {
		content.hasAttribute('hidden')
			? content.removeAttribute('hidden')
			: content.setAttribute('hidden', 'true')
	}
}

function createAlert() {
	let alert = document.createElement('div');
	let className = 'alert alert-success alert-number';
	let text = 'Номер заявки скопирован в буфер обмена';
	let styles = {
		position: 'fixed',
		top: '0',
		left: '50%',
		transform: 'translate(-50%, -150%)',
		'max-width': '280px',
		'text-align': 'center',
		transition: 'transform .3s ease 0s',
	}
	const toString = key => `${key}: ${styles[key]}`;
	let html = `<div class="${className}" style="${Object.keys(styles).map(toString).join(';')}">${text}</div>`;
	return { html };
}
const { html: alertHtml } = createAlert();
document.body.insertAdjacentHTML('beforeend', alertHtml);

const btnCopy = document.getElementById('btn-copy');
if (btnCopy) {
	const claimNumber = document.querySelector('.claim-number');
	const alertNumber = document.querySelector('.alert-number');
	btnCopy.addEventListener('click', () => {
		navigator.clipboard.writeText(claimNumber.textContent)
		btnCopy.querySelector("i").setAttribute("class", "fa-solid fa-file-circle-check");
		if (alertNumber) {
			alertNumber.style.transform = 'translate(-50%, 0%)';
			setTimeout(() => {
				alertNumber.style.transform = 'translate(-50%, -150%)';
				btnCopy.querySelector("i").setAttribute("class", "fa-regular fa-paste");
			}, 2000)
		}
	})
}
// Draggable Modal
if ($('.modal__header')) {
	$(".modal__header").on("mousedown", function (mousedownEvt) {
		var $draggable = $(this);
		var x = mousedownEvt.pageX - $draggable.offset().left,
			y = mousedownEvt.pageY - $draggable.offset().top;
		$("body").on("mousemove.draggable", function (mousemoveEvt) {
			$draggable.closest(".modal-content").offset({
				"left": mousemoveEvt.pageX - x,
				"top": mousemoveEvt.pageY - y
			});
		});
		$("body").one("mouseup", function () {
			$("body").off("mousemove.draggable");
		});
		$draggable.closest(".modal").one("bs.modal.hide", function () {
			$("body").off("mousemove.draggable");
		});
	});
}
