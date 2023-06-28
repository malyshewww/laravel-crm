const loader = document.getElementById('loader');
function displayLoading() {
	if (loader) {
		loader.removeAttribute('hidden');
		// to stop loading after some time
		setTimeout(() => {
			loader.setAttribute("hidden", true);
		}, 3000);
	}
}
function hideLoading() {
	if (loader) {
		loader.setAttribute("hidden", true);
	}
}
export {
	loader,
	displayLoading,
	hideLoading
}