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
			<input name="case_cat_id" value="<?php echo $cat->case_cat_id?>"
				type="hidden" />
			<div class="control-group">
				<label class="control-label" for="case_cat_name">类别</label>
				<div class="controls">
					<input name="case_cat_name" type="text" placeholder="请输入类别名称"
						value="<?php echo $cat->case_cat_name;?>" />
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="case_cat_order">显示排序</label>
				<div class="controls">
					<input name="case_cat_order" type="text" placeholder="请输入类别显示顺序"
						value="<?php echo $cat->case_cat_order;?>" />
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label" for="news_img">案例图片</label>
				<div class="controls">
					<div id="showimg"><?php if(!is_null($cat->case_cat_pics)) { echo '<img src="/upload/cases/' . $cat->case_cat_pics . '" />'; }?></div>
					<div class="img_upload">
						<span>添加附件</span><input id="fileupload" type="file" name="mypic" />
						<input name="case_cat_pics" id="case_cat_pics" type="hidden" value="<?php if(isset($cat->case_cat_pics)) { echo $cat->case_cat_pics; } ?>" />
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

					var news_img = $("#case_cat_pics");
					$("#fileupload").wrap("<form id='myupload' action='/admin/casecat/img/upload' method='post' enctype='multipart/form-data'  style='display: inline;'></form>");
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
								var img = "/upload/cases/"+data.pic;
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
	    name: 'case_cat_name',
	    display: '名称',
	    rules: 'required'
	}, {
	    name: 'case_cat_order',
	    display: '顺序',
	    rules: 'integer'
	}], function(errors, event) {
	    if (errors.length > 0) {
	        // Show the errors
	    	var errorString = '<ul>';
	        
	        for (var i = 0, errorLength = errors.length; i < errorLength; i++) {
	            errorString = errorString + '<li>' + errors[i].message + '</li>';
	        }
	        errorString = errorString + '</ul>';
	        
	        $('#msg').html(errorString).show();
	    }
	}).setMessage('required', '%s 不能为空.');
</script>
