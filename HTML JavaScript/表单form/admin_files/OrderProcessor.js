var processes = {
	"0020203006": {
		confirm: {
			maxStep: 2,
			validator: {is_clinic_today:1},
			run: function(_this) {
				
				if (_this.selectedCount > 1) {
					alert("每次只允许一个订单进行确认操作");
					return false;
				}
				
				var html = "请填写号球：<input type='text' id='orderNum' />";
				$("#msgBox").html(html);
				
				$("#msgBox").dialog("option", {buttons:{
					"确定":function() {
						_this.data["orderNum"] = $("#orderNum").val();
						_this.step++;
						_this.submit();
					}
				}});
			}
		}
	},
	"0020201001": {
		confirm: {
			maxStep: 2,
			//省口腔需要复诊订单
			validator: {is_maiden: 2},
			run: function(_this) {
				
				if (_this.selectedCount > 1) {
					alert("每次只允许一个订单进行确认操作");
					return false;
				}
				
				$("#msgBox").dialog("option", {buttons:{
					"确定":function() {
						_this.data["kzCardNo"] = $("#kzCardNo").val();
						_this.data["kzPassword"] = $("#kzPassword").val();
						_this.step++;
						_this.submit();
					}
				}});
				var html = "<br/><div style='text-align:center'>卡号：<input type='text' id='kzCardNo' style='width:200px' /><br/>";
				html += "密码：<input type='password' id='kzPassword' style='width:200px' /></div>"
				$("#msgBox").html(html);
			}
		},
		signOn: {
			maxStep : 2,
			validator: {"@is_maiden": "IN (1,99)"},
			run: function(_this) {
				if (_this.selectedCount > 1) {
					alert("每次只允许一个订单进行签到操作");
					return false;
				}
				var orderNo = _this.orderNos[0];
				
				$("#msgBox").dialog("option", {buttons:{
					"确定":function() {
						var kzCardNo = $("#kzCardNo").val();
						var kzPassword = $("#kzPassword").val();
						var medicalCardNo = $("#medicalCardNo").val();
						_this.data["orderNos["+orderNo+"][kzCardNo]"] = kzCardNo;
						_this.data["orderNos["+orderNo+"][kzPassword]"] = kzPassword;
						_this.data["orderNos["+orderNo+"][medicalCardNo]"] = medicalCardNo;
						_this.step++;
						_this.submit();
					}
				}});
				$.ajax({
					url: HOST+PATHNAME+"?c="+ACTION+"-getSickPersonType",
					data: {hospitalNo:this.hospitalNo},
					dataType: "json",
					success: function(data) {
						var html = "请选择付费类型：<select name='reasonCode' id='reasonCode'>";
						if (data[0]) {
							for (var i = 0; i < data.length; i++) {
								html += "<option value='"+data[i].item[0].value+"'>"+data[i].item[1].value+"</option>";
							}
						} else {
							html += "<option value='"+data.item[0].value+"'>"+data.item[1].value+"</option>";
						}
						html += "</select> 是否是当天签到：<select name='isToday' id='isToday'>";
						html += "<option value='1'>是</option><option value='0'>否</option></select>";
						
						var kzCardNo = _this.data["orderNos["+orderNo+"][kzCardNo]"];
						var medicalCardNo = _this.data["orderNos["+orderNo+"][medicalCardNo]"];
						var bookingSubModel = _this.data["orderNos["+orderNo+"][bookingSubModel]"];
						var kzCardReadOnly = kzCardNo ? "readOnly" : "";
						var medicalCardReadOnly = medicalCardNo ? "readOnly" : "";	
						
						html += "<br/>诊疗卡卡号：<input type='text' id='medicalCardNo' value='"+medicalCardNo+"' "+medicalCardReadOnly+" />";
						html += "<br/>康众卡卡号：<input type='text' id='kzCardNo' value='"+kzCardNo+"' "+kzCardReadOnly+" />";
						
						if (bookingSubModel == "0")
							html += "<br/>康众卡密码：<input type='password' id='kzPassword' />";
						
						$("#msgBox").html(html);
					}
				});
			}
		}
	},
	"default": {
		signOn: {
			maxStep : 2,
			run: function(_this) {
		
				if (_this.selectedCount > 1) {
					alert("每次只允许一个订单进行签到操作");
					return false;
				}
				
				$("#msgBox").dialog("option", {buttons:{
					"确定":function(){
						_this.step++;
						_this.data["reasonCode"] = $("#reasonCode").val();
						_this.data["isToday"] = $("#isToday").val();
						_this.submit();
					}
				}});
				$.ajax({
					url: HOST+PATHNAME+"?c="+ACTION+"-getSickPersonType",
					data: {hospitalNo:this.hospitalNo},
					dataType: "json",
					success: function(data) {
						if (_this.orderNos[0].indexOf("PZ") === -1)
						{
							var html = "请选择付费类型：<select name='reasonCode' id='reasonCode'>";
							if (data[0]) {
								for (var i = 0; i < data.length; i++) {
									html += "<option value='"+data[i].item[0].value+"'>"+data[i].item[1].value+"</option>";
								}
							} else {
								html += "<option value='"+data.item[0].value+"'>"+data.item[1].value+"</option>";
							}
						}
						html += "</select><br/>是否是当天签到：<select name='isToday' id='isToday'>";
						html += "<option value='1'>是</option><option value='0'>否</option></select>";
						$("#msgBox").html(html);
					}
				});
			}
		},
		confirm: {
			maxStep: 2,
			validator: {is_clinic_today:1},
			run: function(_this) {
				if (_this.selectedCount > 1) {
					alert("每次只允许一个订单进行确认操作");
					return false;
				}
				
				var html = "请填写号球：<input type='text' id='orderNum' />";
				$("#msgBox").html(html);
				
				$("#msgBox").dialog("option", {buttons:{
					"确定":function() {
						_this.data["orderNum"] = $("#orderNum").val();
						_this.step++;
						_this.submit();
					}
				}});
			}
		},
		updateMedicalCard: {
			maxStep: 2,
			run: function(_this) {
				if (_this.selectedCount != 1 ) {
					alert("每次只允许一个订单进行更新诊疗卡操作");
					return false;
				}
				
				var orderNo = _this.orderNos[0];
				if(_this.data["orderNos["+orderNo+"][medicalCardNo]"])
				{
					alert("诊疗卡已经存在,不能重复更新!");
					return false;
				}
				
				var html = "请填写诊疗卡号：<input type='text' id='medicalForUpdate' />";
				$("#msgBox").html(html);
				
				$("#msgBox").dialog("option", {buttons:{
					"确定":function() {
						_this.data["medicalForUpdate"] = $("#medicalForUpdate").val();
						_this.step++;
						_this.submit();
					}
				}});
			}
		}
	}
};

