<?php

$blogposts = $super->getCore()->getDatabase()->getAll("SELECT * FROM `blogposts` ORDER BY `datetime` DESC");

foreach($blogposts as $blogpost){
	echo '<h2>' . $blogpost['titel'] . '</h2>';
	echo '<div>' . $blogpost['tekst'] . '</div>';
}