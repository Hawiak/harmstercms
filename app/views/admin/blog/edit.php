<?php
ob_start();
?>
<form method="post" action="/harmstercms/blog/store">
	<input type="hidden" name="id" value="<?= $data['blog']->id ?>">
	Titel: <input type="text" name="titel" value="<?= $data['blog']->titel ?>">
	Tekst: <input type="text" name="tekst" value="<?= $data['blog']->tekst ?>">
	<input type="submit" value="Opslaan">
</form>
<?php 
$block = ob_get_clean();
$layout->setBlock('content', $block);
?>