<?php
require_once ("./App/User.php");

$action = $_REQUEST['action'];

$u = new User();
$u->set();
$toEcho;
switch($action) {
    case 'create':
        $toEcho = $u->create();
        break;
    case 'get':
        $toEcho = $u->get();
        break;
    case 'update':
        $toEcho = $u->update();
        break;
}

echo $toEcho;
?>