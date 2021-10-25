const toastElList = [].slice.call(document.querySelectorAll(".toast"));
const toastList = toastElList.map(function (toastEl) {
	return new bootstrap.Toast(toastEl, {
		animation: true,
		autohide: true,
		delay: 3000,
	}).show();
});

const tooltipTriggerList = [].slice.call(
	document.querySelectorAll('[data-bs-toggle="tooltip"]')
);

const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
	return new bootstrap.Tooltip(tooltipTriggerEl);
});
