<?php
ob_start();
?>
<form method="post" action="/harmstercms/user/add">
	<label for="naam">Naam:</label><input id="naam" type="text" name="naam" value="">
	<label for="password1">Password:</label><input id="password1" type="text" name="password1" value="">
	<label for="password2">Bevestig password:</label><input id="password2" type="text" name="password2" value="">
	<label for="email">E-mail:</label><input id="email" type="text" name="email" value="">
	<input type="submit" value="Opslaan">
</form>
<?php
$content = ob_get_clean();
$layout->setBlock('content', $content);