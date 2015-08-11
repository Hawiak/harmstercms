<?php
define("ROOT", __DIR__ ."/");
// Begin de sessie
session_start();
require_once('config.php');
if($_CONFIG['site_config']['debug'] == true) {
	error_reporting(E_ALL);
}
include('core/Core.php');

$database = new Database($_CONFIG['db_config']);
$core = new Core();
$core->setDatabase($database);
$core->setConfig($_CONFIG);

// Core
$super = new Super($core);
$super->setCore($core);

// Helpers
$helpers = new Helpers();
$super->setHelpers($helpers);

// ACL
$acl = new Acl($super);
$super->setAcl($acl);

// App
$app = new App($super);
$super->setApp($app);

$app->render();
