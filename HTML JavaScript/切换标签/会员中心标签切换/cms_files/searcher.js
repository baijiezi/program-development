var bigDiv = null;
var backDiv = null;

/**
 * 创建锁屏div
 */
function getBigDiv()
{
	if(bigDiv == null)
	{
		var sWidth,sHeight;  
		sWidth=document.body.offsetWidth;//浏览器工作区域内页面宽度  
		sHeight=$(document).height(); //屏幕高度（垂直分辨率）

		backDiv = $(document.createElement("div")).attr("id", "backDiv");
		backDiv.css("position","absolute");
		backDiv.css("top","0");
		backDiv.css("left","0");
		backDiv.css("width",sWidth + "px");
		backDiv.css("height",sHeight + "px");
		backDiv.css("filter","DXImageTransform.Microsoft.Alpha(style=3,opacity=25,finishOpacity=75");
		backDiv.css("opacity","0.6");
		backDiv.css("background","#fff");
		backDiv.css("zIndex","9999");
		
		bigDiv = $(document.createElement("div")).attr("id", "bigDiv");
		bigDiv.css("zIndex","10000");
		
		$("body").append(bigDiv);
		$("body").append(backDiv);
	}		
}

/**
 *將div显示出来，并锁屏
 *@param showedDiv 要显示的div的JQ对象 
 */
function showDiv( showedDiv )
{
	showedDiv.show();
	getBigDiv();
	if(showedDiv.parent()!=bigDiv)
	{
		showedDiv.css("zIndex","10000");
		bigDiv.append(showedDiv);
	}
	backDiv.show();
	bigDiv.show();
	showedDiv.center();
}

/**
 * 將div隐藏起来，并解锁屏幕
 */
function hideBigDiv()
{
	$("#bookingFloatDiv").hide();
	backDiv.hide();
	bigDiv.hide();
}


//function showScheduleTime( neturl, obj )
//{
//	$.ajax({
//			 type: "GET",
//			 url: neturl,
//			 dataType: "html",
//					success: function(resHtml){
//					$("#scheculeDetailDiv").css("position","absolute");
//					$("#scheculeDetailDiv").css("background","#FFF");
//					$("#scheculeDetailDiv").css("top",$(obj).offset().top-$("#doctorsBox").offset().top+10);
//					$("#scheculeDetailDiv").css("left",$(obj).offset().left-$("#doctorsBox").offset().left+10);
//					$("#scheculeDetailDiv").html(resHtml);
//		   		}
//		   	});
//}



