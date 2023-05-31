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
	"iDisplayLength": 5,
	order: [[0, 'desc']],
	"dom": 'lBfrtip',
	buttons: [
		{
			extend: 'excelHtml5',
			text: 'Скачать .xlxs',
			title: `Таблица заявок ${new Date().toISOString().slice(0, 10)}`
		},
	]
}
function initDataTable(data) {
	let tourTable = new DataTable(mainTable, {
		...tableConfig,
		"data": data,
		"columns": [
			{
				"data": 'number',
				"render": function (data, type, row, meta) {
					return `<a class="tour-table__link" href="${BASE_URL}/claims/${row.id}">${row.id}</a>`;
				}
			},
			{
				"data": 'date_start',
				"render": function (data, type, row, meta) {
					return `<strong>${moment(row.date_start).format('DD.MM.YYYY')}</strong> </br> (${row.night})`;
				}
			},
			{
				"data": 'city_country',
				"render": function (data, type, row, meta) {
					return `${row.city ? row.city : 'Не указано'} - ${row.country ? row.country : 'Не указано'}`
				}
			},
			{
				"data": 'customer',
				"render": function (data, type, row, meta) {
					return `${row.customer != ""
						? `<div class="text-clamp fw-600" title="${row.customer}">${row.customer}</div>`
						: `<div class="fw-600">Заказчик не указан</div>`
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
				"data": 'buttons',
				"render": function (data, type, row, meta) {
					return `<div class="table__button" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Перенести в архив">
						<button class="btn-archive" type="button" 
							data-bs-toggle="modal" data-bs-target="#deleteRecord" 
							data-type="delete" data-id="${row.id}" 
							data-url="${BASE_URL}/claims/${row.id}" data-title="Вы действительно хотите удалить заявку № ${row.id}">
							<i class="fa-solid fa-box-archive"></i>
						</button>
					</div>`;
				},
			},
		],
		"initComplete": function (settings, json) {
			changePostitionControlsDataTable();
		}
	})
}
function fetchTable(form) {
	let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
	const formData = new FormData(form);
	displayLoading();
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
			initDataTable(data);
			hideLoading();
		})
}
fetchTable()

function changePostitionControlsDataTable() {
	const dataTablesWrapper = document.querySelector('.dataTables_wrapper');
	if (dataTablesWrapper) {
		const parent = dataTablesWrapper.closest('.table-responsive');
		const dataTablesSort = dataTablesWrapper.querySelector('.dataTables_length');
		const dataTablesInfo = dataTablesWrapper.querySelector('.dataTables_info');
		const dataTablesPaginate = dataTablesWrapper.querySelector('.dataTables_paginate');
		const dataTableButtons = dataTablesWrapper.querySelector('.dt-buttons');

		const tableBottom = document.querySelector('.table-bottom');
		const filtersButtons = document.querySelector('.filters__buttons');
		const pagination = tableBottom.querySelector('.pagination');
		const sortBlock = document.querySelector('.sorting-block');

		dataTablesWrapper.style.overflowX = 'auto';
		const tb = document.createElement('div');
		tb.innerText = "bottom";
		pagination.appendChild(dataTablesPaginate);
		pagination.appendChild(dataTablesInfo);
		sortBlock.appendChild(dataTablesSort);
		filtersButtons.appendChild(dataTableButtons);
	}
	return false;
}

// const filtersButtons = document.querySelector('.filters__buttons');

// const dataTableButtons = document.querySelector('.dt-buttons');
// if (filtersButtons && dataTableButtons) {
// 	filtersButtons.appendChild(dataTableButtons)
// }
// if (tableBottom) {
// 	const sortBlock = document.querySelector('.sorting-block');
// 	const tableLength = document.querySelector('.dataTables_length');
// 	const tableInfo = document.querySelector('.dataTables_info');
// 	const tablePaginate = document.getElementById('tour-table_paginate');
// 	const pagination = document.querySelector('.pagination');
// 	pagination.insertAdjacentHTML('beforeend', tableInfo);
// 	pagination.insertAdjacentHTML('beforeend', tablePaginate);
// 	sortBlock.append(tableLength);
// }
// fetchTable();
// const testTable = document.getElementById('test-table');
// function testFetch(form) {
// 	let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
// 	const formData = new FormData(form);
// 	displayLoading();
// 	fetch('/claims/records', {
// 		headers: {
// 			"X-CSRF-Token": token
// 		},
// 		method: 'POST',
// 		body: formData,
// 	})
// 		.then(response => response.status == 200 ? response.json() : console.log('status error'))
// 		.then((data) => {
// 			console.log(data);
// 			hideLoading();
// 			let tourTable = new DataTable(testTable, {
// 				"processing": true,
// 				"data": data,
// 				"columns": [
// 					{
// 						"data": 'number',
// 						"render": function (data, type, row, meta) {
// 							return `<a class="tour-table__link" href="${BASE_URL}/claims/${row.id}">${row.id}</a>`;
// 						}
// 					},
// 					{
// 						"data": 'date_start',
// 						"render": function (data, type, row, meta) {
// 							return `<strong>${moment(row.date_start).format('DD.MM.YYYY')}</strong> </br> (${row.night})`;
// 						}
// 					},
// 					{
// 						"data": 'city_country',
// 						"render": function (data, type, row, meta) {
// 							return `${row.city ? row.city : 'Не указано'} - ${row.country ? row.country : 'Не указано'}`
// 						}
// 					},
// 					{
// 						"data": 'customer',
// 						"render": function (data, type, row, meta) {
// 							return `${row.customer != ""
// 								? `<div class="text-clamp fw-600" title="${row.customer}">${row.customer}</div>`
// 								: `<div class="fw-600">Заказчик не указан</div>`
// 								}`
// 						}
// 					},
// 					{
// 						"data": 'tourists',
// 						"render": function (data, type, row, meta) {
// 							return `${row.countTourists > 0
// 								? `<div class="text-clamp" title="${row.tourists}">
// 										<strong>${row.countTourists}:</strong>
// 										${row.tourists}
// 									</div>`
// 								: `Туристы не указаны`
// 								}`
// 						}
// 					},
// 					{
// 						"data": null,
// 						"render": function (data, type, row, meta) {
// 							return '';
// 						}
// 					},
// 					{
// 						"data": 'manager',
// 						"render": function (data, type, row, meta) {
// 							return `<div class="text-primary">${row.manager}</div>
// 							<div>${moment(row.created_at).format('DD.MM.YYYY HH:mm:ss')}</div>`;
// 						}
// 					},
// 					{
// 						"data": 'buttons',
// 						"render": function (data, type, row, meta) {
// 							return `<div class="table__button" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Перенести в архив">
// 								<button class="btn-archive" type="button"
// 									data-bs-toggle="modal" data-bs-target="#deleteRecord"
// 									data-type="delete" data-id="${row.id}"
// 									data-url="${BASE_URL}/claims/${row.id}" data-title="Вы действительно хотите удалить заявку № ${row.id}">
// 									<i class="fa-solid fa-box-archive"></i>
// 								</button>
// 							</div>`;
// 						},
// 					},
// 				]
// 			})
// 		})
// }
// testFetch();

function filterTable() {
	const formFilter = document.getElementById('formFilter');
	formFilter.addEventListener('submit', (event) => {
		event.preventDefault();
		const thisForm = event.target;
		$('#tour-table').DataTable().destroy();
		fetchTable(thisForm);
	})
}

filterTable();

