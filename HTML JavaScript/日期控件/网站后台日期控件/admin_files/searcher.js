/**
 * 医院、科室、医生查询
 * by lcg 2010-07-06
 */

function Searcher(options) {
	var _options = {
		containerId: "searchers",
		hospitalNo: "",
		hospitalDeptId: "",
		doctorCardNo: "",
		hospital: true,
		hospitalDept: true,
		doctor: true,
		formId: "_chooseHospital",
		changeHospitalCallBack: null,
		changeHospitalDeptCallBack: null,
		changeDoctorCallBack: null,
		hospitalValueName: "hospital_no",
		deptValueName: "hospital_dept_id",
		doctorValueName: "doctor_card_no"
	};
	options = $.extend(_options, options);

	this.hospitalCookieName = "selectedHospital";
	this.hospitalDeptCookieName = "selectedHospitalDept";
	this.doctorCookieName = "selectedDoctor";
	
	this.hospitalCache = null;
	this.hospitalDeptCache = null;
	this.doctorCache = null;
	
	this.hospital = options.hospital;
	this.hospitalDept = options.hospitalDept;
	this.doctor = options.doctor;
	
	this.formId = options.formId;
	this.form = $("#"+this.formId);
	if (this.form.length <= 0) {
		this.form = $("<form id='"+this.formId+"' title='操作'></form>");
		$("body").append(this.form);
	}
	
	this.container = $("#"+options.containerId);
	
	this.inited = false;
	
	this.init(options);
}

Searcher.prototype.initChangeHospital = function(selectedHospital, callBack) {
	var selectedHospitalHtml = "";
	var _this = this;
	if (selectedHospital)
		for(var i = 0, j = selectedHospital.length; i < j; i++)
			selectedHospitalHtml += "<a href='javascript:void(0);' hospitalNo='"+selectedHospital[i].hospitalNo+"'>"+selectedHospital[i].hospitalName+"</a>";
	$("#"+this.formId+" div").html(selectedHospitalHtml);
	$("#"+this.formId+" div a").click(function() {
		_this.changeHospital($(this).text(), $(this).attr("hospitalNo"), false, callBack);
	});
}

Searcher.prototype.changeHospital = function(hospitalName, hospitalNo, noClearCookie, callBack) {
	if (!noClearCookie) {
		this.hospitalDeptCache = null;
		this.doctorCache = null;
		$.cookie(this.hospitalDeptCookieName, null);
		$.cookie(this.doctorCookieName, null);
		this.changeHospitalDept();
		this.changeDoctor();
	}
	if (!hospitalName) hospitalName = "选择医院";
	if (!hospitalNo) hospitalNo = "";
	$("#hospitalName").val(hospitalName).attr("title", hospitalName);
	$("#_hospitalName").val(hospitalName);
	$("#hospitalNo").val(hospitalNo);
	$("#"+this.formId).dialog("close");
	if (callBack) callBack(hospitalNo);
}
Searcher.prototype.initChangeHospitalDept = function(selectedHospitalDept, callBack) {
	var selectedHospitalDeptHtml = "";
	var _this = this;
	if (selectedHospitalDept)
		for(var i = 0, j = selectedHospitalDept.length; i < j; i++)
			selectedHospitalDeptHtml += "<a href='javascript:void(0);' hospitalDeptId='"+selectedHospitalDept[i].hospitalDeptId+"'>"+selectedHospitalDept[i].hospitalDeptName+"</a>";
	$("#"+this.formId+" div").html(selectedHospitalDeptHtml);
	$("#"+this.formId+" div a").click(function() {
		_this.changeHospitalDept($(this).text(), $(this).attr("hospitalDeptId"), false, callBack);
	});
}
Searcher.prototype.changeHospitalDept = function(hospitalDeptName, hospitalDeptId, noClearCookie, callBack) {
	if (!noClearCookie) {
		this.doctorCache = null;
		$.cookie(this.doctorCookieName, null);
		this.changeDoctor();
	}
	if (!hospitalDeptName) hospitalDeptName = "选择科室";
	if (!hospitalDeptId) hospitalDeptId = "";
	$("#hospitalDeptName").val(hospitalDeptName).attr("title", hospitalDeptName);
	$("#_hospitalDeptName").val(hospitalDeptName);
	$("#hospitalDeptId").val(hospitalDeptId);
	$("#"+this.formId).dialog("close");
	if (callBack)  callBack(hospitalDeptId);
}
Searcher.prototype.initChangeDoctor = function(selectedDoctor, callBack) {
	var selectedDoctorHtml = "";
	var _this = this;
	if (selectedDoctor)
		for(var i = 0, j = selectedDoctor.length; i < j; i++)
			selectedDoctorHtml += "<a href='javascript:void(0);' doctorCardNo='"+selectedDoctor[i].doctorCardNo+"'>"+selectedDoctor[i].doctorName+"</a>";
	$("#"+this.formId+" div").html(selectedDoctorHtml);
	$("#"+this.formId+" div a").click(function() {
		_this.changeDoctor($(this).text(), $(this).attr("doctorCardNo"), callBack);
	});
}

