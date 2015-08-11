<?php if(isset($data['errors'])): ?>
	<ul>
<?php foreach($data['errors'] as $error): ?>
		<li><?=$error?></li>
<?php endforeach; ?>
	</ul>
<?php endif; ?>
