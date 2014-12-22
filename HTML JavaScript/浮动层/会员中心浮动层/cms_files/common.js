function url(uri, p, project) {
	if (!project) project = window.project;
	else project = "/" + project + ".php";
	var _url = "http://" + window.location.host + project + "?c=" + uri;
	if (p) _url += "&" + p;
	return _url;
}

function setHome(obj, url) {
	try {
		obj.style.behavior = "url(#default#homepage)";
		obj.setHomePage(url);
	} catch (e) {
		alert("此操作被浏览器拒绝");
	}
}

function initUser() {
	window.userCardNo = $.cookie("user_card_no");
	if (window.userCardNo) {
		var logoutUrl = url("userGateway-logout", "url=" + base64encode(window.location.href), "default");
		var html = "尊敬的&nbsp;  <b class=\"fontred\">" + $.cookie("user_name")
				+ "</b> &nbsp;阳光医疗网欢迎您！";
		html += " <a class=\"grea\" href=\""+url("userCenter", null, "cms")+"\">我的会员中心</a>";
		html += " <a onclick=\"return confirm('请确认退出')\" class=\"grea\" href=\"" + logoutUrl + "\">退出</a>";
		$("#userInfoBox").html(html);
	}
}

(function($){
	$.fn.center = function() {
		var _this = $(this);
		_this.css("position", "absolute");
		_this.css("top", ($(window).height() - _this.height()) / 2 + $(window).scrollTop() + "px");
		_this.css("left", ($(window).width() - _this.width()) / 2 + $(window).scrollLeft() + "px");
		return _this;
	};
})(jQuery);

function toggleTextSearch(o) {
	var obj = $(o);
	var val = obj.val();
	if(val == '请输入您要搜索的医生')
	{
		obj.val("");
	}
}

function toggleText(o) {
	var obj = $(o);
	var val = obj.val();
	var changed = obj.attr("changed");
	if (!changed) {
		var oldText = obj.attr("oldText");
		if (val) {
			if (oldText && val != oldText)
				obj.attr("changed", true);
			else {
				obj.attr("oldText", val);
				obj.val("");
			}
		} else {
			obj.val(obj.attr("oldText"));
		}
	}
}

function oldTextOnSubmit(drNameId)
{
	var drName = $("#"+drNameId).val();
	var oldText = $("#"+drNameId).attr("oldText");
	if( oldText==drName )
	{
		$("#"+drNameId).val("");			  	
	}
	return true;
}

var base64EncodeChars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
var base64DecodeChars = new Array(-1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
		-1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
		-1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, 62, -1, -1, -1,
		63, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, -1, -1, -1, -1, -1, -1, -1,
		0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19,
		20, 21, 22, 23, 24, 25, -1, -1, -1, -1, -1, -1, 26, 27, 28, 29, 30, 31,
		32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49,
		50, 51, -1, -1, -1, -1, -1);

function base64encode(str) {
	var returnVal, i, len;
	var c1, c2, c3;
	len = str.length;
	i = 0;
	returnVal = "";
	while (i < len) {
		c1 = str.charCodeAt(i++) & 0xff;
		if (i == len) {
			returnVal += base64EncodeChars.charAt(c1 >> 2);
			returnVal += base64EncodeChars.charAt((c1 & 0x3) << 4);
			returnVal += "==";
			break;
		}
		c2 = str.charCodeAt(i++);
		if (i == len) {
			returnVal += base64EncodeChars.charAt(c1 >> 2);
			returnVal += base64EncodeChars.charAt(((c1 & 0x3) << 4)
					| ((c2 & 0xF0) >> 4));
			returnVal += base64EncodeChars.charAt((c2 & 0xF) << 2);
			returnVal += "=";
			break;
		}
		c3 = str.charCodeAt(i++);
		returnVal += base64EncodeChars.charAt(c1 >> 2);
		returnVal += base64EncodeChars.charAt(((c1 & 0x3) << 4)
				| ((c2 & 0xF0) >> 4));
		returnVal += base64EncodeChars.charAt(((c2 & 0xF) << 2)
				| ((c3 & 0xC0) >> 6));
		returnVal += base64EncodeChars.charAt(c3 & 0x3F);
	}
	return returnVal;
}

function base64decode(str) {
	var c1, c2, c3, c4;
	var i, len, returnVal;
	len = str.length;
	i = 0;
	returnVal = "";
	while (i < len) {
		/* c1 */
		do {
			c1 = base64DecodeChars[str.charCodeAt(i++) & 0xff];
		} while (i < len && c1 == -1);
		if (c1 == -1)
			break;
		/* c2 */
		do {
			c2 = base64DecodeChars[str.charCodeAt(i++) & 0xff];
		} while (i < len && c2 == -1);
		if (c2 == -1)
			break;
		returnVal += String.fromCharCode((c1 << 2) | ((c2 & 0x30) >> 4));
		/* c3 */
		do {
			c3 = str.charCodeAt(i++) & 0xff;
			if (c3 == 61)
				return returnVal;
			c3 = base64DecodeChars[c3];
		} while (i < len && c3 == -1);
		if (c3 == -1)
			break;
		returnVal += String
				.fromCharCode(((c2 & 0XF) << 4) | ((c3 & 0x3C) >> 2));
		/* c4 */
		do {
			c4 = str.charCodeAt(i++) & 0xff;
			if (c4 == 61)
				return returnVal;
			c4 = base64DecodeChars[c4];
		} while (i < len && c4 == -1);
		if (c4 == -1)
			break;
		returnVal += String.fromCharCode(((c3 & 0x03) << 6) | c4);
	}
	return returnVal;
}