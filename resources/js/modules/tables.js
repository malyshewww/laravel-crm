import DataTable from 'datatables.net-dt';
import pdfmake from 'pdfmake';
import 'datatables.net-buttons-dt';
import 'datatables.net-buttons/js/buttons.html5.mjs';
import * as JSZip from "jszip";
import moment from 'moment';
import { bootstrapTooltip } from './bootstrap/bootstrapTooltip';
window.JSZip = JSZip;

const mainTable = document.getElementById('tour-table');
const loader = document.getElementById('loader');
function displayLoading() {
	loader.removeAttribute('hidden');
	// to stop loading after some time
	setTimeout(() => {
		loader.setAttribute("hidden", true);
	}, 5000);
}
function hideLoading() {
	loader.setAttribute("hidden", true);
}
const tableConfig = {
	ordering: true,
	sorting: false,
	searching: false,
	responsive: true,
	"aoColumnDefs": [
		{
			'bSortable': false,
			'aTargets': [0, 1, 2, 3, 4, 5, 6, 7]
		}],
	"language": {
		"emptyTable": "Данные в таблице отсутствуют",
		"lengthMenu": "Элементов на странице _MENU_",
		// "info": "Страница _START_ из _END_ (Всего элементов: _TOTAL_)",
		"info": "Страница _PAGE_ из _PAGES_ (Всего элементов: _TOTAL_)",
		"infoEmpty": "Нет доступных записей",
		"infoFiltered": "(Фильтрация по _MAX_ элементам)",
		"search": "Поиск:",
		"zeroRecords": "Ничего не найдено",
		"paginate": {
			"first": `<span><i class="fa-solid fa-angles-left"></i></span>`,
			"last": `<span><i class="fa-solid fa-angles-right"></i></span`,
			"next": `<span><i class="fa-solid fa-angle-right"></i></span`,
			"previous": `<span><i class="fa-solid fa-angle-left"></i></span>`
		},
		"processing": "<span class='fa-stack fa-lg'>\n\
               <i class='fa fa-spinner fa-spin fa-stack-2x fa-fw'></i>\n\
            </span>&emsp;",
		"buttons": {
			"excel": "Скачать .xlsx"
		}
	},
	"pagingType": "full_numbers",
	"aLengthMenu": [[1, 5, 10, 15, 25, 50, 100, 200 - 1], [1, 5, 10, 15, 25, 50, 100, 200, "All"]],
	"iDisplayLength": 10,
	order: [[0, 'desc']],
	"dom": 'lBfrtip',
	buttons: [
		{
			extend: 'excelHtml5',
			text: `<i class="fa-solid fa-file-excel"></i>Скачать .xlxs`,
			className: 'btn btn-download',
			title: `Таблица заявок ${new Date().toISOString().slice(0, 10)}`
		},
	]
}
let tourTable;

const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const tableAdditionalColumns = {
	columnActionFirst: (status, data) => {
		let dataItem = data
		switch (status) {
			case 'all':
				return `<div class="table__button table-btn" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Перенести в архив">
								<button class="btn-archive" type="button" 
									data-bs-toggle="modal" data-bs-target="#modalAction" 
									data-type="delete" data-id="${dataItem.id}"
									data-method="DELETE"
									data-url="${BASE_URL}/claims/${dataItem.id}/delete" data-title="Вы действительно хотите переместить заявку № ${dataItem.claim_number} в архив">
									<i class="fa-solid fa-box-archive"></i>
								</button>
							</div>
							`;
			case 'archived':
				return `<div class="table__button table-btn" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Восстановить в активные">
							<button class="btn-archive" type="button" 
								data-bs-toggle="modal" data-bs-target="#modalAction" 
								data-type="restore" data-id="${dataItem.id}"
								data-method="POST"
								data-url="${BASE_URL}/claims/${dataItem.id}/restore" data-title="Вы действительно хотите восстановить заявку № ${dataItem.claim_number}">
								<i class="fa-solid fa-reply"></i>
							</button>
					</div>
				`
		};
	},
	columnActionTwo: (status, data) => {
		let dataItem = data;
		switch (status) {
			case 'all':
				return `<div class="table__button table-btn" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Клонировать заявку">
							<button class="btn-archive" type="button" 
								data-bs-toggle="modal" data-bs-target="#modalAction" 
								data-type="clone" data-id="${dataItem.id}"
								data-method="POST"
								data-url="${BASE_URL}/replicates/${dataItem.id}" data-title="Вы действительно хотите клонировать заявку № ${dataItem.claim_number}">
								<i class="fa-regular fa-copy"></i>
							</button>
						</div>
					`;
			case 'archived':
				return `<div class="table__button table-btn" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Удалить">
						<button class="btn-archive" type="button" 
							data-bs-toggle="modal" data-bs-target="#modalAction" 
							data-type="delete" data-id="${dataItem.id}"
							data-method="DELETE"
							data-url="${BASE_URL}/claims/${dataItem.id}/force-delete" data-title="Вы действительно хотите удалить заявку № ${dataItem.claim_number}">
							<i class="fa-regular fa-trash-can"></i>
						</button>
					</div>
				`;
		}
	}
}

