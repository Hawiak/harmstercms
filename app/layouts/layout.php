<!DOCTYPE html>
<html>
<head>
	<title>HarmsterCMS || <?= $layout->renderText("titel") ?></title>
	<?= Helpers::stylesheet('layout')?>
	<style>
		
	</style>
</head>
<body>
<div id="wrapper" class="wrapper">
	<?php if(Session::hasMessages()):?>
	<ul>
		<li>
			<?= Session::getMessage() ?>
		</li>
	</ul>
	<?php endif; ?>
	<?php $layout->renderComponent('account'); ?>

	<div>
		<?php $layout->renderComponent('navbar'); ?>
	</div>
	<h1><?= $layout->renderText("titel") ?></h1>
	<div>
		<?= $layout->renderBlock("content") ?>
	</div>
</div>
</body>
</html>