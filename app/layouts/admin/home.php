<html>
<head>
	<?= Helpers::stylesheet('admin')?>
	<title>HarmsterCMS Admin</title>
</head>
	<body>
		<div class="wrapper">
			<h1>Admin panel</h1>
			<?php if(Session::hasMessages()):?>
			<ul>
				<li>
					<?= Session::getMessage() ?>
				</li>
			</ul>
		<?php endif; ?>
			<a href="/harmstercms/admin/">Admin panel</a><br />

			<?= $layout->renderBlock('content') ?>
		</div>
	</body>
</html>