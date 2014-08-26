<script type="text/javascript">
	$(function() {
		$('#add_submit').click(function() {
			$('#addNewsForm').submit();
		});
	});
</script>
<div class="span9">
	<div class="page-header">
		<h3>新闻管理</h3>
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
		if ($news == null) {
			echo '<tr><td colspan="3">暂无记录.</td></tr>';
		} else {
			foreach ( $news as $n ) {
				?>
			<tr>
				<td><a href="/news/<?php echo $n->news_id ?>" target="_blank"><?php echo $n->title ?></a></td>
				<td><?php echo $n->created ?></td>
				<td><a href="/admin/news/<?php echo $n->news_id ?>/edit">编辑</a>
					| <a href="/admin/news/<?php echo $n->news_id ?>/delete">删除</a></td>
			</tr>
		<?php }}?>
		</tbody>
	</table>
	<div class="pagination pagination-centered">
		<?php echo $pager;?>
	</div>
</div>