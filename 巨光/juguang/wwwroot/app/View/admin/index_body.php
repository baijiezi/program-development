<script type="text/javascript">
	$(function() {
		$('#add_submit').click(function() {
			$('#addProductForm').submit();
		});
	});
</script>
<div class="span9">
	<div class="hero-unit">
		<div id="msg" class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Warning!</strong>${msg}
		</div>
		<h3>添加商品</h3>
		<form:form id="addProductForm" method="post" modelAttribute="product"
			class="form-horizontal">
			<div class="control-group">
				<label class="control-label" for="prod_type">产品类型</label>
				<div class="controls">
					<form:select path="prod_type">
						<option value="50008881">文胸</option>
						<option value="50008882">内裤</option>
						<option value="50011123">衬衫</option>
					</form:select>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="prod_src">产品来源</label>
				<div class="controls">
					<form:select path="prod_src">
						<option value="vancl">凡客</option>
						<option value="taobao">淘宝</option>
					</form:select>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for=prod_id>产品ID</label>
				<div class="controls">
					<form:input path="prod_id" type="text" placeholder="请输入产品ID" />
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="prod_cat">产品在店铺类型</label>
				<div class="controls">
					<label class="checkbox inline"> <form:checkbox path="prod_cat_1" value="642653098" /> 文胸
					</label> <label class="checkbox inline"> <form:checkbox path="prod_cat_2" value="646906584" /> 内裤
					</label> <label class="checkbox inline"> <form:checkbox path="prod_cat_3" value="642653099" /> 衬衫
					</label>
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<a id="add_submit" class="btn btn-primary btn-large">添加</a>
				</div>
			</div>
		</form:form>
	</div>
</div>