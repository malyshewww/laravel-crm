import bootstrap, { Modal, draggable } from "bootstrap";
const modals = document.querySelectorAll('.modal');
function onDrag({ movementX, movementY }) {
	[...modals].forEach((modal) => {
		let getStyle = window.getComputedStyle(modal);
		let left = parseInt(getStyle.left);
		let top = parseInt(getStyle.top);
		modal.style.left = `${left + movementX}px`;
		modal.style.top = `${top + movementY}px`;
	});
}
// function onTouch(e) {
// 	let x = e.touches[0].clientX;
// 	let y = e.touches[0].clientY;
// 	let target = e.target;
// 	[...modals].forEach((modal) => {
// 		if (modal.classList.contains('show')) {
// 			let getStyle = window.getComputedStyle(modal);
// 			let left = parseInt(modal.offsetLeft);
// 			let top = parseInt(modal.offsetTop);
// 			modal.style.left = `${left - (x - modal.clientX)}px`;
// 			modal.style.top = `${top - (y - modal.clientY)}px`;
// 			console.log(left, top);
// 			console.log(e);
// 		}
// 	});
// }
[...modals].forEach((modal) => {
	const header = modal.querySelector('.modal__header');
	header.addEventListener('mousedown', () => {
		header.addEventListener('mousemove', onDrag);
	})
	header.addEventListener('mouseup', () => {
		header.removeEventListener('mousemove', onDrag);
	})
	// header.addEventListener('touchstart', (event) => {
	// 	header.addEventListener('touchmove', onTouch);
	// })
	// header.addEventListener('touchend', (event) => {
	// 	header.removeEventListener('touchmove', onTouch);
	// })
});
