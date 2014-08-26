<script type="text/javascript">
	$(function() {
		$('#add_submit').click(function() {
			$('#addNewsForm').submit();
		});
	});
</script>
<div class="span9">
	<div class="page-header">
		<h3>用户管理</h3>
	</div>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>用户名</th>
				<th>注册时间</th>
				<th>用户角色</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($users as $usr) {?>
			<tr>
				<td><?php echo $usr->username ?></td>
				<td><?php echo $usr->created ?></td>
				<td><?php echo $usr->roles[0]->role_name ?></td>
				<td><a href="/users/<?php echo $usr->id ?>/edit">编辑</a> | <a href="/users/<?php echo $usr->id ?>/delete">删除</a></td>
			</tr>
		<?php }?>
		</tbody>
	</table>
	<div class="pagination pagination-centered">
		<?php echo $pager;?>
	</div>
</div>
