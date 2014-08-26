<script type="text/javascript">
	$(function() {
		$('#add_submit').click(function() {
			$('#addNewsForm').submit();
		});
	});
</script>
<div class="span9">
	<div class="page-header">
		<h3>案例管理</h3>
	</div>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>标题</th>
				<th>排序</th>
				<th>添加时间</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
		<?php
		if ($casecats == null) {
			echo '<tr><td colspan="3">暂无记录.</td></tr>';
		} else {
			foreach ( $casecats as $n ) {
				?>
			<tr>
				<td><a href="/admin/casecat/<?php echo $n->case_cat_id ?>/edit"><?php echo $n->case_cat_name ?></a></td>
				<td><?php echo $n->case_cat_order ?></td>
				<td><?php echo $n->created ?></td>
				<td><a href="/admin/casecat/<?php echo $n->case_cat_id ?>/edit">编辑</a>
					| <a href="/admin/casecat/<?php echo $n->case_cat_id ?>/delete">删除</a></td>
			</tr>
		<?php }}?>
		</tbody>
	</table>
	<div class="pagination pagination-centered">
		<?php echo $pager;?>
	</div>
</div>