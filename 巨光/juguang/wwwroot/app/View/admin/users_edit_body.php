<script src="<?php echo JS_BASE_PATH_ADMIN ?>/validate.min.js"></script>
<div class="span9">
	<div class="hero-unit">
		<div id="msg" class="alert alert-error" style="display: none;">
			<!-- <button type="button" class="close" data-dismiss="alert">&times;</button> -->
		</div>
		<h3>
			<?php echo $text_title?>
		</h3>
		<form id="userForm" name="userForm" method="post"
			class="form-horizontal" action="<?php echo $form_action ?>">
			<input name="_method" value="<?php echo $_method ?>" type="hidden" />
			<input name="id" value="<?php echo $user->id?>" type="hidden" />
			<div class="control-group">
				<label class="control-label" for="username">用户名</label>
				<div class="controls">
					<input name="username" type="text"
						placeholder="<?php echo $user->username?>"
						value="<?php echo $user->username?>" />
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="password">密码</label>
				<div class="controls">
					<input name="password" type="text"
						placeholder="<?php echo $user->password?>"
						value="<?php echo $user->password?>" />
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for=role>用户角色</label>
				<div class="controls">
					<select name="role">
						<?php
						foreach ( $roles as $role ) {
							if ($role->id == $user->roles [0]->id) {
								echo '<option value="' . $role->id . '" selected="true">' . $role->role_name . '</option>';
							} else {
								echo '<option value="' . $role->id . '">' . $role->role_name . '</option>';
							}
						}
						?>
					</select>
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<button type="submit" name="submit"
						class="btn btn-primary btn-large">
						<?php echo $text_button?>
					</button>
				</div>
			</div>
		</form>
	</div>
</div>
<script type="text/javascript">
	new FormValidator('userForm', [{
	    name: 'username',
	    display: '用户名',    
	    rules: 'required'
	}, {
	    name: 'password',
	    display: '密码',
	    rules: 'required'
	}, {
	    name: 'role',
	    display: '用户角色',
	    rules: 'required'
	}, {
	    name: 'company',
	    display: '公司名',
	    rules: 'required'
	}, {
	    name: 'tel',
	    display: '电话',
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
	    }
	}).setMessage('required', '%s 不能为空.');
</script>
