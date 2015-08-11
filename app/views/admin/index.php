<?php ob_start(); ?>
<div>
	<fieldset>
		<legend>Pagina</legend>
		<a href="/harmstercms/page/all">Pagina beheer</a>
	</fieldset>
	<fieldset>
		<legend>Gebruikers</legend>
		<a href="/harmstercms/user/all">Gebruikers beheer</a>
	</fieldset>
	<fieldset>
		<legend>Blogposts</legend>
		<a href="/harmstercms/blog/all">Blogposts beheer</a>
	</fieldset>
</div>
<?php $block = ob_get_clean(); 
$layout->setBlock('content', $block);
?>