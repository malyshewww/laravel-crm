// Маска для телефона
export function mask() {
	var phones = document.querySelectorAll('input[type="tel"]');
	[...phones].forEach((phone) => {
		if (phone) {
			var code = '+7',
				find = /\+7/;
			code = '+';
			find = /\+/;
			phone.addEventListener('focus', function () {
				phone.value = code + " " + phone.value.replace(code + ' ', '');
			});
			phone.addEventListener('input', function () {
				var val = phone.value.replace(find, ''),
					res = code + " ";
				val = val.replace(/[^0-9]/g, '');
				for (var i = 0; i < val.length; i++) {
					//res+= i===0?' ':'';
					res += i === 1 ? ' (' : '';
					res += i == 4 ? ') ' : '';
					res += i == 7 || i == 9 ? ' ' : '';
					if (i == 11) break;
					res += val[i];
				}
				phone.value = res;
			});
			phone.addEventListener('blur', function () {
				var val = phone.value.replace(find, '');
				val = val.trim();
				if (!val) phone.value = null;
			});
		}
		var i = phone.length;
		while (i--) {
			mask(phone[i]);
		}
	})
}