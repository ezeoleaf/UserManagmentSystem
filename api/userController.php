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
    case 'checkName':
        $toEcho = $u->checkName();
        break;
    case 'delete':
        $toEcho = $u->delete();
        break;
    case 'removeGroupUser':
        $toEcho = $u->removeGroup();
        break;
    case 'assignGroup':
        $toEcho = $u->assignGroup();
        break;
    case 'usersInGroup':
        $toEcho = $u->usersInGroup();
        break;
    case 'removeAll':
        $toEcho = $u->removeAll();
        break;
}

echo $toEcho;
?>