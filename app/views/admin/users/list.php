<?php
ob_start();
?>
<a href="/harmstercms/user/add" class="new">Nieuw</a>
<table>
	<tr><th>Gebruikersnaam</th><th>Acties</th></tr>
<?php foreach($data['users'] as $user): ?>
	<tr><td><?= $user['naam'] ?></td><td><a href="/harmstercms/user/edit/<?=$user['id']?>">Edit</a>|<a href="/harmstercms/user/delete/<?= $user['id']?>">Delete</a></td></tr>
<?php endforeach; ?>
</table>
<?php 
$content = ob_get_clean();
$layout->setBlock('content', $content);