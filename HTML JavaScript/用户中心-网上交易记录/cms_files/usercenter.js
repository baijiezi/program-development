function setCurrentPage(code)
{
	var nav = new Array();
	nav[101] = "账户基本信息";
	nav[102] = "账户充值";
	nav[103] = "余额查询";
	nav[104] = "网上充值记录";
	nav[105] = "网上消费记录";
	nav[106] = "绑定手机";	
	nav[107] = "修改阳光医疗卡密码";	
	
	nav[201] = '预约挂号记录';
	
	nav[301] = '我的健康档案';
	nav[302] = '代办诊疗卡';
	nav[303] = '代取检查报告';
	
	nav[401] = '我的订单';
	nav[402] = '收货地址';
	
	nav[501] = '个人基本信息';
	nav[502] = '修改网站登陆密码';
	/*
	$(".userbox_left").find("li").attr("className", "m_le8");
	$(".userbox_left").find("li").css("font-weight","");
	$(".userbox_left").find("li").find("a").attr("className", "blue4");
	
	$("#nav").html(nav[code]);
	$("#s"+code).attr("className", "");
	$("#s"+code).css("font-weight","bold");
	$("#s"+code).find("a").attr("className", "user_red user_tb");
	*/
}

function redirect(url)
{
	window.top.location.href = url;
}

function rsc(obj)
{
	//$("#uframe").attr("height",obj.contentDocument.height + 10);
	//alert(obj.contentDocument.height);	
}