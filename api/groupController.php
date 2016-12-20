<?php
require_once ("./App/Group.php");

$action = $_REQUEST['action'];
$g = new Group();
$g->set();
$toEcho;
switch($action) {
    case 'create':
        $toEcho = $g->create();
        break;
    case 'get':
        $toEcho = $g->get();
        break;
    case 'getCombo':
        $toEcho = $g->getCombo();
        break;
    case 'update':
        $toEcho = $g->update();
        break;
}

echo $toEcho;
?>