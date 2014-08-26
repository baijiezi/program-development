<script type="text/javascript">
	$(function() {
		$('#add_submit').click(function() {
			$('#addNewsForm').submit();
		});
	});
</script>
<div class="span9">
	<div class="page-header">
		<h3>产品管理</h3>
	</div>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>标题</th>
				<th>添加时间</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
		<?php
		if ($products == null) {
			echo '<tr><td colspan="3">暂无记录.</td></tr>';
		} else {
			foreach ( $products as $n ) {
				?>
			<tr>
				<td><a href="/products/<?php echo $n->product_id ?>" target="_blank"><?php echo $n->name ?></a></td>
				<td><?php echo $n->created ?></td>
				<td><a href="/admin/products/<?php echo $n->product_id ?>/edit">编辑</a>
					| <a href="/admin/products/<?php echo $n->product_id ?>/delete">删除</a></td>
			</tr>
		<?php }}?>
		</tbody>
	</table>
	<div class="pagination pagination-centered">
		<?php echo $pager;?>
	</div>
</div>