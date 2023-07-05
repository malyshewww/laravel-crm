import { row } from "./utils";

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
		const html = filterData.reduce((markup, item) => {
			return `${markup}<li data-id="${item['id']}">${item.person_surname} ${item.person_name} ${item.person_patronymic}</li>`
		}, ``)
		return row(html);
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
		const html = filterData.reduce((markup, item) => {
			return `${markup}<li data-id="${item['id']}">${item.company_fullname}</li>`
		}, ``)
		return row(html);
	}
}