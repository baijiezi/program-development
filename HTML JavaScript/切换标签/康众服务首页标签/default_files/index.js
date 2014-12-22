//验证header.tpl 和 用户中心和 的登陆表单表单 
function formIsEmpty(){
	if($("#user_name").val()=="卡号/会员名"  || $("#user_name").val().replace(/\s/g,"")=="" ||$("#user_name").val()=="阳光医疗卡/康众卡/会员名"){
		alert("用户名不能为空");
		return false;
	}
	if($("#password").val().replace(/\s/g,"")==""){
		alert("密码不能为空");
		return false;
	}
	if($("#code").val().replace(/\s/g,"")==""){
		alert("验证码格式错误");
		return false;
	}
	return true;
}

//验证bookinLogin.tpl 的登录表单
function formIsEmptyforBooking(){
	if($("ul #user_name").val()=="卡号/手机号/会员名"  || $("ul #user_name").val().replace(/\s/g,"")=="" ){
		alert("用户名不能为空");
		return false;
	}
	if($("ul #password").val().replace(/\s/g,"")==""){
		alert("密码不能为空");
		return false;
	}
	if($("ul #code").val().replace(/\s/g,"")==""){
		alert("验证码格式错误");
		return false;
	}
	return true;
}
function nTabs(thisObj,Num)
{
	$(thisObj).parent().find("a").attr("className","");
	$(thisObj).find("a").attr("className","current");

	var tabObj = $(thisObj).parent().attr("id");
	$("." + tabObj+"_Content").hide();
	$("#" +tabObj+"_Content"+Num).show();
}

function nTabs01(thisObj,Num)
{
	$(thisObj).parent().find("a").attr("className","");
	$(thisObj).find("a").attr("className","current");

	var tabObj = $(thisObj).parent().attr("id");
	$("." + tabObj+"_Content").hide();
	$("#" +tabObj+"_Content"+Num).show();
}

function showhtml(id)
{
	$("#addid").prepend("<input type='hidden' name='doctorid' id='doctorid' value='"+id+"' />"); 
	$("#myTab2_Content1").css("display","none");
	$("#dd").css("display","block");
}
function hidewindow()
 {
	$("#myTab2_Content1").css("display","block");
	$("#dd").css("display","none");
}
function doAsk()
{	
	var doctorid = $("#doctorid").val();
	var mid = 1;
	var title = $("#title").val();
	if (title == "" || title=="最多可输入35个字")
	{
		alert("请填写咨询标题");
		$("#title").focus();
		return;
	}

	var disease = $("#disease").val();
	if (disease == "" || disease=="最多可输入35个字")
	{
		alert("请填写所患疾病");
		$("#disease").focus();
		return;
	}
	
	var content = $("#content").val();
	if (content == "" || content=="病情描述（主要症状、发病时间）：\n曾经治疗情况和效果：\n想得到怎样的帮助：\n化验、检查结果：\n最后一次就诊的医院：")
	{
		alert("请填写咨询内容");
		$("#content").focus();
		return;
	}
	
	$.ajax({
		type: "POST",
		url: "/include/memberAsk.php?t="+ Math.random(),
		data: "act=ask&title=" + title + "&disease=" +disease+ "&content=" + content + "&mid="+mid + "&doctorid="+doctorid,
		dataType: "html",
		async: false,
		success: function(html){
			if (parseInt(html) > 0)
			{
				alert("发表成功");
				$("#myTab2_Content1").css("display","block");
				$("#dd").css("display","none");
			}
		}
	}); 
}
function textareaonbule()
{
	var content = $("#content").val();
	if (content=="病情描述（主要症状、发病时间）：\n曾经治疗情况和效果：\n想得到怎样的帮助：\n化验、检查结果：\n最后一次就诊的医院：")
	{
		document.getElementById('content').value='';
	}
}
function textareaonsq()
{
	var content=document.getElementById("content").value;
	if(content==''||content==' '||content=='  '||content=='   ')
	{
		document.getElementById('content').value="病情描述（主要症状、发病时间）：\n曾经治疗情况和效果：\n想得到怎样的帮助：\n化验、检查结果：\n最后一次就诊的医院：";
	}
}
function titleonbule()
{
	var title = $("#title").val();
	if (title=="最多可输入35个字")
	{
		document.getElementById('title').value='';
	}
	
}
function titleonsq()
{
	var title=document.getElementById("title").value;
	if(title==''||title==' '||title=='  '||title=='   ')
	{
		document.getElementById('title').value='最多可输入35个字';
	}
}
function diseaseonbule()
{
	var disease = $("#disease").val();
	if (disease=="最多可输入35个字")
	{
		document.getElementById('disease').value='';
	}
	
}
function diseaseonsq()
{
	var disease=document.getElementById("disease").value;
	if(disease==''||disease==' '||disease=='  '||disease=='   ')
	{
		document.getElementById('disease').value='最多可输入35个字';
	}
}


