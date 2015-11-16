function SmartAjax_load(jsdir, callback, html4)
{
	var $ = window.jQuery;

	if ( jsdir.substr( jsdir.length - 1, 1 ) != '/' )
		jsdir += '/';

	if ( (document.documentMode || 100) < 9 ) // IE8-
		return false;

	if ( typeof html4 === 'undefined' )
		html4 = true;

	if ( html4 && typeof window.JSON === 'undefined' )
		document.write('<script src="' + jsdir + 'libs/historyjs/json2.js"><\/script>');

	document.write('<script src="' + jsdir + 'libs/historyjs/amplify.store.js"><\/script>');
	document.write('<script src="' + jsdir + 'libs/historyjs/history.adapter.jquery.js"><\/script>');
	document.write('<script src="' + jsdir + 'libs/historyjs/history.js"><\/script>');

	if ( html4 )
		document.write('<script src="' + jsdir + 'libs/historyjs/history.html4.js"><\/script>');

	document.write('<script src="' + jsdir + 'smartajax.js"><\/script>');

	if ( typeof callback === 'function' )
		$(function(){
			if ( window.History.enabled )
				callback();
		});
}