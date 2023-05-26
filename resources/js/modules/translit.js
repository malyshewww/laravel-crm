import { translit } from 'gost-transliteration';

/* Функция для транслитерации Фамилии и Имени
	Принимает 
	-	Целевой элемент (target) - input с типом checkbox в разметке
	-	значения атрибутов у селекторов (input) - откуда брать значение / куда записывать результат 
*/
export function getTranslitValues() {
	let forms = document.querySelectorAll('form');
	forms.forEach((form) => {
		if (form) {
			const inputSurName = form.querySelector('[data-name="surname"]');
			const inputSurNameLat = form.querySelector('[data-name="surname_lat"]');
			const inputName = form.querySelector('[data-name="name"]');
			const inputnNameLat = form.querySelector('[data-name="name_lat"]');
			const translitInput = form.querySelector(`[data-trigger="translit"]`)
			if (translitInput) {
				translitInput.addEventListener('change', (event) => {
					const inputSurNameValue = inputSurName.value;
					const inputNameValue = inputName.value;
					if (event.target.checked) {
						if (inputSurNameValue != "" && inputNameValue != "") {
							inputSurNameLat.value = translit(inputSurNameValue).toUpperCase();
							inputnNameLat.value = translit(inputNameValue).toUpperCase();
						}
					} else {
						inputSurNameLat.value = "";
						inputnNameLat.value = "";
					}
				})
			}
		}
	})
}
getTranslitValues();

// Кастомная функция для транслитерации с возможностью редактирования объекта с буквами
function transliterate(word) {
	var answer = "";
	var a = {}

	a["Ё"] = "YO"; a["Й"] = "I"; a["Ц"] = "TS"; a["У"] = "U"; a["К"] = "K"; a["Е"] = "E"; a["Н"] = "N"; a["Г"] = "G"; a["Ш"] = "SH"; a["Щ"] = "SCH"; a["З"] = "Z"; a["Х"] = "H"; a["Ъ"] = "'";
	a["ё"] = "yo"; a["й"] = "i"; a["ц"] = "ts"; a["у"] = "u"; a["к"] = "k"; a["е"] = "e"; a["н"] = "n"; a["г"] = "g"; a["ш"] = "sh"; a["щ"] = "sch"; a["з"] = "z"; a["х"] = "h"; a["ъ"] = "'";
	a["Ф"] = "F"; a["Ы"] = "Y"; a["В"] = "V"; a["А"] = "a"; a["П"] = "P"; a["Р"] = "R"; a["О"] = "O"; a["Л"] = "L"; a["Д"] = "D"; a["Ж"] = "ZH"; a["Э"] = "E";
	a["ф"] = "f"; a["ы"] = "y"; a["в"] = "v"; a["а"] = "a"; a["п"] = "p"; a["р"] = "r"; a["о"] = "o"; a["л"] = "l"; a["д"] = "d"; a["ж"] = "zh"; a["э"] = "e";
	a["Я"] = "Ya"; a["Ч"] = "CH"; a["С"] = "S"; a["М"] = "M"; a["И"] = "I"; a["Т"] = "T"; a["Ь"] = "'"; a["Б"] = "B"; a["Ю"] = "YU";
	a["я"] = "ya"; a["ч"] = "ch"; a["с"] = "s"; a["м"] = "m"; a["и"] = "i"; a["т"] = "t"; a["ь"] = "'"; a["б"] = "b"; a["ю"] = "yu";
	for (let i = 0; i < word.length; ++i) {
		answer += a[word[i]] === undefined ? word[i] : a[word[i]];
	}
	return answer;
}

// console.log(transliterate("Алексей"));