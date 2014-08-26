<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>广州巨光</title>
<link rel="stylesheet" href="<?php echo CSS_BASE_PATH_ADMIN ?>/bootstrap.css"
	type="text/css" media="screen" charset="utf-8">
<link rel="stylesheet"
	href="<?php echo CSS_BASE_PATH_ADMIN ?>/bootstrap-responsive.css"
	type="text/css" media="screen" charset="utf-8">
<script src="<?php echo JS_BASE_PATH_ADMIN ?>/jquery.js"></script>
<script
	src="<?php echo JS_BASE_PATH_ADMIN ?>/jquery.form.js"></script>
<script
	src="<?php echo JS_BASE_PATH_ADMIN ?>/validate.min.js"></script>
<script type="text/javascript">
	$(function() {
		$('#loginBtn').click(function() {
			$('#loginForm').submit();
		});
		$('#resetBtn').click(function() {
			$('#username').val('');
			$('#password').val('');
		});
	});
</script>
</head>
<body>

	<div class="container-fluid">
		<div class="row-fluid">
			<div class="container">
				<div class="modal" style="width: 480px;">
					<div class="modal-header">
						<h3>广州巨光管理员登陆</h3>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" action="/admin/login/post" id="loginForm" method="POST">
							<div class="control-group">
								<label class="control-label" for="username">用户名</label>
								<div class="controls">
									<input type="text" name="username" id="username"
										placeholder="用户名">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="password">用户名</label>
								<div class="controls">
									<input type="password" name="password" id="password"
										placeholder="密码">
								</div>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<a href="#" id="resetBtn" class="btn">重填</a> <input type="button"
							id="loginBtn" class="btn btn-primary" value="登陆" />
					</div>
				</div>
				<div id="msg" class="alert alert-error" style="display: none;">
					<!-- <button type="button" class="close" data-dismiss="alert">&times;</button> -->
				</div>
			</div>
			<!-- /container -->
		</div>
	</div>

<script type="text/javascript">
	new FormValidator('loginForm', [{
	    name: 'username',
	    display: '用户名',    
	    rules: 'required'
	}, {
	    name: 'password',
	    display: '密码',    
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
	
	<!-- Le javascript
================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script type="text/javascript"
		src="<?php echo JS_BASE_PATH_ADMIN ?>/widgets.js" /></script>
	<script src="<?php echo JS_BASE_PATH_ADMIN ?>/bootstrap-transition.js" /></script>
	<script src="<?php echo JS_BASE_PATH_ADMIN ?>/bootstrap-alert.js" /></script>
	<script src="<?php echo JS_BASE_PATH_ADMIN ?>/bootstrap-modal.js" /></script>
	<script src="<?php echo JS_BASE_PATH_ADMIN ?>/bootstrap-dropdown.js" /></script>
	<script src="<?php echo JS_BASE_PATH_ADMIN ?>/bootstrap-scrollspy.js" /></script>
	<script src="<?php echo JS_BASE_PATH_ADMIN ?>/bootstrap-tab.js" /></script>
	<script src="<?php echo JS_BASE_PATH_ADMIN ?>/bootstrap-tooltip.js" /></script>
	<script src="<?php echo JS_BASE_PATH_ADMIN ?>/bootstrap-popover.js" /></script>
	<script src="<?php echo JS_BASE_PATH_ADMIN ?>/bootstrap-button.js" /></script>
	<script src="<?php echo JS_BASE_PATH_ADMIN ?>/bootstrap-collapse.js" /></script>
	<script src="<?php echo JS_BASE_PATH_ADMIN ?>/bootstrap-carousel.js" /></script>
	<script src="<?php echo JS_BASE_PATH_ADMIN ?>/bootstrap-typeahead.js" /></script>
	<script src="<?php echo JS_BASE_PATH_ADMIN ?>/bootstrap-affix.js" /></script>

	<script src="<?php echo JS_BASE_PATH_ADMIN ?>/holder/holder.js" /></script>
	<script
		src="<?php echo JS_BASE_PATH_ADMIN ?>/google-code-prettify/prettify.js" /></script>

	<script src="<?php echo JS_BASE_PATH_ADMIN ?>/application.js" /></script>
</body>
</html>
