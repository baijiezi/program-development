<script src="../../../vendor/ckeditor/ckeditor.js"></script>
<script
	src="<?php echo JS_BASE_PATH_ADMIN ?>/jquery.form.js"></script>
<script
	src="<?php echo JS_BASE_PATH_ADMIN ?>/validate.min.js"></script>
<div class="span9">
	<div class="hero-unit">
		<div id="msg" class="alert alert-error" style="display: none;">
			<!-- <button type="button" class="close" data-dismiss="alert">&times;</button> -->
		</div>
		<h3>添加产品</h3>
		<form id="addNewsForm" name="addNewsForm" method="post"
			class="form-horizontal" action="<?php echo $form_action?>">
			<input name="_method" value="<?php echo $_method?>" type="hidden" />
			<input name="product_id" value="<?php echo $product->product_id?>"
				type="hidden" />
			<div class="control-group">
				<label class="control-label" for="name">产品名称</label>
				<div class="controls">
					<input name="name" type="text" placeholder="请输入产品名称"
						value="<?php echo $product->name;?>" />
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="news_img">产品主图</label>
				<div class="controls">
					<div id="showimg"><?php if(!is_null($product->pic)) { echo '<img src="/upload/products/' . $product->pic . '" />'; }?></div>
					<div class="img_upload">
						<span>添加主图</span><input id="fileupload" type="file" name="mypic" />
						<input name="product_pic" id="product_pic" type="hidden" value="<?php if(isset($product->pic)) { echo $product->pic; } ?>" />
					</div>
					<div class="progress">
						<span class="bar"></span><span class="percent">0%</span>
					</div>
					<div class="files"></div>
				</div>
			</div>
			<script type="text/javascript">
				$(function () {
					var bar = $('.bar');
					var percent = $('.percent');
					var showimg = $('#showimg');
					var progress = $(".progress");
					var files = $(".files");
					var btn = $(".img_upload span");

					var news_img = $("#product_pic");
					$("#fileupload").wrap("<form id='myupload' action='/admin/products/img/upload' method='post' enctype='multipart/form-data'  style='display: inline;'></form>");
				    $("#fileupload").change(function(){
						$("#myupload").ajaxSubmit({
							dataType:  'json',
							beforeSend: function() {
				        		showimg.empty();
								progress.show();
				        		var percentVal = '0%';
				        		bar.width(percentVal);
				        		percent.html(percentVal);
								btn.html("上传中...");
				    		},
				    		uploadProgress: function(event, position, total, percentComplete) {
				        		var percentVal = percentComplete + '%';
				        		bar.width(percentVal)
				        		percent.html(percentVal);
				    		},
							/*complete: function(xhr) {
								$(".files").html(xhr.responseText);
							},*/
							success: function(data) {
								files.html("<b>"+data.name+"("+data.size+"k)</b> <span class='delimg' rel='"+data.pic+"'>删除</span>");
								var img = "/upload/products/"+data.pic;
								showimg.html("<img src='"+img+"'>");
								btn.html("添加附件");
								news_img.val(data.pic);
							},
							error:function(xhr){
								btn.html("上传失败");
								bar.width('0')
								files.html(xhr.responseText);
							}
						});
					});

					$(".delimg").live('click',function(){
						var pic = $(this).attr("rel");
						$.post("action.php?act=delimg",{imagename:pic},function(msg){
							if(msg==1){
								files.html("删除成功.");
								showimg.empty();
								progress.hide();
							}else{
								alert(msg);
							}
						});
					});
				});
			</script>
			<div class="control-group">
				<label class="control-label" for="description">产品描述</label>
				<div class="controls">
					<textarea id="description" class="ckeditor" name="description"><?php echo $product->description;?></textarea>
				</div>
			</div>
			<script type="text/javascript">
			<!--
				CKEDITOR.replace( 'description', {
					// 将编辑品语言设置为中文
					language: 'zh-cn',
					customConfig : '<?php echo CKEDITOR_PATH ?>/config.js',
					toolbar :  'BasicToolbar',
					width: '90%',
					fullPage: false,
					allowedContent: true,
					filebrowserBrowseUrl : '<?php echo CKFINDER_PATH ?>/ckfinder.html',
					filebrowserImageBrowseUrl : '<?php echo CKFINDER_PATH ?>/ckfinder.html?Type=Images',
					filebrowserUploadUrl : '<?php echo CKFINDER_PATH ?>/core/connector/php/connector.php?command=QuickUpload&type=Files',
					filebrowserImageUploadUrl : '<?php echo CKFINDER_PATH ?>/core/connector/php/connector.php?command=QuickUpload&type=Images'
				});
			//-->
			</script>
			<div class="control-group">
				<div class="controls">
					<button type="submit" name="submit"
						class="btn btn-primary btn-large">添加</button>
				</div>
			</div>
		</form>
	</div>
</div>
<script type="text/javascript">
	new FormValidator('addNewsForm', [{
	    name: 'name',
	    display: '产品名称',    
	    rules: 'required'
	}], function(errors, event) {
	    if (errors.length > 0) {
	        // Show the errors
	    	var errorString = '<ul>';
	        
	        for (var i = 0, errorLength = errors.length; i < errorLength; i++) {
	            errorString = errorString + '<li>' + errors[i].message + '</li>';
	        }
	        errorString = errorString + '</ul>';
	        
	        // el.innerHTML = errorString;
	        $('#msg').html(errorString).show();
	        // alert($('#news_content').html());
	    }
	}).setMessage('required', '%s 不能为空.');
</script>
