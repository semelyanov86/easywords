module.exports = {
	globDirectory: 'public_html/',
	globPatterns: [
		'**/*.{css,ico,woff2,woff,svg,png,js,json,config}'
	],
	ignoreURLParametersMatching: [
		/^utm_/,
		/^fbclid$/
	],
	swDest: 'public_html/sw.js'
};