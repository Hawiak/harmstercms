<?php
ob_start();
?>
<a href="/harmstercms/blog/add" class="new">Nieuw</a>
<table>
	<tr><th>Titel</th><th>Datum</th><th>Actions</th></tr>
<?php foreach($data['blogposts'] as $blogpost): ?>
	<tr><td><?= $blogpost['titel'] ?></td><td><?= $blogpost['datetime']?></td><td><a href="/harmstercms/blog/edit/<?=$blogpost['id']?>">Edit</a>|<a href="/harmstercms/blog/delete/<?=$blogpost['id']?>">Delete</a></td></tr>
<?php endforeach; ?>
</table>
<?php 
$content = ob_get_clean();
$layout->setBlock('content', $content);