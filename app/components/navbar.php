<?php
$pages = $super->getCore()->getDatabase()->getAll("SELECT * FROM `pages`");
echo '<ul id="navbar">';
echo '<a href="/harmstercms/"><li>Home</li></a>';
foreach($pages as $page){
	echo '<a href="/harmstercms/page/show/' . $page['id'] .  '"><li>' . $page['titel'] . '</li></a>';
}
echo '</ul>';