function initDataTable(data) {
	let tableStatus = mainTable.dataset.status;
	tourTable = new DataTable(mainTable, {
		...tableConfig,
		"data": data,
		"columns": [
			{
				"data": null,
				"orderable": false,
				"render": function (data, type, row, meta) {
					return `
						<span hidden>${row.id}</span>
					`;
				}
			},
			{
				"data": 'number',
				"orderable": false,
				"render": function (data, type, row, meta) {
					return `<a class="tour-table__link" href="${BASE_URL}/claims/${row.id}" target="_blank">${row.claim_number}</a>`;
				}
			},
			{
				"data": 'date_start',
				"render": function (data, type, row, meta) {
					return `<strong>${moment(row.date_start).format('DD.MM.YYYY')}</strong> </br> (${row.night})`;
				}
			},
			{
				"data": null,
				"render": function (data, type, row, meta) {
					return `${row.city ? row.city : 'Не указано'} - ${row.country ? row.country : 'Не указано'}`
				}
			},
			{
				"data": 'customer',
				"render": function (data, type, row, meta) {
					return `${row.customer != ""
						? `<div class="text-clamp fw-600" title="${row.customer}">${row.customer}</div>` : `<div class="fw-600">Заказчик не указан</div>`
						}`
				}
			},
			{
				"data": 'tourists',
				"render": function (data, type, row, meta) {
					return `${row.countTourists > 0
						? `<div class="text-clamp" title="${row.tourists}">
								<strong>${row.countTourists}:</strong>
								${row.tourists}
							</div>`
						: `Туристы не указаны`
						}`
				}
			},
			{
				"data": null,
				"render": function (data, type, row, meta) {
					return '';
				}
			},
			{
				"data": 'manager',
				"render": function (data, type, row, meta) {
					return `<div class="text-primary">${row.manager}</div> 
					<div>${moment(row.created_at).format('DD.MM.YYYY HH:mm:ss')}</div>`;
				}
			},
			{
				"data": null,
				"render": function (data, type, row, meta) {
					return tableAdditionalColumns.columnActionFirst(tableStatus, row);
				},
			},
			{
				"data": null,
				"render": function (data, type, row, meta) {
					return tableAdditionalColumns.columnActionTwo(tableStatus, row);;
				},
			},
		],
		"initComplete": function (settings, json) {
			changePostitionControlsDataTable();
			bootstrapTooltip();
		}
	})
}
let newArr = [];
function fetchTable(path, status, form) {
	let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
	const formData = new FormData(form);
	formData.append('status', (status === 'all' ? 'all' : 'archived'))
	displayLoading();
	fetch(path, {
		headers: {
			"X-CSRF-Token": token
		},
		method: 'POST',
		body: formData,
	})
		.then(response => response.status == 200 ? response.json() : console.log('status error'))
		.then((data) => {
			// newArr = data.map((element) => {
			// 	return {
			// 		"id": element['id'],
			// 		"date_start": element['date_start'],
			// 		"date_end": element['date_end'],
			// 		"manager": element['manager'],
			// 		"created_at": element['created_at'],
			// 		"countTourists": element['countTourists'],
			// 		"country": element['country'],
			// 		"city": element['city'],
			// 		"night": element['night'],
			// 		"tourists": element['tourists'],
			// 		"customer": element['customer'],
			// 	}
			// })
			initDataTable(data);
		})
		.catch(error => console.log(error))
		.finally(() => hideLoading())
}

