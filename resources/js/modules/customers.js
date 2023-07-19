import Choices from "choices.js";
import { getTranslitValues } from "./translit";
import { choiceConfig } from "./select-choices";
import { initDatePicker } from "./calendar";
import * as Loader from "./loader.js";
import { numberFormatted } from "./number-format";
import { removeAttributeDisabled, setAttributeDisabled } from "./common";

export const getCustomerDataList = (selectId, startUrl) => {
	const select = document.getElementById(selectId);
	const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
	if (select) {
		select.addEventListener('change', (event) => {
			const target = event.target;
			if (target.value !== '') {
				const id = target.value;
				const parent = target.closest('.tabs-content');
				const form = parent.closest('form');
				const buttons = form.querySelectorAll('.modal__buttons button')
				const rowWrapper = parent.querySelector('.row-wrapper');
				const path = target.value === '0' ? `/${startUrl}/${id}/new` : `/${startUrl}/${id}/old`;
				setAttributeDisabled(buttons);
				Loader.loader.setAttribute('class', 'loader');
				rowWrapper.appendChild(Loader.loader);
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
						if (selectId === 'personItems') {
							getTranslitValues();
							initDatePicker();
							let selects = rowWrapper.querySelectorAll('[data-select]');
							[...selects].forEach((select) => {
								if (select) {
									let choices = new Choices(select, {
										...choiceConfig,
										placeholderValue: ''
									});
								}
							})
						}
						numberFormatted()
						Loader.hideLoading()
						Loader.loader.remove();
						removeAttributeDisabled(buttons);
					} catch (error) {
						removeAttributeDisabled(buttons);
						Loader.hideLoading()
						Loader.loader.remove();
					}
				})();
			}
		})
	}
}

