<script type="text/javascript">
	$(function() {
		$('#add_submit').click(function() {
			$('#addNewsForm').submit();
		});
	});
</script>
<div class="span9">
	<div class="page-header">
		<h3>招聘信息管理</h3>
	</div>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>职位</th>
				<th>添加时间</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
		<?php
		if ($jobs == null) {
			echo '<tr><td colspan="3">暂无记录.</td></tr>';
		} else {
			foreach ( $jobs as $n ) {
				?>
			<tr>
				<td><?php echo $n->name ?></td>
				<td><?php echo $n->created ?></td>
				<td><a href="/admin/jobs/<?php echo $n->job_id ?>/edit">编辑</a>
					<?php if($n->job_id != 1) {?>| <a href="/admin/jobs/<?php echo $n->job_id ?>/delete">删除</a><?php } ?></td>
			</tr>
		<?php }}?>
		</tbody>
	</table>
	<div class="pagination pagination-centered">
		<?php echo $pager;?>
	</div>
</div>