/*
	[Discuz!] (C)2001-2009 Comsenz Inc.
	This is NOT a freeware, use is subject to license terms

	$Id: common.js 17535 2009-01-20 05:12:20Z monkey $
*/

var lang = new Array();
var userAgent = navigator.userAgent.toLowerCase();
var is_opera = userAgent.indexOf('opera') != -1 && opera.version();
var is_moz = (navigator.product == 'Gecko') && userAgent.substr(userAgent.indexOf('firefox') + 8, 3);
var is_ie = (userAgent.indexOf('msie') != -1 && !is_opera) && userAgent.substr(userAgent.indexOf('msie') + 5, 3);
var is_mac = userAgent.indexOf('mac') != -1;

function sun$(id) {
	return document.getElementById(id);
}

function doane(event) {
	e = event ? event : window.event;
	if(is_ie) {
		e.returnValue = false;
		e.cancelBubble = true;
	} else if(e) {
		e.stopPropagation();
		e.preventDefault();
	}
}

var cssloaded= new Array();
function loadcss(cssname) {
	if(!cssloaded[cssname]) {
		css = document.createElement('link');
		css.type = 'text/css';
		css.rel = 'stylesheet';
		css.href = IMGDIR+'/style_calendar.css?' + VERHASH;
		var headNode = document.getElementsByTagName("head")[0];
		headNode.appendChild(css);
		cssloaded[cssname] = 1;
	}
}

var InFloat = '';