window.addEventListener('load', () => {
	{
		if (mainTable) {
			let tableStatus = mainTable.dataset.status;
			switch (tableStatus) {
				case 'all':
					fetchTable('/claims/records', 'all');
					break;
				case 'archived':
					fetchTable('/claims/records', 'archived');
					break;
				default:
					break;
			}
		}
	}
})

function filterQuery(form, status) {
	let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
	const formData = new FormData(form);
	formData.append('status', (status === 'all' ? 'all' : 'archived'))
	fetch('/claims/records', {
		headers: {
			"X-CSRF-Token": token
		},
		method: 'POST',
		body: formData,
	})
		.then(response => response.status == 200 ? response.json() : console.log('status error'))
		.then((data) => {
			console.log(data);
			tourTable.clear();
			tourTable.rows.add(data);
			tourTable.draw();
			bootstrapTooltip();
		})
		.catch(error => console.log(error.message))
		.finally(() => hideLoading())
}

function filterTable() {
	const formFilter = document.getElementById('formFilter');
	let tableStatus = mainTable ? mainTable.dataset.status : null;
	if (formFilter) {
		const buttonReset = formFilter.querySelector('button[type="reset"]');
		const inputFio = formFilter.fio;
		const inputDateStart = formFilter.date_start;
		const inputDateEnd = formFilter.date_end;
		const inputs = formFilter.querySelectorAll('.field-group__input')
		buttonReset.setAttribute('disabled', 'true');
		const isPositiveValue = (e) => {
			return e.value === "";
		}
		[...inputs].forEach((input, index) => {
			input.addEventListener('change', (event) => {
				[...inputs].every(isPositiveValue) ? buttonReset.setAttribute('disabled', 'true') : buttonReset.removeAttribute('disabled')
			})
			input.addEventListener('input', (event) => {
				[...inputs].every(isPositiveValue) ? buttonReset.setAttribute('disabled', 'true') : buttonReset.removeAttribute('disabled')
			})
		})
		formFilter.addEventListener('submit', (event) => {
			event.preventDefault();
			const thisForm = event.target;
			displayLoading();
			tableStatus === 'all' ? filterQuery(thisForm, 'all') : filterQuery(thisForm, 'archived')
			// setURLSearchParam(thisForm);
		})
		buttonReset.addEventListener('click', (event) => {
			if (location.href.includes('?')) {
				history.pushState({}, null, location.href.split('?')[0]);
			}
			inputFio.value = '';
			inputDateStart.value = '';
			inputDateEnd.value = '';
			displayLoading();
			filterQuery(formFilter);
		})
	}
}
filterTable();

// function setURLSearchParam(key, value) {
// 	const url = new URL(window.location.href);
// 	url.searchParams.set(key, value);
// 	window.history.pushState({ path: url.href }, '', url.href);
// }
function setURLSearchParam(form) {
	const inputFio = form.fio;
	const inputDateStart = form.date_start;
	const inputDateEnd = form.date_end;
	const obj = {
		fio: inputFio.value,
		date_start: inputDateStart.value,
		date_end: inputDateEnd.value
	}
	// const result = '?' + new URLSearchParams(obj).toString();
	const url = new URL(window.location.href);
	for (const [k, v] of Object.entries(obj)) {
		if (obj[k] !== '') {
			url.searchParams.set(k, v)
		}
		window.history.pushState({ path: url.href }, '', url.href);
	}
}

function changePostitionControlsDataTable() {
	const dataTablesWrapper = document.querySelector('.dataTables_wrapper');
	if (dataTablesWrapper) {
		const dataTablesSort = dataTablesWrapper.querySelector('.dataTables_length');
		const dataTablesInfo = dataTablesWrapper.querySelector('.dataTables_info');
		const dataTablesPaginate = dataTablesWrapper.querySelector('.dataTables_paginate');
		const dataTableButtons = dataTablesWrapper.querySelector('.dt-buttons');

		const tableBottom = document.querySelector('.table-bottom');
		const filtersButtons = document.querySelector('.filters__buttons');
		const pagination = tableBottom.querySelector('.pagination');
		const sortBlock = document.querySelector('.sorting-block');

		dataTablesWrapper.querySelector('table').style.width = '100%';
		pagination.insertAdjacentElement('beforeend', dataTablesPaginate);
		pagination.insertAdjacentElement('beforeend', dataTablesInfo);
		sortBlock.insertAdjacentElement('beforeend', dataTablesSort);
		filtersButtons.insertAdjacentElement('beforeend', dataTableButtons);
	}
}
