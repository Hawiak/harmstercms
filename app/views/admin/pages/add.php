<?php
ob_start();
?>
<form method="post" action="/harmstercms/page/add">
	Titel: <input type="text" name="titel" value="">
	Tekst: <input type="text" name="tekst" value="">
	<input type="submit" value="Opslaan">
</form>
<?php
$content = ob_get_clean();
$layout->setBlock('content', $content);