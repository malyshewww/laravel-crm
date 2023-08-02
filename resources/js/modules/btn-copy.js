
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
	const claimNumber = document.querySelector('[data-claim-number]');
	const alertNumber = document.querySelector('.alert-number');
	btnCopy.addEventListener('click', (event) => {
		const thisBtn = event.currentTarget;
		async function copyCode() {
			try {
				navigator.clipboard?.writeText(claimNumber.textContent)
				thisBtn.querySelector("i").setAttribute("class", "fa-solid fa-file-circle-check");
				thisBtn.setAttribute('disabled', 'true');
			} catch (e) {
				console.log(e);
			}
		}
		copyCode()
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