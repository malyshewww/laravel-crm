const mainTable = document.getElementById('table-id');
let table = new DataTable(mainTable, {
	ordering: true,
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
	initComplete: function () {
		this.api().columns().every(function () {
			var column = this;
			var search = $(`<input class="form-control form-control-sm" type="text" placeholder="Search">`)
				.appendTo($(column.footer()).empty())
				.on('change input', function () {
					var val = $(this).val()
					column
						.search(val ? val : '', true, false)
						.draw();
				});

		});
	},
	// "processing": true,
	// "serverSide": true,
	// ajax: {
	// 	url: "claims/getClaims",
	// 	data: function (data) {
	// 		console.log(data);
	// 		data.searchCity = $('#fio').val();
	// 		data.searchGender = $('#tour_start').val();
	// 		data.searchName = $('#tour_end').val();
	// 	}
	// },

	"dom": 'lBfrtip',
	buttons: [
		{
			extend: 'excelHtml5',
			text: 'Скачать .xlxs',
			title: `Таблица заявок ${new Date().toISOString().slice(0, 10)}`
		},
	]
});
// $('#fio, #tour_start, #tour_end').on('change', function () {
// 	table.draw();
// })

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
