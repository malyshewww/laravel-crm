// Плагин календаря air-datepicker
import AirDatepicker from "air-datepicker";
// Библиотека для позиционирования календаря
import { createPopper } from '@popperjs/core';
// Библиотека для настройки анимации появления | скрытия календаря
import anime from 'animejs';
// Плагин для форматирования даты
import moment from 'moment';

// Массив со значениями атрибутов, для которых в конфигурацию добавляется возможность выбора времени помиом основной даты
// const dateValues = ["dateflight_start", "dateflight_end", "datetransfer_start", "datetransfer_end", "datehabitation_start", "datehabitation_end", "expose_payment_date", "pay_date"];

let deviceType = window.innerWidth < 991.98 ? 'mobile' : 'desktop';

function getNumberOfDays(start, end) {
	const date1 = new Date(start);
	const date2 = new Date(end);
	// One day in milliseconds
	const oneDay = 1000 * 3600 * 24;
	// Calculating the time difference between two dates
	const diffInTime = date2.getTime() - date1.getTime();
	// Calculating the no. of days between two dates
	const diffInDays = Math.round(diffInTime / oneDay);
	return diffInDays;
}

export function initDatePicker(type) {
	// Конфигурация для одиночных дат
	let button = {
		content: 'Применить',
		className: 'custom-button-classname',
		onClick: (dp, date) => {
			let newDate = new Date(date);
			dp.selectDate(newDate);
			dp.setViewDate(newDate);
			dp.hide();
		}
	}
	const calendarPosition = {
		position({ $datepicker, $target, $pointer, done }) {
			let popper = createPopper($target, $datepicker, {
				placement: 'bottom',
				modifiers: [
					{
						name: 'flip',
						options: {
							padding: {
								top: 64
							}
						}
					},
					{
						name: 'offset',
						options: {
							offset: [0, 20]
						}
					},
					{
						name: 'arrow',
						options: {
							element: $pointer
						}
					}
				]
			})
			return function completeHide() {
				popper.destroy();
				done();
			}
		}
	}
	let startConfig = {}
	let endConfig = {}
	let settings = {}
	if (type === 'mobile') {
		settings = {
			// описание настроек для мобильной вариации.
			isMobile: true,
		}
	} else {
		settings = {
			// описание настроек для десктопной вариации.
			...calendarPosition,
			isMobile: false,
		}
	}

	const removeError = (input) => {
		if (input.classList.contains('error')) {
			input.classList.remove('error');
		}
	}
	const checkBtnAttributeDisabled = (inputStartDate, inputEndDate) => {
		const form = document.getElementById('formFilter');
		if (form) {
			const inputFio = form.querySelector('input#fio');
			const btnReset = form.querySelector('button[type="reset"]');
			inputStartDate.value === '' && inputEndDate.value === '' && inputFio.value === ''
				? btnReset.setAttribute('disabled', 'true')
				: btnReset.removeAttribute('disabled')
		}
	}
	const rangeDateConfig = {
		position: 'bottom right',
		buttons: ['today', 'clear'],
		dateSeparator: ",",
		timeFormat: 'HH:mm',
	}
	const datePickerRange = document.querySelectorAll('[data-range]');
	[...datePickerRange].forEach((range) => {
		let datepickerRange = new AirDatepicker(range, {
			...settings,
			range: true,
			autoClose: true,
			multipleDatesSeparator: ' - ',
			multipleDates: true,
			dateFormat: 'yyyy/MM/dd',
			// dynamicRange: true,
			onSelect: function onSelect(datepicker, selectedDates) {
				const { formattedDate } = datepicker
				if (formattedDate[0] && formattedDate[1]) {
					const dateStart = formattedDate[0];
					const dateEnd = formattedDate[1];
					const days = getNumberOfDays(dateStart, dateEnd);
					range.value = days;
				}
			},
		})
	})
	let forms = document.querySelectorAll('form');
	[...forms].forEach((form) => {
		let inputTriggerStart = form.querySelector('[data-trigger="date_start"]');
		let inputTriggerEnd = form.querySelector('[data-trigger="date_end"]');
		let inputAltFieldStart = form.querySelector('[data-name="date_start"]');
		let inputAltFieldEnd = form.querySelector('[data-name="date_end"]');
		if (inputTriggerStart && inputTriggerEnd && inputAltFieldStart && inputAltFieldEnd) {
			let inputAltFieldStartFormat = inputAltFieldStart.dataset.format;
			let inputAltFieldEndFormat = inputAltFieldEnd.dataset.format;
			let datepickerStart = new AirDatepicker(inputTriggerStart, {
				altField: inputAltFieldStart,
				...rangeDateConfig,
				...settings,
				...startConfig,
				autoClose: true,
				dateFormat: inputAltFieldStartFormat == 'datetime' ? "yyyy-MM-dd HH:mm" : "yyyy-MM-dd",
				altFieldDateFormat: inputAltFieldStartFormat == 'datetime' ? "yyyy-MM-dd HH:mm" : "yyyy-MM-dd",
				timepicker: inputAltFieldStartFormat == 'datetime' ? true : false,
				onSelect: ({ date, datepicker }) => {
					datepickerEnd.update({
						minDate: date
					})
					removeError(inputAltFieldStart);
					checkBtnAttributeDisabled(inputAltFieldStart, inputAltFieldEnd);
				},
				// clear: ({ opts }) => {
				// 	console.log(opts);
				// },
				// selectDates: [inputAltFieldStart.value != '' ? inputAltFieldStart.value : '']
			});
			let datepickerEnd = new AirDatepicker(inputTriggerEnd, {
				altField: inputAltFieldEnd,
				...rangeDateConfig,
				...settings,
				...endConfig,
				autoClose: true,
				dateFormat: inputAltFieldEndFormat == 'datetime' ? "yyyy-MM-dd HH:mm" : "yyyy-MM-dd",
				altFieldDateFormat: inputAltFieldEndFormat == 'datetime' ? "yyyy-MM-dd HH:mm" : "yyyy-MM-dd",
				timepicker: inputAltFieldEndFormat == 'datetime' ? true : false,
				onSelect: ({ date, datepicker }) => {
					datepickerStart.update({
						maxDate: date
					})
					removeError(inputAltFieldEnd);
					checkBtnAttributeDisabled(inputAltFieldStart, inputAltFieldEnd);
				},
				// selectDates: [inputAltFieldEnd.value != '' ? inputAltFieldEnd.value : '']
			});
		}
	})
	function singleDates() {
		const inputTriggerDates = document.querySelectorAll('[data-trigger="date"]');
		[...inputTriggerDates].forEach((item) => {
			const parent = item.closest('.field-group__box');
			const altFieldDate = parent.querySelector('[data-name="date"]');
			if (altFieldDate) {
				let altFieldDateFormat = altFieldDate?.dataset.format;
				let datepicker = new AirDatepicker(item, {
					...settings,
					dateSeparator: "",
					autoClose: true,
					dateFormat: altFieldDateFormat == "datetime" ? "yyyy-MM-dd HH:mm" : "yyyy-MM-dd",
					altField: altFieldDate,
					altFieldDateFormat: altFieldDateFormat == "datetime" ? "yyyy-MM-dd HH:mm" : "yyyy-MM-dd",
					buttons: ['today', 'clear'],
					timepicker: altFieldDateFormat == "datetime" ? true : false,
					timeFormat: 'HH:mm',
				})
			}
		});
	}
	singleDates();
}
initDatePicker(deviceType)
window.addEventListener("resize", () => {
	if (window.innerWidth < 991.98 && deviceType == 'desktop') {
		deviceType = 'mobile';
		// initDatePicker(deviceType);
	} else if (window.innerWidth > 991.98 && deviceType == 'mobile') {
		deviceType = 'desktop';
		// initDatePicker(deviceType);
	}
});

// Функция для диапазона дат
// let inputStartDate = document.querySelector('input[name="date_start"]');
// if (inputStartDate) {
// 	inputStartDate.addEventListener('change', function (e) {
// 		let value = inputStartDate.value;
// 		let newDate = new Date(value);
// 		inputStartDate.value = inputStartDate.value.replace(/([%#/?*+^$[\]\\(){}-])/g, '.');
// 		moment.defaultFormat = "DD.MM.YYYY";
// 		const date = moment(newDate, moment.defaultFormat, true).toDate();
// 		datepickerStart.selectedDates[0] = date;
// 		datepickerEnd.minDate = date;
// 	})
// }
