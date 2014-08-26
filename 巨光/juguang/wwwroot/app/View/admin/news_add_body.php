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
		<h3>添加企业动态</h3>
		<form id="addNewsForm" name="addNewsForm" method="post"
			class="form-horizontal" action="<?php echo $form_action?>">
			<input name="_method" value="<?php echo $_method?>" type="hidden" />
			<input name="news_id" value="<?php echo $news->news_id?>"
				type="hidden" />
			<div class="control-group">
				<label class="control-label" for="title">标题</label>
				<div class="controls">
					<input name="title" type="text" placeholder="请输入标题"
						value="<?php echo $news->title;?>" />
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="news_content">内容</label>
				<div class="controls">
					<textarea id="news_content" class="ckeditor" name="news_content"><?php echo $news->content;?></textarea>
				</div>
			</div>
			<script type="text/javascript">
			<!--
				CKEDITOR.replace( 'news_content', {
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
	    name: 'title',
	    display: '标题',    
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
