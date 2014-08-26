<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="robots" content="all" />
<meta name="keywords" content="巨光,广州巨光,显示屏租赁,LED显示屏,LED显示屏租赁,LED灯" />
<meta name="description" content="巨光,广州巨光,显示屏租赁,LED显示屏,LED显示屏租赁,LED灯" />
<meta name="Identifier-URL" content="http://baijiezi.github.io/juguang" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>广州巨光视听</title>
<link rel="stylesheet" href="style/reset.css" type="text/css" charset="utf-8" />
<link rel="stylesheet" href="style/main.css" type="text/css" charset="utf-8" />

<style type="text/css" media="screen">
    span{overflow:hidden;font-size:0;line-height:0;}
    .shutter{position:relative;overflow:hidden;left:0;height:318px;width:960px;}
    .shutter li{position:relative;left:0;top:0;}
    ul,li{list-style:none;margin:0;padding:0}
    img{display:block;border:none;}
    .shutter-nav{display:inline-block;margin-right:8px;color:#fff;padding:2px 6px;background:#333;border:1px solid #fff;font-family:Tahoma;font-weight:bold;font-size:12px;cursor:pointer;}
    .shutter-cur-nav{display:inline-block;margin-right:8px;color:#fff;padding:2px 6px;background:#ff7a00;border:1px solid #fff;font-family:Tahoma;font-weight:bold;font-size:12px;cursor:pointer;}

</style>

<script type="text/javascript">
<!--
var Hongru={};
function H$(id){return document.getElementById(id)}
function H$$(c,p){return p.getElementsByTagName(c)}
Hongru.shutter = function(){
	function init(anchor,options){this.anchor=anchor; this.init(options);}
	init.prototype = {
		init:function(options){ //options参数：id（必选）：图片列表父标签id；auto（可选）：自动运行时间；index（可选）：开始的运行的图片序号
			var wp = H$(options.id), //获取图片列表父元素
			ul = H$$('ul',wp)[0], //获取
			li = this.li = H$$('li',ul);
			this.a = options.auto?options.auto:4; //自动运行间隔
			this.index = options.position?options.position:0; //开始运行的图片序号（从0开始）
			this.l = li.length;
			this.cur = 0; //当前显示的图片序号&&z-index变量
			this.stN = options.shutterNum?options.shutterNum:5;
			this.dir = options.shutterDir?options.shutterDir:'H';
			this.W = wp.offsetWidth;
			this.H = wp.offsetHeight;
			this.aw = 0;
			this.mask = [];
			this.nav = [];
			ul.style.display = 'none';
			var container = this.container = document.createElement('div'),
				con_a = this._a = document.createElement('a');
			con_a.target = '_blank';
			container.style.cssText = con_a.style.cssText = 'position:absolute;width:'+this.W+'px;height:'+this.H+'px;left:0;top:0';
			container.appendChild(con_a);
			for (var x=0; x<this.stN; x++) {
				var mask = document.createElement('span');
				mask.style.cssText = this.dir == 'H'?'position:absolute;width:'+this.W/this.stN+'px;height:'+this.H+'px;left:'+x*this.W/this.stN+'px;top:0' : 'position:absolute;width:'+this.W+'px;height:'+this.H/this.stN+'px;left:0px;top:'+x*this.H/this.stN+'px';
				this.mask.push(mask);
				con_a.appendChild(mask);
			}
			wp.appendChild(container);
			this.nav_wp = document.createElement('div'); //先建一个div作为控制器父标签，你也可以用<ul>或<ol>来做，语义可能会更好，这里我就不改了
			this.nav_wp.style.cssText = 'position:absolute;right:0;bottom:0;padding:8px 0;'; //为它设置样式
			for(var i=0;i<this.l;i++){
				/* == 绘制控制器 == */
				var nav = document.createElement('a'); //这里我就直接用a标签来做控制器，考虑语义的话你也可以用li
				nav.className = options.navClass?options.navClass:'shutter-nav'; //控制器class，默认为shutter-nav
				this.nav.push[nav];
				nav.innerHTML = i+1;
				nav.onclick = new Function(this.anchor+'.pos('+i+')'); //绑定onclick事件，直接调用之前写好的pos()函数
				this.nav_wp.appendChild(nav);
			}
			wp.appendChild(this.nav_wp);
			this.curC = options.curNavClass?options.curNavClass:'shutter-cur-nav';
			this.pos(this.index); //变换函数
		},
		auto:function(){
			this.li.a = setInterval(new Function(this.anchor+'.move(1)'),this.a*1000); 
		},
		move:function(i){//参数i有两种选择：1和-1，1代表运行到下一张，-1代表运行到上一张
			var n = this.cur+i; 
			var m = i==1?n==this.l?0:n:n<0?this.l-1:n; //下一张或上一张的序号（注意三元选择符的运用）
			this.pos(m); //变换到上一张或下一张
		},
		pos:function(i){
			clearInterval(this.li.a);
			clearInterval(this.li[i].a);
			this.aw = this.dir == 'H'?this.W/this.stN : this.H/this.stN;
			var src = H$$('img',this.li[i])[0].src;
			var _n = i+1>=this.l?0:i+1;
			var src_n = H$$('img',this.li[_n])[0].src;
			this.container.style.backgroundImage = 'url('+src_n+')';
			for(var n=0;n<this.stN;n++){
				this.mask[n].style.cssText = this.dir == 'H'?'position:absolute;width:'+this.W/this.stN+'px;height:'+this.H+'px;left:'+n*this.W/this.stN+'px;top:0' : 'position:absolute;width:'+this.W+'px;height:'+this.H/this.stN+'px;left:0px;top:'+n*this.H/this.stN+'px';
				this.mask[n].style.background = this.dir == 'H' ? 'url('+src+') no-repeat -'+n*this.W/this.stN+'px 0' : 'url('+src+') no-repeat 0 -'+n*this.H/this.stN+'px';
			}
			this.cur = i; //绑定当前显示图片的正确序号
			this.li.a = false;
			for(var x=0;x<this.l;x++){
				H$$('a',this.nav_wp)[x].className = x==i?this.curC:'shutter-nav'; //绑定当前控制器样式
				}
			this._a.href = H$$('a',this.li[i])[0].href;
			//this.auto(); //自动运行
			this.li[i].a = setInterval(new Function(this.anchor+'.anim('+i+')'), 4*this.stN);
		},
		anim: function (i) {
		var tt = this.dir == 'H' ? parseInt(this.mask[this.stN-1].style.width) : parseInt(this.mask[this.stN-1].style.height);
			if(tt<=5){
				clearInterval(this.li[i].a);
				for(var n=0;n<this.stN;n++){
					this.dir == 'H' ? this.mask[n].style.width = 0 : this.mask[n].style.height = 0;
				}
				if(!this.li.a) {this.auto()}
			}else {
				for(var n=0;n<this.stN;n++){
					this.aw -= 1;
					this.dir == 'H' ? this.mask[n].style.width = this.aw + 'px' : this.mask[n].style.height = this.aw + 'px';
				}
			}
		}
	}
	return {init:init}
}();
//-->
</script>
<script type="text/javascript" charset="utf-8" src="scripts/jquery-1.4.2.min.js"></script>

</head>

<body>

<div id="page">
    <div id="header">
        <div id="body_banner"></div>
        <div id="menu">
            <div class="menu_left"></div>
            <ul class="menu_content">
                <li><a href="index.php">首页</a></li>
                <li><a href="about.php">关于巨光</a></li>
                <li><a href="news.php">最新动态</a></li>
                <li><a href="cases.php">成功案例</a></li>
                <li><a href="products.php">租赁设备</a></li>
                <li><a href="jobs.php">诚聘英才</a></li>
                <li><a href="contectUs.php">联系我们</a></li>
            </ul>
            <div class="menu_right"></div>
            <div class="clear"></div>
        </div>
        
        <div id="shutter" class="shutter">
            <ul>
                <li><a href="#" target="_blank"><img  src="images/banner_11.png"></a></li>
                <li><a href="#" target="_blank"><img  src="images/banner_12.png"></a></li>
                <li><a href="#" target="_blank"><img  src="images/banner_13.png"></a></li>

            </ul>
        </div>
    </div>
    <div class="content_body">
        <div class="sidebar">
            <div class="left_title"><h4>&nbsp;&nbsp;&nbsp;&nbsp;成功案例</h4></div>  
            <div class="left_list" >-&nbsp;&nbsp;<a href="caseDetail.php?photo=show_2013韦德中国行广州球迷见面会.png" title="2013韦德中国行广州球迷见面会">2013韦德中国行广州球迷见面会</a></div>  
        	<div class="left_list" >-&nbsp;&nbsp;<a href="caseDetail.php?photo=show_澳门雅培年会.png" title="澳门雅培年会">澳门雅培年会</a></div>
            <div class="left_list"  >-&nbsp;&nbsp;<a href="caseDetail.php?photo=show_百威张敬轩歌友会.png" title="百威张敬轩歌友会">百威张敬轩歌友会</a></div>
            <div class="left_list"  >-&nbsp;&nbsp;<a href="caseDetail.php?photo=show_广东省食品药品检验所50周年.png" title="广东省食品药品检验所50周年">广东省食品药品检验所50周年</a></div>
            <div class="left_list"  >-&nbsp;&nbsp;<a href="caseDetail.php?photo=show_广铝集团中秋晚会.png" title="广铝集团中秋晚会">广铝集团中秋晚会</a></div>
        </div>
        <div class="case_main">
            <div class="content_title title_style">公司简介</div>
            <div class="content">
                <div class="about_content">
                    &nbsp;&nbsp;&nbsp;&nbsp;广州市巨光视听设备有限公司是一家专业为演出、会议、展览等活动提供室内外LED显示屏、LED彩屏、灯光、音响及其它特效设备和技术服务的AV设备公司。公司凭借一支富有创造力和开拓精神的优秀团队及自身一流的专业技术和顶级的品牌设备，通过不断努力的发展已在全国很多重要城市拥有战略合作伙伴，建立了办事机构。以最先进、最便利、最快捷的视频演示技术和严谨的工作态度，成功地为国内外许多知名大型企业、政府机构、电视台、展览公式、广告公司、酒店、会务公司及报社网站等媒体提供专业服务，并与其保持长久的合作关系。公司在多年的服务历程中，不断提升自身的技术优势及服务质量，以独特的构思与丰富的想象力为客户营造良好的视听空，公司注重细节的把握，为您所想，做好我们所做的每一个环节，致力于为客户打造完美的企业形象！
                    <div style="font-size: 20px; font-weight: bold; text-align: center; margin-top: 40px;">我们的宗旨：“认真、负责、合作、共赢”</div>
                    <div style="font-size: 16px; font-weight: bold; margin-bottom: 10px;">我们的客户：</div>
                    <div class="clients">
                   	 	<img src="uploadfile/logo_19.png" width="151px" />
                        <img src="uploadfile/logo_11.png" width="151px" />
                        <img src="uploadfile/logo_12.png" width="151px" />
                        <img src="uploadfile/logo_13.png" width="151px" />
                        <img src="uploadfile/logo_14.png" width="151px" />
                        <img src="uploadfile/logo_15.png" width="151px" />
                        <img src="uploadfile/logo_16.png" width="151px" />
                        <img src="uploadfile/logo_17.png" width="151px" />
                        <img src="uploadfile/logo_18.png" width="151px" />
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div id="footer">
        <div class="copyright">
            <p>版权所有(C) 广州市巨光视听设备有限公司 &nbsp;&nbsp;&nbsp;&nbsp;技术支持：MG Technology Studio &nbsp;&nbsp;&nbsp;&nbsp; 地址：广州市白云区东基四巷23号之二</p>
        </div>
    </div>

</div>

<script type="text/javascript">
<!--
var shutterH = new Hongru.shutter.init('shutterH',{
	id:'shutter'
});

//-->
</script>
</body>
</html>