Searcher.prototype.changeDoctor = function(doctorName, doctorCardNo, callBack) {
	if (!doctorName) doctorName = "选择医生";
	if (!doctorCardNo) doctorCardNo = "";
	$("#doctorName").val(doctorName).attr("title", doctorName);
	$("#_doctorName").val(doctorName);
	$("#doctorCardNo").val(doctorCardNo);
	$("#"+this.formId).dialog("close");
	if (callBack) callBack(doctorCardNo);
}

Searcher.prototype.init = function(options) {
	
	var html = '';
	
	html += '选择医院：<input type="button" class="btns" id="hospitalName" value="选择医院" /> ';
	html += '<input type="hidden" id="hospitalNo" name="'+options.hospitalValueName+'" value="" /><input type="hidden" id="_hospitalName" name="hospital_name" value="" />';
	
	if (!this.hospital)
		html = "<span style='display:none;'>"+html+"</span>";
	
	if (this.hospitalDept) {
		html += '选择科室：<input type="button" class="btns" id="hospitalDeptName" value="选择科室" /> ';
		html += '<input type="hidden" id="hospitalDeptId" name="'+options.deptValueName+'" value="" /><input type="hidden" id="_hospitalDeptName" name="hospital_dept_name" value="" />';
	}
	
	if (this.doctor) {
		html += '选择医生：<input type="button" class="btns" id="doctorName" value="选择医生" /> ';
		html += '<input type="hidden" id="doctorCardNo" name="'+options.doctorValueName+'" value="" /><input type="hidden" id="_doctorName" name="doctor_name" value="" />';
	}
	
	this.container.prepend(html);
	
	var _this = this;
	
	//搜索医院
	$("#hospitalName").click(function() {
		var html = "医院名：<input type='text' name='_hospitalName' /> <input type='submit' value='查找' />(以空格分隔多个条件，ESC取消)";
		html += " <input type='button' value='取消选择' /><div></div>";
		_this.form.unbind("submit").dialog({modal: false, width: 600}).html(html)
			.submit(function() {
				var hospitalName = _this.form.find("input[name=_hospitalName]").val();
				var url = HOST+"/admin.php?c=searcher-getHospitalByName&t="+new Date().getTime();
				$.post(url, {hospitalName:hospitalName}, function(data) {
					_this.hospitalCache = $.parseJSON(data);
					_this.initChangeHospital(_this.hospitalCache, options.changeHospitalCallBack);
				});
				return false;
			});
		_this.form.find("input[type=button]").click(function() {_this.changeHospital();});
		var selectedHospital = _this.hospitalCache ? _this.hospitalCache : $.parseJSON($.cookie(_this.hospitalCookieName));
		_this.initChangeHospital(selectedHospital, options.changeHospitalCallBack);
		_this.form.dialog("open");
		_this.form.find("input[name=_hospitalName]").focus();
	});
	
	//搜索科室
	if (this.hospitalDept) {
		$("#hospitalDeptName").click(function() {
			var html = "科室名：<input type='text' name='_hospitalDeptName' /> <input type='submit' value='查找' />(以空格分隔多个条件，ESC取消)";
			html += " <input type='button' value='取消选择' /><div></div>";
			_this.form.unbind("submit").dialog({modal: false, width: 600}).html(html)
				.submit(function() {
					var hospitalDeptName = _this.form.find("input[name=_hospitalDeptName]").val();
					var url = HOST+"/admin.php?c=searcher-getHospitalDeptByName&t="+new Date().getTime();
					var postData = {hospitalNo:$("#hospitalNo").val(), hospitalDeptName:hospitalDeptName};
					$.post(url, postData, function(data) {
						_this.hospitalDeptCache = $.parseJSON(data);
						_this.initChangeHospitalDept(_this.hospitalDeptCache, options.changeHospitalDeptCallBack);
					});
					return false;
				});
			_this.form.find("input[type=button]").click(function() {_this.changeHospitalDept();});
			var selectedHospitalDept = _this.hospitalDeptCache ? _this.hospitalDeptCache : $.parseJSON($.cookie(_this.hospitalDeptCookieName));
			if (selectedHospitalDept)
				_this.initChangeHospitalDept(selectedHospitalDept, options.changeHospitalDeptCallBack);
			else
				_this.form.submit();
			_this.form.dialog("open");
			_this.form.find("input[name=_hospitalDeptName]").focus();
		});
	}
	
	//搜索医生
	if (this.doctor) {
		$("#doctorName").click(function() {
			var html = "医生名：<input type='text' name='_doctorName' /> <input type='submit' value='查找' />(以空格分隔多个条件，ESC取消)";
			html += " <input type='button' value='取消选择' /><div></div>";
			_this.form.unbind("submit").dialog({modal: false, width: 600}).html(html)
				.submit(function() {
					var doctorName = _this.form.find("input[name=_doctorName]").val();
					var url = HOST+"/admin.php?c=searcher-getDoctorByName&t="+new Date().getTime();
					var postData = {hospitalNo:$("#hospitalNo").val(), hospitalDeptId:$("#hospitalDeptId").val(), doctorName:doctorName};
					$.post(url, postData, function(data) {
						_this.doctorCache = $.parseJSON(data);
						_this.initChangeDoctor(_this.doctorCache, options.changeDoctorCallBack);
					});
					return false;
				});
			_this.form.find("input[type=button]").click(function() {_this.changeDoctor();});
			var selectedDoctor = _this.doctorCache ? _this.doctorCache : $.parseJSON($.cookie(_this.doctorCookieName));
			if (selectedDoctor)
				_this.initChangeDoctor(selectedDoctor, options.changeDoctorCallBack);
			else
				_this.form.submit();
			_this.form.dialog("open");
			_this.form.find("input[name=_doctorName]").focus();
		});
	}
	
	var selected = false;
	if (options.hospitalNo) {
		var selectedHospital = _this.hospitalCache ? _this.hospitalCache : $.parseJSON($.cookie(this.hospitalCookieName));
		if (selectedHospital)
			for (var i = 0, j = selectedHospital.length; i < j; i++)
				if (selectedHospital[i] && selectedHospital[i].hospitalNo == options.hospitalNo) {
					_this.changeHospital(selectedHospital[i].hospitalName, selectedHospital[i].hospitalNo, true);
					selected = true;
				}
		if (selected == false) {
			$.get(HOST+"/admin.php?c=searcher-getHospitalById", {hospitalNo:options.hospitalNo}, function(res){
				eval("var data = "+res+";");
				if (data.hospitalName)
					_this.changeHospital(data.hospitalName, data.hospitalNo, true);
			});
		}
	}
	
	if (this.hospitalDept && options.hospitalDeptId) {
		selected = false;
		var selectedHospitalDept = _this.hospitalDeptCache ? _this.hospitalDeptCache : $.parseJSON($.cookie(this.hospitalDeptCookieName));
		if (selectedHospitalDept)
			for (var i = 0, j = selectedHospital.length; i < j; i++)
				if (selectedHospitalDept[i] && selectedHospitalDept[i].hospitalDeptId == options.hospitalDeptId) {
					_this.changeHospitalDept(selectedHospitalDept[i].hospitalDeptName, selectedHospitalDept[i].hospitalDeptId, true);
					selected = true;
				}
		if (selected == false) {
			$.get(HOST+"/admin.php?c=searcher-getHospitalDeptById", {hospitalDeptId:options.hospitalDeptId}, function(res){
				eval("var data = "+res+";");
				if (data.hospitalDeptName)
					_this.changeHospitalDept(data.hospitalDeptName, data.hospitalDeptId, true);
			});
		}
	}

	if (this.doctor && options.doctorCardNo) {
		selected = false;
		var selectedDoctor = _this.doctorCache ? _this.doctorCache : $.parseJSON($.cookie(this.doctorCookieName));
		if (selectedDoctor)
			for (var i = 0, j = selectedDoctor.length; i < j; i++)
				if (selectedDoctor[i] && selectedDoctor[i].doctorCardNo == options.doctorCardNo) {
					_this.changeDoctor(selectedDoctor[i].doctorName, selectedDoctor[i].doctorCardNo);
					selected = true;
				}
		if (selected == false) {
			$.get(HOST+"/admin.php?c=searcher-getDoctorById", {doctorCardNo:options.doctorCardNo}, function(res){
				eval("var data = "+res+";");
				if (data.doctorName)
					_this.changeDoctor(data.doctorName, data.doctorCardNo, true);
			});
		}
	}
}