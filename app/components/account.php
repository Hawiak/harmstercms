<?php
if(!$super->getAcl()->isLoggedin()){
	echo '<div class="account_banner">Je bent niet ingelogt, log hier in <a href="/harmstercms/user/login">login</a>';
}else{
	echo '<div class="account_banner">Je bent ingelogt, <a href="/harmstercms/user/logout">log uit</a></div>';
}
if($super->getAcl()->hasRole('admin')){
	echo '<div><a href="/harmstercms/admin">Admin</a></div>';
}