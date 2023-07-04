const records = [];
async function getRecords() {
	const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
	const response = await fetch(`${BASE_URL}/search`, {
		headers: {
			"X-CSRF-Token": token
		},
		method: 'POST',
	});
	const data = await response.json();
	const result = await data;
	[...result].forEach((item) => {
		records.push({
			'surname': item.person_surname,
			'name': item.person_name,
			'patronymic': item.person_patronymic
		})
	})
}
getRecords();
// В функции contains мы будем проверять,
// содержится ли пользовательский запрос
// в каком-либо из названий:
function contains(query) {
	return records.filter((obj) =>
		obj.surname.toLowerCase().includes(query.toLowerCase())
	)
}
// Мок-объект сервера будет содержать метод search:
const server = {
	search(query) {
		// Этот метод будет возвращать промис,
		// таким образом мы будем эмулировать «асинхронность»,
		// как будто мы «сходили на сервер, он подумал и ответил».

		// Поставим логер, который будет выводить
		// каждый принятый запрос:
		console.log(query)
		return new Promise((resolve) => {
			// Таймаут нужен исключительно для того,
			// чтобы иметь возможность настраивать время задержки 🙂
			setTimeout(
				() =>
					resolve({
						// В качестве ответа будем отправлять объект,
						// значением поля list которого
						// будет наш отфильтрованный массив.
						list: query ? contains(query) : [],
					}),
				150
			)
		})
	},
}

const searchInput = document.querySelector('input[name="custom_search"]');
const searchResults = document.querySelector('.search-results');

function handleInput(e) {
	const { value } = e.target
	// Получаем значение в поле,
	// на котором сработало событие:
	server.search(value).then(function (response) {
		const { list } = response
		const html = list.reduce((markup, item) => {
			return `${markup}<li>${item}</li>`
		}, ``)

		searchResults.innerHTML = html
	})
}

// Аргументами функции будут:
// - функция, которую надо «откладывать»;
// - интервал времени, спустя которое функцию следует вызывать.
function debounce(callee, timeoutMs) {
	// Как результат возвращаем другую функцию.
	// Это нужно, чтобы мы могли не менять другие части кода,
	// чуть позже мы увидим, как это помогает.
	return function perform(...args) {
		// В переменной previousCall мы будем хранить
		// временную метку предыдущего вызова...
		let previousCall = this.lastCall
		// ...а в переменной текущего вызова —
		// временную метку нынешнего момента.
		this.lastCall = Date.now()
		// Нам это будет нужно, чтобы потом сравнить,
		// когда была функция вызвана в этот раз и в предыдущий.
		// Если разница между вызовами меньше, чем указанный интервал,
		// то мы очищаем таймаут...
		if (previousCall && this.lastCall - previousCall <= timeoutMs) {
			clearTimeout(this.lastCallTimer)
		}
		// ...который отвечает за непосредственно вызов функции-аргумента.
		// Обратите внимание, что мы передаём все аргументы ...args,
		// который получаем в функции perform —
		// это тоже нужно, чтобы нам не приходилось менять другие части кода.
		this.lastCallTimer = setTimeout(() => callee(...args), timeoutMs)
		// Если таймаут был очищен, вызова не произойдёт
		// если он очищен не был, то callee вызовется.
		// Таким образом мы как бы «отодвигаем» вызов callee
		// до тех пор, пока «снаружи всё не подуспокоится».
	}
}
const debouncedHandle = debounce(handleInput, 250)
if (searchInput) {
	searchInput.addEventListener('input', debouncedHandle)
}

