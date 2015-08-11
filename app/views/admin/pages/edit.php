<?php
ob_start();
?>
<form method="post" action="/harmstercms/page/store">
	<input type="hidden" name="id" value="<?= $data['page']->id ?>">
	Titel: <input type="text" name="titel" value="<?= $data['page']->titel ?>">
	Tekst: <input type="text" name="tekst" value="<?= $data['page']->tekst ?>">
	Layout: <input type="text" name="layout" value="<?= $data['page']->layout ?>">
	<input type="submit" value="Opslaan">
</form>
<?php 
$block = ob_get_clean();
$layout->setBlock('content', $block);
?>