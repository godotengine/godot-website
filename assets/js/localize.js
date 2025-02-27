// Get the language label
const languageMap = {
	'en': 'English',
	'de': 'Deutsch',
	'es': 'Español',
	'fr': 'Français',
	'ja': '日本語',
	'pt': 'Português',
	'zh': '中文',
};

document.querySelectorAll('.localize-language-label').forEach(function(el) {
	const lang = el.textContent;
	if (languageMap[lang]) {
		el.textContent = languageMap[lang];
	}
});
