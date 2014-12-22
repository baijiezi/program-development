

//将对象转成JSON格式的字符串，——by lcg
(function($){
	$.extend({
		toJSON: function(obj) {
			
			var type = "object";
			if (obj instanceof Array)
				type = "array";
			else
				type = typeof(obj);
				
			switch (type) {
				case "array": {
					var strArray = '[';
					for ( var i = 0; i < obj.length; ++i) {
						var value = '';
						if (obj[i]) value = $.toJSON(obj[i]);
						strArray += value + ',';
					}
					if (strArray.charAt(strArray.length - 1) == ',') {
						strArray = strArray.substr(0, strArray.length - 1);
					}
					strArray += ']';
					return strArray;
				}
				case "date": {
					return 'new Date(' + obj.getTime() + ')';
				}
				case "boolean":
				case "function":
				case "number": {
					return obj.toString();
				}
				case "string": {
					return '"' + obj.toString() + '"';
				}
				default: {
					var serialize = '{';
					for ( var key in obj ) {
						if (key == 'Serialize')
							continue;
						var subserialize = 'null';
						if (obj[key] != undefined) {
							subserialize = $.toJSON(obj[key]);
						}
						serialize += '"' + key + '" : ' + subserialize + ',';
					}
					if (serialize.charAt(serialize.length - 1) == ',') {
						serialize = serialize.substr(0, serialize.length - 1);
					}
					serialize += '}';
					return serialize;
				}
			}
		}
	});
})(jQuery);
