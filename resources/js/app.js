// require('./bootstrap');
console.log('app init');

import './modules/bootstrap/bootstrapModal';
import './modules/tabs';
import './modules/calendar';
import './modules/currency';
import './modules/choices';
import './modules/uploadFiles';
import './modules/number-format';
// import './modules/mask-phone';
import './modules/tables';
import './modules/ajax';

export function getPersonItems() {
	const selectPersonItems = document.getElementById('personItems');
	const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
	if (selectPersonItems) {
		selectPersonItems.addEventListener('change', (event) => {
			const thisSelect = event.target;
			if (thisSelect.value !== '') {
				const personId = thisSelect.value;
				const parent = thisSelect.closest('#person');
				const rowWrapper = parent.querySelector('.row-wrapper');
				console.log(rowWrapper);
				const path = thisSelect.value === '0' ? `/persons/${personId}/new` : `/persons/${personId}/old`;
				(async () => {
					try {
						const response = await fetch(path, {
							headers: {
								"X-CSRF-Token": token
							},
						});
						const html = await response.text();
						rowWrapper.innerHTML = html;
					} catch (error) {
						console.log('error');
					}
				})();
			}
		})
	}
}
getPersonItems();
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
	btnCopy.addEventListener('click', (event) => {
		const thisBtn = event.currentTarget;
		navigator.clipboard.writeText(claimNumber.textContent)
		thisBtn.querySelector("i").setAttribute("class", "fa-solid fa-file-circle-check");
		thisBtn.setAttribute('disabled', 'true');
		if (alertNumber) {
			alertNumber.style.transform = 'translate(-50%, 0%)';
			setTimeout(() => {
				alertNumber.style.transform = 'translate(-50%, -150%)';
				thisBtn.querySelector("i").setAttribute("class", "fa-regular fa-paste");
				thisBtn.removeAttribute('disabled');
			}, 2000)
		}
	})
}