function OrderProcessor(hospitalNo, data, operation, selectedCount, orderNos) {
	this.processes = processes["default"];
	if (processes[hospitalNo]) {
		//若存在医院特殊的操作,则进行继承
		this.processes = $.extend(this.processes, processes[hospitalNo]);
	}

	this.step = 1;
	this.maxStep = 1;
  
	this.url = HOST+PATHNAME+"?c="+ACTION+"-ajaxProcess";
	this.hospitalNo = hospitalNo;
	this.orderNos = orderNos;
	this.selectedCount = selectedCount;
	this.data = data;
	this.operation = operation;
	this.operationProcess = null;
	
	//加载特殊操作
	if (this.processes[operation]) {
		//检验订单是否符合使用特殊操作条件
		if (this.processes[operation].validator) {
			var _data = this.data;
			for (var key in this.processes[operation].validator) {
				_data["conds["+key+"]"] = this.processes[operation].validator[key];
			}
			var instance = this;
			$.ajax({
				url: HOST+"/default.php?c=api/APIOrderService-validateOrders",
				data: _data,
				type: "post",
				success: function(res) {
					if (res == "1") {
						if (instance.processes[operation].run) {
							instance.operationProcess = instance.processes[operation].run;
						}
						if (instance.processes[operation].maxStep) {
							instance.maxStep = instance.processes[operation].maxStep;
						}
						if (instance.processes[operation].success) {
							instance.success = instance.processes[operation].success;
						}
					}
					instance.process();
				}
			});
			return;
		}
		if (this.processes[operation].run) {
			this.operationProcess = this.processes[operation].run;
		}
		if (this.processes[operation].maxStep) {
			this.maxStep = this.processes[operation].maxStep;
		}
		if (this.processes[operation].success) {
			this.success = this.processes[operation].success;
		}
	}
	this.process();
}

OrderProcessor.prototype.process = function() {
	
	$("#msgBox").dialog({
		modal : true,
		width : 600,
		position : ["center", 100],
		closeOnEscape : false,
		close: function(event, ui) {$(this).html("");}
	}).dialog("open");
	
	if (this.operationProcess)
		if (this.operationProcess(this) === false)
			$("#msgBox").dialog("close");
	
	this.submit();
};

OrderProcessor.prototype.success = function(res) {
	
	var html = "";
	for(var i = 0; i < res.length; i++) {
		html += "处理订单"+res[i].orderNo+"结果："+res[i].msg+"<br/>";
	}
	if (res.error) html += res.error;
	
	if (html == "" && !res.error) {
		html = "操作成功！";
	}
	
	$("#msgBox").dialog("option", {buttons:{
		"确定":function(){
			window.location.reload();
		}
	}});
	
	$("#msgBox").html(html);
};

OrderProcessor.prototype.submit = function() {

	if (this.step != this.maxStep) return;
	
	var refresh = setTimeout(function(){
		window.location.reload();
	}, 60000);
	
	this.data['operation'] = this.operation;
	this.data['hospitalNo'] = this.hospitalNo;

	$("#msgBox").html("loading...");
	$.ajax({
		url : this.url,
		type : "post",
		data : this.data,
		dataType : "json",
		success : this.success
	});
};


function orderProcessorFactory() {
	var data = {};
	var selectedCount = 0;
	var hospitalNo = "";
	var multiHospital = false;
	var orderNos = new Array();
	
	$("#orderList input[name='id[]']:checked").each(function(i){
		var value = $(this).val();
		var _hospitalNo = $("#hospital_no_"+value).val();
		orderNos.push(value);
		data["orderNos["+value+"][hospitalNo]"] = _hospitalNo;
		data["orderNos["+value+"][kzCardNo]"] = $("#kz_card_no_"+value).val();
		data["orderNos["+value+"][medicalCardNo]"] = $("#medical_card_no_"+value).val();
		data["orderNos["+value+"][bookingSubModel]"] = $("#booking_sub_model_"+value).val();
		selectedCount++;
		if (hospitalNo.length > 0 && _hospitalNo != hospitalNo) {
			multiHospital = true;
		}
		hospitalNo = _hospitalNo;
	});
	
	if (multiHospital == true) {
		alert("每次只能处理同一医院的订单");
		return false;
	}
	
	var processor = new OrderProcessor(hospitalNo, data, $("#oper").val(), selectedCount, orderNos);
}