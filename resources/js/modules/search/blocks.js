import { row } from "../utils";

class Block {
	constructor(options, value) {
		this.options = options;
		this.value = value;
	}
	toHTML() {
		throw new Error('Метод toHTML должен быть реализован')
	}
}
export class PersonBlock extends Block {
	constructor(options, value) {
		super(options, value)
	}
	toHTML() {
		const filterData = this.value
			? this.options.filter((obj) => obj.person_surname.toLowerCase().includes(this.value.toLowerCase()))
			: [];
		const html = filterData.map((item) => {
			return `<li data-status="old" data-id="${item['id']}" data-title="${item.person_surname} ${item.person_name} ${item.person_patronymic}">${item.person_surname} ${item.person_name} ${item.person_patronymic}</li>`
		}).join('')
		return row(html);
	}
	count() {
		const arrayFilter = this.options.filter((obj) => obj.person_surname.toLowerCase().includes(this.value.toLowerCase()))
		return arrayFilter.length;
	}
}
export class CompanyBlock extends Block {
	constructor(options, value) {
		super(options, value)
	}
	toHTML() {
		const filterData = this.value
			? this.options.filter((obj) => obj.company_fullname.toLowerCase().includes(this.value.toLowerCase()))
			: [];
		const html = filterData.map((item) => {
			return `<li data-status="old" data-id="${item['id']}" data-title="${item.company_fullname}">${item.company_fullname}</li>`
		}).join('')
		return row(html);
	}
	count() {
		const arrayFilter = this.options.filter((obj) => obj.company_fullname.toLowerCase().includes(this.value.toLowerCase()))
		return arrayFilter.length;
	}
}
export class TouristBlock extends Block {
	constructor(options, value) {
		super(options, value)
	}
	toHTML() {
		const filterData = this.value
			? this.options.filter((obj) => obj.tourist_surname.toLowerCase().includes(this.value.toLowerCase()))
			: [];
		const html = filterData.map((item) => {
			return `<li data-status="old" data-id="${item['id']}" data-title="${item.tourist_surname} ${item.tourist_name} ${item.tourist_patronymic}">${item.tourist_surname} ${item.tourist_name} ${item.tourist_patronymic}</li>`
		}).join('')
		return row(html);
	}
	count() {
		const arrayFilter = this.options.filter((obj) => obj.tourist_surname.toLowerCase().includes(this.value.toLowerCase()))
		return arrayFilter.length;
	}
}