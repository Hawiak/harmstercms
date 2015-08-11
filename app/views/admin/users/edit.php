<?php
ob_start();
?>
	<form method="post" action="/harmstercms/user/store">
		<input type="hidden" name="id" value="<?= $data['user']->id ?>">
		<fieldset>
			<legend>Gegevens</legend>
			Naam: <input disabled type="text" name="naam" value="<?= $data['user']->naam ?>">
			E-mail: <input type="text" name="email" value="<?= $data['user']->email ?>">
		</fieldset>
		<fieldset>
			<legend>Wachtwoord wijzigen</legend>
			Wachtwoord <input type="password" name="password1">
			Wachtwoord bevestigen<input type="password" name="password2">
		</fieldset>

		<fieldset>
			<legend>Rollen</legend>
			<?php 
			foreach($super->getCore()->getDatabase()->getAll("SELECT * FROM `rollen`") as $rol){
				if($super->getAcl()->hasRole($rol['naam'])){
					echo '<label for="' . $rol['id'] . '">' . $rol['naam'] . '</label><input type="checkbox" name="rollen[]" CHECKED id="' . $rol['id'] . '" value="' . $rol['id'] . '">';
				}else{
					echo '<label for="' . $rol['id'] . '">' . $rol['naam'] . '</label><input type="checkbox" name="rollen[]" value="' . $rol['id'] . '">';

				}
			}
			?>
		</fieldset>
		
		<input type="submit" value="Opslaan">
	</form>
<?php 
$block = ob_get_clean();
$layout->setBlock('content', $block);
?>