//
//(function($){
//	
//	$.fn.initOpcSearch = function(hospitalNo, deptId, doctorCardNo, dateTime) {
//		
//		/**
//		 * 如果当前选择的医院是红会或者华侨则显示挂号时段，否则显示上下午
//		 */
//		function showCurrentDayTime()
//		{
//			var isSpecial = isCurrentDay&&(hiddenInput.hospitalNo.val()=='0020102025'||hiddenInput.hospitalNo.val()=='0020102035'); 
//			if(isSpecial )
//			{
//				$("#apm").hide();
//				$("#jiaji_bt").hide();
//				$("#currendDayTime").show();
//			}
//			else
//			{
//				$("#apm").show();
//				$("#jiaji_bt").show();
//				$("#currendDayTime").hide();
//			}
//		}
//		
//
//		/**
//		 * 初始化医生框数据和事件
//		 */
//		function initHospital(html) {
//			bigDiv = getBigDiv();
//			divCache.hospital = $(document.createElement("div")).attr("id", hospitalsBoxId).html(html);
//			divCache.hospital.addClass("divCache");
////			divCache.hospital.css("progid","progid:DXImageTransform.Microsoft.Alpha(style=3,opacity=100,finishOpacity=100");
////			divCache.hospital.css("opacity","1");
//			  
//			divCache.hospital.find("#closeBox").click(function() {
//				hideBigDiv();
//			});
//			divCache.hospital.find("#clearBox").click(function() {
//				//清空医院
//				hiddenInput.hospitalNo.val("");
//				hospitalName.val("选择医院（必选）");
//				hiddenInput.deptId.val("");
//				deptName.val("选择科室（可选）");
//				//hiddenInput.doctorCardNo.val("");
//				//doctorName.val("选择医生（可选）");
//				//hiddenInput.dateTime.val("");
//				//dateTimeText.val("选择时间（可选）");
//				hideBigDiv();
//				divCache.hospital.find("ul li").removeClass("yellow12");
//			});
//			divCache.hospital.find("#_listBox ul li a").click(function() {
//				//选定医院
//				divCache.hospital.find("ul li").removeClass("yellow12");
//				$(this).parent().addClass("yellow12");
//				hospitalName.val($(this).text());
//				hiddenInput.hospitalNo.val($(this).attr("hospitalNo"));
//				hiddenInput.deptId.val("");
//				deptName.val("选择科室（可选）");
//				//hiddenInput.doctorCardNo.val("");
//				//doctorName.val("选择医生（可选）");
//				//hiddenInput.dateTime.val("");
//				//dateTimeText.val("选择时间（可选）");
//				hideBigDiv();
//
//				showCurrentDayTime();
//			});
//			
//			divCache.hospital.find("form").submit(function() {
//				$.post($(this).attr("action"), $(this).serialize(), function(html) {
//					divCache.hospital.remove();
//					initHospital(html);
//				});
//				return false;
//			});
//			showDiv(divCache.hospital);
////			bigDiv.append(divCache.hospital);
////
////			bigDiv.show();
////			divCache.hospital.center();
//		}
//		
//		function initDept(html) {
//			divCache.dept = $(document.createElement("div")).attr("id", deptsBoxId ).html(html);
//			divCache.dept.addClass("divCache");
//			divCache.dept.find("#closeBox").click(function() {
//				hideBigDiv();
//			});
//			divCache.dept.find("#clearBox").click(function() {
//				//清空科室
//				hiddenInput.deptId.val("");
//				deptName.val("选择科室（可选）");
//				hideBigDiv();
//				//hiddenInput.doctorCardNo.val("");
//				//doctorName.val("选择医生（可选）");
//				//hiddenInput.dateTime.val("");
//				//dateTimeText.val("选择时间（可选）");
//				divCache.dept.find("ul li").removeClass("yellow12");
//			});
//			divCache.dept.find("#_listBox ul li a").click(function() {
//				//选定科室
//				divCache.dept.find("ul li").removeClass("yellow12");
//				$(this).parent().addClass("yellow12");
//				deptName.val($(this).text());
//				hiddenInput.deptId.val($(this).attr("deptId"));
//				hiddenInput.deptSpell.val($(this).text());
//				hideBigDiv();
//				//hiddenInput.doctorCardNo.val("");
//				//doctorName.val("选择医生（可选）");
//				//hiddenInput.dateTime.val("");
//				//dateTimeText.val("选择时间（可选）");
//			});
//			divCache.dept.find("form").submit(function() {
//				$.post($(this).attr("action"), $(this).serialize(), function(html) {
//					divCache.dept.remove();
//					initDept(html);
//				});
//				return false;
//			});
//			showDiv(divCache.dept);
//		}
//		
//		/**
//		function initDoctor(html) {
//			divCache.doctor = $(document.createElement("div")).attr("id", doctorsBoxId).html(html);
//			divCache.doctor.addClass("divCache");
//			divCache.doctor.addClass("doctorsBox");
//			divCache.doctor.find("#closeBox").click(function() {
//				hideBigDiv();
//			});
//			divCache.doctor.find("#clearBox").click(function() {
//				//清空医生
//				hiddenInput.doctorCardNo.val("");
//				doctorName.val("选择医生（可选）");
//				hideBigDiv();
//				//hiddenInput.dateTime.val("");
//				//dateTimeText.val("选择时间（可选）");
//				divCache.doctor.find("ul li").removeClass("yellow12");
//			});
//			divCache.doctor.find("#_listBox ul li a").click(function() {
//				//选定选定医生
//				divCache.doctor.find("ul li").removeClass("yellow12");
//				$(this).parent().addClass("yellow12");
//				doctorName.val($(this).text());
//				hiddenInput.doctorCardNo.val($(this).attr("doctorCardNo"));
//				hideBigDiv();
//				//hiddenInput.dateTime.val("");
//				//dateTimeText.val("选择时间（可选）");				
//			});
//			
//			
//			/**
//			 * 按日期查找医生
//			 */
//			/**
//			divCache.doctor.find("select[name='dateTime']").change(function(){
////				
////				for (var i in divCache)
////					if (divCache[i]&&divCache[i]!=divCache.doctor)//不隐藏医生框
////					{
////						divCache[i].hide();
////					}
//				
//				if($(this).val()=='')
//				{
//					//显示当前医生
//					divCache.doctor.find("div#_listBox li").show();
//				}
//				else
//				{
//					$.getJSON(
//						url("searcher-ajaxGetDoctorsByDate"),
//						{hospitalNo: hiddenInput.hospitalNo.val(), deptId: hiddenInput.deptId.val(), isCurrentDay: isCurrentDay, dateTime:$(this).val(),byJson:true},
//						function(json)
//						{
//							//清空当前的医生
//							divCache.doctor.find("div#_listBox li").hide();
//							//遍历返回的医生
//							var newdoctors = json;
//	//						var newprepend=0;
//							for(var newdoctor in newdoctors)
//							{
//								//如果未记录医生
//								var oldDrLi = divCache.doctor.find("div#_listBox li:contains('"+newdoctors[newdoctor].doctorName+"')");
//								if(!oldDrLi.length)
//								{
//	//								newprepend++;
//									var newDrLi=$("<li style=\"width: 77px\"><a href=\"javascript:void(0);\" doctorCardNo=\"" +
//											newdoctors[newdoctor].doctorCardNo+
//											"\" >" + newdoctors[newdoctor].doctorName +
//											"</a></li>");
//									divCache.doctor.find("div#_listBox").prepend(newDrLi);
//								//var oldDra = divCache.doctor.find("div#_listBox a[doctorcardno="+newdoctors[newdoctor].doctorCardNo+"]");
//									//加入医生
//									oldDrLi = newDrLi;
//								}
//								//显示医生
//								oldDrLi.show();
//							}
//						}
//					);
//				}
//				return;
//				
//			});*/
//			
//			/**
//			 * 医生框表单提交
//			 */
//			/**
//			divCache.doctor.find("form").submit(function() {
//				$.post($(this).attr("action"), $(this).serialize(), function(html) {
//					divCache.doctor.remove();
//					initDoctor(html);
//				});
//				return false;
//			});*/
//			
//			
//			/**
//			 * 挂号类型事件
//			 */
//			/**
//			divCache.doctor.find("select[name='opcType']").change(function(){
//				$.ajax({
//					type: "GET",
//					url: $(this).attr("urlbydate")+"&opcType="+$(this).val(),
//					dataType: "html",
//					success: function(resHtml){
//						divCache.doctor.remove();
//						initDoctor(resHtml);
//					}
//				});
//			});*/
//			
//			/**
//			 * 排班周期事件weekType
//			 */
//			/**
//			divCache.doctor.find("a[name='selectWeekType']").click(function(){
//				$("#doctorsBox #_listBox").html("<img style='margin-top:70px;margin-left:210px' src='http://www.968309.com/cms/images/doctors/bigloading.gif' alt='loading....'>");
//				$.ajax({
//					type: "GET",
//					url: $(this).attr("loadurl"),
//					dataType: "html",
//					success: function(resHtml){
//						divCache.doctor.remove();
//						initDoctor(resHtml);
//					}
//				});
//			});*/
//			
//			//showDiv(divCache.doctor);
//		//}*/
//		
//		/** 
//		function initDateTime(html)
//		{
//			divCache.dateTime = $(document.createElement("div")).attr("id", dateTimesBoxId ).html(html);
//			divCache.dateTime.addClass("divCache");
//			divCache.dateTime.find("#closeBox").click(function() {
//				hideBigDiv();
//			});
//			divCache.dateTime.find("#clearBox").click(function() {
//				//清空日期时间
//				hiddenInput.dateTime.val("");
//				dateTimeText.val("选择时间（可选）");
//				hideBigDiv();
//				divCache.dateTime.find("ul li").removeClass("yellow12");
//			});
//			divCache.dateTime.find("#_listBox ul li a").click(function() {
//				divCache.dateTime.find("ul li").removeClass("yellow12");
//				$(this).parent().addClass("yellow12");
//				dateTimeText.val($(this).text());
//				hiddenInput.dateTime.val($(this).attr("datetime"));
//				hideBigDiv();
//				$("#opcBtn").attr("disabled","");
//			});
//
//			showDiv(divCache.dateTime);
//		}
//		*/
//		
//		var hiddenInput = {
//			hospitalNo: $(document.createElement("input")).attr({type: "hidden", name: "hospitalNo", value: hospitalNo}),
//			deptId: $(document.createElement("input")).attr({type: "hidden", name: "deptId", value: deptId}),
//			deptSpell: $(document.createElement("input")).attr({type: "hidden", name: "deptSpell", value: null}),
//			//doctorCardNo: $(document.createElement("input")).attr({type: "hidden", name: "doctorCardNo", value: doctorCardNo}),
//			//dateTime: $(document.createElement("input")).attr({type: "hidden", name: "dateTime", value: dateTime})
//		};
//		
//		var divCache = {
//			hospital: null,
//			dept: null,
//			//doctor: null,
//			//dateTime:null
//		};
//		
//		for (var i in hiddenInput)
//			$(this).append(hiddenInput[i]);
//		
//		var hospitalsBoxId = "hospitalsBox";
//		var deptsBoxId = "deptsBox";
//		//var doctorsBoxId = "doctorsBox";
//		//var dateTimesBoxId = "dateTimesBox";
//		
//		/**
//		 * 加急
//		 */
//		var isCurrentDayObj = $(this).find("input[name=isCurrentDay]");
//		if( isCurrentDayObj.length>0 )
//		{
//			var isCurrentDay = isCurrentDayObj.val();
//			hospitalsBoxId += "currentday";
//			deptsBoxId += "currentday";
//			//doctorsBoxId += "currentday";
//			//dateTimesBoxId += "currentday";
//		}
//				
//		var hospitalName = $(this).find("input[name=hospitalName]");
//		var deptName = $(this).find("input[name=deptName]");
//		var doctorName = $(this).find("input[name=doctorName]");
//		//var dateTimeText = $(this).find("input[name=dateTimeText]");
//		
//		hospitalName.click(function() {
//			//hideBigDiv();
//			if (divCache.hospital != null) 
//			{
//				showDiv(divCache.hospital);
//				if (divCache.dept != null) {
//					divCache.dept.remove();
//					divCache.dept = null;
//				}
//				/**
//				if (divCache.doctor != null) {
//					divCache.doctor.remove();
//					divCache.doctor = null;
//				}
//				if (divCache.dateTime != null) {
//					divCache.dateTime.remove();
//					divCache.dateTime = null;
//				}*/
//			}
//			else
//			{
//				$.get(url("Searcher-ajaxGetHospitals"), {isCurrentDay: isCurrentDay}, initHospital);
//			}
//		});
//		
//		deptName.click(function() {
//			if(hiddenInput.hospitalNo.val() == "")
//			{
//				alert("请先选择要预约挂号的医院");
//				return;
//			}
//			hideBigDiv();
//			if (divCache.dept != null) 
//			{
//				showDiv(divCache.dept);
//				/**
//				if (divCache.doctor != null) {
//					divCache.doctor.remove();
//					divCache.doctor = null;
//				}*/
//			}
//			else
//				$.get(url("Searcher-ajaxGetDepts"), {hospitalNo: hiddenInput.hospitalNo.val(),isCurrentDay: isCurrentDay}, initDept);
//		});
//		
//		/**
//		if (doctorName.length > 0)
//			doctorName.click(function() {
//				if(hiddenInput.hospitalNo.val() == "")
//				{
//					alert("请先选择要预约挂号的医院");
//					return;
//				}
//				else if(isCurrentDay && hiddenInput.deptId.val() == "")
//				{
//					alert("加急预约请先选择要预约挂号的科室");
//					return;
//				}
//				hideBigDiv();
//				if (divCache.doctor != null)
//				{
//					showDiv(divCache.doctor);
//					if (divCache.dateTime != null) {
//						divCache.dateTime.remove();
//						divCache.dateTime = null;
//					}
//				}
//				else
//					$.get(
//						url("searcher-ajaxGetDoctors"), 
//						{hospitalNo: hiddenInput.hospitalNo.val(), deptId: hiddenInput.deptId.val(), isCurrentDay: isCurrentDay},
//						initDoctor
//					);
//			});*/
//		
//		/**
//		if(dateTimeText.length > 0)
//		{
//			dateTimeText.click(function(){
//				if(hiddenInput.hospitalNo.val() == "")
//				{
//					alert("请先选择要预约挂号的医院");
//					return;
//				}
//				hideBigDiv();
//				if (divCache.dateTime != null)
//				{
//					showDiv(divCache.dateTime);
//				}
//				else
//				{
//					$.get(
//						url("searcher-ajaxGetSchedule"), 
//						{hospitalNo: hiddenInput.hospitalNo.val(), doctorCardNo: hiddenInput.doctorCardNo.val(), isCurrentDay: isCurrentDay},
//						initDateTime
//					);
//				}
//			});
//		}*/
//		
//		$(this).submit(function() {
//			var url = $(this).attr("action");
//			$(this).find("input").each(function() {
//				var name = $(this).attr("name");
//				if (name == "hospitalNo" || name == "deptId" || name == "deptSpell") { 
//					//|| name == "dateTime"
//					url += "&"+name+"="+$(this).val();
//				}
//			});
//			window.location.href = url;
//			return false;
//		});
//	};
//})(jQuery);
