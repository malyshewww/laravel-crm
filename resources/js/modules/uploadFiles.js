const formFile = document.getElementById('formFile');
if (formFile) {
	const dropArea = formFile.querySelector('.drag-area');
	const inputUpload = formFile.querySelector('#file_uploads');
	const fileList = formFile.querySelector('#fileList');
	const emptyList = formFile.querySelector('#emptyList');



	let file;
	let files = inputUpload.files;

	checkEmptyList(files);

	function renderFile(file) {
		// Формируем разметку для нового файла
		let fileItem = `<li class="upload-file__item">
						<span class="file-name">${file.name}</span>
						<button type="button" data-action="delete" class="btn-file">
							<i class="fa-solid fa-xmark"></i>
						</button>
					</li>`;
		// Добавляем данные файла (file.name) на страницу
		fileList.insertAdjacentHTML('afterbegin', fileItem);
	}
	function deleteFile(event) {
		// Проверяем если клик был НЕ по кнопке "удалить файл"
		if (event.target.dataset.action !== 'delete') return;
		const parentNode = event.target.closest('.upload-file__item');
		// Удаляем файл из разметки
		parentNode.remove();
		checkEmptyList(files);
	}
	function checkEmptyList(files) {
		if (files.length === 0) {
			const emptyListHTML = `<li id="emptyList" class="upload-file__item">Нет загруженных файлов</li>`;
			fileList.insertAdjacentHTML('afterbegin', emptyListHTML);
		}
		if (files.length > 0) {
			const emptyListEl = document.querySelector('#emptyList');
			emptyListEl ? emptyListEl.remove() : null;
		}
	}

	dropArea.addEventListener('click', () => {
		inputUpload.click();
	});

	fileList.addEventListener('click', deleteFile);

	inputUpload.addEventListener('change', (event) => {
		file = event.target.files[0];
		displayFile();
	});

	dropArea.addEventListener('dragover', (event) => {
		event.preventDefault();
		dropArea.classList.add('active');
	})

	dropArea.addEventListener('dragleave', () => {
		dropArea.classList.remove('active');
	})

	dropArea.addEventListener('drop', (event) => {
		event.preventDefault();
		file = event.dataTransfer.files[0];
		displayFile();
		// if (validFileType(file)) {
		// 	// Если необходимо вывести изображение в превью, то делаем через создание new FileReader()
		// 	// let fileReader = new FileReader();
		// 	// fileReader.onload = function () {
		// 	// 	let fileURL = fileReader.result;
		// 	// 	let imgTag = `<img src="${fileURL}" alt>`;
		// 	// 	dropArea.innerHTML = imgTag;
		// 	// }
		// 	// fileReader.readAsDataURL(file)
		// 	preview.textContent = `File name: ${file.name}, file size: ${returnFileSize(file.size)}.`;
		// 	dropArea.classList.remove('active');
		// } else {
		// 	alert("Недопустимый тип файла");
		// 	// preview.textContent = `File name ${file.name}: Not a valid file type. Update your selection.`;
		// 	dropArea.classList.remove('active');
		// }
	})

	function displayFile() {
		while (fileList.firstChild) {
			fileList.removeChild(fileList.firstChild);
		}
		if (file?.size < 15728640) {
			renderFile(file);
			dropArea.classList.remove('active');
		} else {
			alert("Файл не должен превышать 15 МБ");
			dropArea.classList.remove('active');
			checkEmptyList(files);
		}
	}

	const fileTypes = [
		"image/apng",
		"image/bmp",
		"image/gif",
		"image/jpeg",
		"image/pjpeg",
		"image/png",
		"image/svg+xml",
		"image/tiff",
		"image/webp",
		"image/x-icon",
	];
	function validFileType(file) {
		return fileTypes.includes(file.type);
	}
	function returnFileSize(number) {
		if (number < 1024) {
			return `${number} bytes`;
		} else if (number >= 1024 && number < 1048576) {
			return `${(number / 1024).toFixed(1)} KB`;
		} else if (number >= 1048576) {
			return `${(number / 1048576).toFixed(1)} MB`;
		}
	}

}