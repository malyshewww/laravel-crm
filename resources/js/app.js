require('./bootstrap');
console.log('hello from app.js');

import './modules/bootstrapTooltip.js';

import './modules/tabs.js';
import './modules/calendar.js';
import './modules/choices.js';
import './modules/uploadFiles.js';

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

const btnCopy = document.getElementById('btn-copy');
if (btnCopy) {
	const claimNumber = document.querySelector('.claim-number')
	btnCopy.addEventListener('click', () => {
		navigator.clipboard.writeText(claimNumber.textContent)
		btnCopy.querySelector("i").setAttribute("class", "fa-solid fa-file-circle-check");
	})
}
