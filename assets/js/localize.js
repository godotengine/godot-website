// Get the language label
const languageMap = {
	'de': 'Deutsch',
	'en': 'English',
	'es': 'Español',
	'fr': 'Français',
	'ja': '日本語',
	'ko': '한국어',
	'pl': 'Polski',
	'pt_BR': 'Português',
	'zh-cn': '中文（简体）',
	'zh-tw': '中文（繁體）',
};

document.querySelectorAll('.localize-language-label').forEach(function(el) {
	const lang = el.textContent;
	if (languageMap[lang]) {
		el.textContent = languageMap[lang];
	}
});
