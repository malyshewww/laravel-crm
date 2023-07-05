// require('./bootstrap');
console.log('app init');

import './modules/bootstrap/bootstrapModal';
import './modules/tabs';
import './modules/calendar';
import './modules/currency';
import './modules/select-choices';
import './modules/uploadFiles';
import './modules/number-format';
// import './modules/mask-phone';
import './modules/tables';
import './modules/ajax';
import './modules/customers';
import './modules/btn-copy';
import './modules/debounce.js';

// const myForm = document.querySelector('#my-form')
// if (myForm) {
// 	myForm.addEventListener('submit', (event) => {
// 		event.preventDefault();
// 		const search = document.querySelector('input[name="custom_search"]');
// 		console.log(search.value);
// 	})
// }

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

