const mainTable = document.getElementById('table-id');
let table = new DataTable(mainTable, {
	ordering: true,
	sorting: false,
	responsive: true,
	searching: false,
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
	// "processing": true,
	// "serverSide": true,
	// "ajax": {
	// 	"url": "/claims/records",
	// 	"data": function (data) {
	// 		console.log(data);
	// 	},
	// },
	// columns: [
	// 	{
	// 		title: 'Номер',
	// 		name: 'id',
	// 		render: 'Aidu'
	// 	},
	// 	{
	// 		title: 'Начало тура',
	// 		name: 'tour',
	// 	},
	// 	{
	// 		title: 'Страны назначения',
	// 		data: 'Страны назначения',
	// 		name: 'countries',
	// 	},
	// 	{
	// 		title: 'Заказчик, туристы',
	// 		data: 'Заказчик, туристы',
	// 		name: 'customer_tourists',
	// 	},
	// 	{
	// 		title: 'Поставщик, стоимость у ТО и оплата ТА',
	// 		data: 'Поставщик',
	// 		name: 'provider'
	// 	},
	// 	{
	// 		title: 'Заказчик, стоимость и долг заказчика',
	// 		data: 'Заказчик',
	// 		name: 'customer_cost',
	// 	},
	// 	{
	// 		title: 'Менеджер',
	// 		data: 'Менеджер',
	// 		name: 'manager',
	// 	},
	// 	{
	// 		data: 'Действия',
	// 		name: 'actions',
	// 	}
	// ],
	"dom": 'lBfrtip',
	buttons: [
		{
			extend: 'excelHtml5',
			text: 'Скачать .xlxs',
			title: `Таблица заявок ${new Date().toISOString().slice(0, 10)}`
		},
	]
});

const tableBottom = document.querySelector('.table-bottom');
const filtersButtons = document.querySelector('.filters__buttons');
const dataTableButtons = document.querySelector('.dt-buttons');
if (filtersButtons && dataTableButtons) {
	filtersButtons.appendChild(dataTableButtons)
}
if (tableBottom) {
	const sortBlock = document.querySelector('.sorting-block');
	const tableLength = document.querySelector('.dataTables_length');
	const tableInfo = document.querySelector('.dataTables_info');
	const tablePaginate = document.getElementById('table-id_paginate');
	const pagination = document.querySelector('.pagination');
	pagination.insertAdjacentElement("afterbegin", tableInfo);
	pagination.insertAdjacentElement("beforeend", tablePaginate);
	sortBlock.append(tableLength);
}

const testTable = document.getElementById('test-table');
function fetchTable(std, res) {
	// let data = {
	// 	std,
	// 	res
	// };
	const formFilter = document.getElementById('formFilter');
	formFilter.addEventListener('submit', (event) => {
		event.preventDefault();
		const thisForm = event.target;
		const formData = new FormData(thisForm);
		const inputFio = thisForm.fio;
		const inputDateStart = thisForm.date_start;
		const inputDateEnd = thisForm.date_end;
		const token = thisForm._token;
		f(inputFio.value, inputDateStart.value, inputDateEnd.value)
		// fetch('/claims/records', {
		// 	headers: {
		// 		"X-CSRF-Token": token,
		// 	},
		// 	method: 'POST',
		// 	body: formData
		// })
		// 	.then((response) => response.json())
		// 	.then((data) => {
		// 		var i = 1;
		// 		new DataTable(testTable, {
		// 			"data": data.students,
		// 			"columns": [
		// 				{
		// 					"data": "id",
		// 					"render": function (data, type, row, meta) {
		// 						return i++;
		// 					}
		// 				},
		// 				{
		// 					"data": "Начало тура",
		// 					"render": function (data, type, row, meta) {
		// 						return `${row.date_start}`;
		// 					}
		// 				},
		// 				{
		// 					"data": "Cтраны назначения"
		// 				},
		// 				{
		// 					"data": "Заказчик, туристы"
		// 				},
		// 				{
		// 					"data": " "
		// 				},
		// 				{
		// 					"data": " "
		// 				},
		// 				{
		// 					"data": "Менеджер"
		// 				},
		// 				{
		// 					"data": " "
		// 				},
		// 			]
		// 		});
		// 	})
		// 	.catch((error) => {
		// 		console.log(error);
		// 	})
	})
}
// fetchTable();
function testFetch(fio, date_start, date_end) {
	let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
	let data = {
		fio,
		date_start,
		date_end,
	};
	fetch('/claims/records', {
		headers: {
			"X-CSRF-Token": token
		},
		method: 'POST',
		body: data,
	})
		.then(response => response.status == 200 ? response.json() : console.log('status error'))
		.then((data) => {
			console.log(data);
			let table = new DataTable(testTable, {
				"processing": true,
				"data": data,
				"columns": [
					{
						"data": "number",
						"render": function (data, type, row, meta) {
							return `${row.id}`;
						}
					},
					{
						"data": "date_start",
						"render": function (data, type, row, meta) {
							return `${moment(row.date_start).format('DD.MM.YYYY')} (${row.night})`;
						}
					},
					{
						"data": null,
						"render": function (data, type, row, meta) {
							return `${row.city ? row.city : 'Не указано'} - ${row.country ? row.country : 'Не указано'}`
						}
					},
					{
						"data": null,
						"render": function (data, type, row, meta) {
							return `${row.tourists ? row.tourists : 'Туристы не указаны'}`;
						}
					},
					{
						"data": null
					},
					{
						"data": null
					},
					{
						"data": null
					},
					{
						"data": null
					},
				]
			})
		})
}
testFetch();
function filter() {
	const formFilter = document.getElementById('formFilter');
	formFilter.addEventListener('submit', (event) => {
		event.preventDefault();
		const thisForm = event.target;
		const formData = new FormData(thisForm)
		const inputFio = thisForm.querySelector('#fio').value
		const inputDateStart = thisForm.querySelector('#tour_start').value
		const inputDateEnd = thisForm.querySelector('#tour_end').value
		if (inputFio == "" || inputDateStart == "" || inputDateEnd == "") {
			alert('filter fields is required')
		} else {
			testFetch(inputFio, inputDateStart, inputDateEnd)
		}
	})
}
filter();
