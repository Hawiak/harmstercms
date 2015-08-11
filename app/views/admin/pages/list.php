<?php
ob_start();
?>
<a href="/harmstercms/page/add" class="new">Nieuw</a>
<table>
	<tr><th>Titel</th><th>Acties</th></tr>

	<?php foreach($data['pages'] as $page): ?>
	<tr><td><?= $page['titel'] ?></td><td><a href="/harmstercms/page/edit/<?=$page['id']?>">Edit</a>|<a href="/harmstercms/page/delete/<?= $page['id'] ?>">delete</a></td></tr>
<?php endforeach; ?>
</table>
<?php 
$content = ob_get_clean();
$layout->setBlock('content', $content);