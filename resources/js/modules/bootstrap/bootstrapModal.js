import bootstrap, { Modal, draggable } from "bootstrap";
const modals = document.querySelectorAll('.modal');

[...modals].forEach((modal) => {
	const header = modal.querySelector('.modal__header');
	header.onmousedown = function (e) {
		// 1. отследить нажатие
		var coords = modal.getBoundingClientRect();
		var shiftX = e.pageX - coords.left;
		var shiftY = e.pageY - coords.top;
		// header.style.position = 'absolute';
		moveAt(e);
		// document.body.appendChild(ball);
		modal.style.zIndex = 1000; // показывать над другими элементами
		// передвинуть под координаты курсора
		// и сдвинуть на половину ширины/высоты для центрирования
		function moveAt(e) {
			modal.style.left = e.pageX - shiftX + 'px';
			modal.style.top = e.pageY - shiftY + 'px';
		}
		// 3, перемещать по экрану
		document.onmousemove = function (e) {
			moveAt(e);
		};
		// 4. отследить окончание переноса
		header.onmouseup = function () {
			document.onmousemove = null;
			header.onmouseup = null;
		};
	};
	header.ondragstart = function () {
		return false;
	};
});
