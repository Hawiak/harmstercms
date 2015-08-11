<?php
ob_start();
?>
<form method="post" action="/harmstercms/blog/add">
	<label for="titel">Titel:</label>
	<input id="titel" type="text" name="titel" value="">
	<label for="tekst">Tekst:</label>
	<textarea id="tekst" type="text" name="tekst" rows="10" cols="50"></textarea>
	<input type="submit" value="Opslaan">
</form>
<?php
$content = ob_get_clean();
$layout->setBlock('content', $content);