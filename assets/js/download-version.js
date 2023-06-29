document.addEventListener('DOMContentLoaded', () => {
	const downloadToggles = document.querySelectorAll('.preview-download-toggle');
	downloadToggles.forEach((item) => {
		const toggleLink = item.querySelector('h4');
		toggleLink.addEventListener('click', (e) => {
			if (item.classList.contains('active')) {
				item.classList.remove('active');
				toggleLink.textContent = 'Show all downloads';
			} else {
				item.classList.add('active');
				toggleLink.textContent = 'Hide all downloads';
			}
		});
	});
});
