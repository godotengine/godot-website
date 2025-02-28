// Get the language label
const languageMap = {
	'en': 'English',
	'es': 'Español',
	'de': 'Deutsch',
	'fr': 'Français',
	'ja': '日本語',
	'zh-cn': '中文（中国）',
	'zh-tw': '中文（台灣）',
	'pt': 'Português',
};

document.querySelectorAll('.localize-language-label').forEach(function(el) {
	const lang = el.textContent;
	if (languageMap[lang]) {
		el.textContent = languageMap[lang];
	}
});
