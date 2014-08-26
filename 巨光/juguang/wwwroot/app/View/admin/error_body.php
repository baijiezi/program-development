<div class="span9">
	<div class="hero-unit">
		<div class="alert alert-error">!!OOPS!! This is an error page.</div>
		What more can I say ?
		
		<?php
		echo '<pre>';
		print_r ( error_get_last () );
		echo '</pre>';
		?>
		
		<p>
			<br><button class="btn btn-primary" type="button">go back</button>
		</p>
	</div>
</div>