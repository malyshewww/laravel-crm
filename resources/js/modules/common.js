export const setAttributeDisabled = (items) => {
	[...items].forEach((item) => {
		item.setAttribute('disabled', 'true')
	});
}
export const removeAttributeDisabled = (items) => {
	[...items].forEach((item) => {
		item.removeAttribute('disabled');
	});
}