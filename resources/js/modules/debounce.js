import { CompanyBlock, PersonBlock } from "./blocks";

export function debounced() {
	// В функции contains мы будем проверять,
	// содержится ли пользовательский запрос
	// в каком-либо из названий:
	// function contains(data, query) {
	// 	return data.filter((obj) =>
	// 		obj.person_surname.toLowerCase().includes(query.toLowerCase())
	// 	)
	// }
	function handleInput(e) {
		const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
		const { value } = e.target;
		const parent = e.target.parentNode;
		const searchResults = parent.querySelector('.search__dropdown');
		const dataType = parent.dataset.type;
		const path = getPath(dataType);
		(async () => {
			try {
				const response = await fetch(`${BASE_URL}/${path}`, {
					headers: {
						"X-CSRF-Token": token
					},
					method: 'POST',
					body: JSON.stringify(value)
				});
				const data = await response.json();
				const result = await data;
				const block = dataType === 'person' ? new PersonBlock(result, value) : new CompanyBlock(result, value);
				searchResults.innerHTML = block.toHTML();
			} catch (error) {
				console.log(error);
			}
		})()
	}

	function getPath(dataTypeValue) {
		let path = '';
		switch (dataTypeValue) {
			case 'person':
				path = 'personSearch';
				break;
			case 'company':
				path = 'companySearch';
				break;
			default:
				break;
		}
		return path;
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
	const debouncedHandle = debounce(handleInput, 400)
	const searchBox = document.querySelectorAll('.search');
	[...searchBox].forEach((item) => {
		const searchInput = item.querySelector('input[name="search"]');
		if (searchInput) {
			searchInput.addEventListener('input', debouncedHandle)
		}
	})
}

