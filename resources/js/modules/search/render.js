import { numberFormatted } from '../number-format';
import { getTranslitValues } from '../translit';
import { initDatePicker } from '../calendar';
import Choices from 'choices.js';
import { changeVisaOptions, choiceConfig } from '../select-choices';
import * as Loader from "../loader";

export function renderModifiedData() {
	const searchBox = document.querySelectorAll('.search');
	[...searchBox].forEach((item) => {
		const type = item.dataset.type;
		const inputSearch = item.querySelector('input[name="search"]')
		const dropdownBlock = item.querySelector('.search__dropdown')
		item.addEventListener('click', (event) => {
			let target = event.target;
			console.log(target);
			if (target.closest('li')) {
				inputSearch.value = target.dataset.title;
				dropdownBlock.classList.remove('active');
				fetchModifiedData(target, type)
			};
			if (target.closest('button')) {
				dropdownBlock.classList.remove('active');
				inputSearch.value = '';
				fetchModifiedData(target, type)
			}
			if (!target) {
				dropdownBlock.classList.remove('active');
			}
		})
	})
	document.addEventListener('click', function (e) {
		[...searchBox].forEach((item) => {
			const dropdownBlock = item.querySelector('.search__dropdown')
			if (e.target !== item) {
				dropdownBlock.classList.remove('active');
			}
		});
	});
}
renderModifiedData()
function fetchModifiedData(target, type) {
	const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
	const id = target.dataset.id;
	const status = target.dataset.status;
	const parent = target.closest('[data-update-box]');
	const form = parent.closest('form');
	const modal = form.closest('.modal');
	const rowWrapper = parent.querySelector('.row-wrapper');
	const startPath = getStartPath(type);
	const path = `/${startPath}/${id}/${status}`;
	Loader.loader.classList.add('fixed')
	modal.appendChild(Loader.loader);
	Loader.displayLoading();
	(async () => {
		try {
			const response = await fetch(path, {
				headers: {
					"X-CSRF-Token": token
				},
			});
			const html = await response.text();
			rowWrapper.innerHTML = html;
			if (type === 'person' || type === 'tourist') {
				getTranslitValues();
				initDatePicker();
				let selects = rowWrapper.querySelectorAll('[data-select], .select-choices');
				[...selects].forEach((select) => {
					if (select) {
						let choices = new Choices(select, choiceConfig);
					}
				})
				numberFormatted();
				changeVisaOptions();
			}
			Loader.hideLoading()
			Loader.loader.remove();
		} catch (error) {
			console.log(error);
			Loader.hideLoading()
			Loader.loader.remove();
		}
	})();
}
function getStartPath(type) {
	switch (type) {
		case 'person': return 'persons';
		case 'company': return 'companies';
		case 'tourist': return 'tourists';
		default: break;
	}
}