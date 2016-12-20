<?php
require_once ("./App/UserApp.php");

$action = $_REQUEST['action'];

$u = new UserApp();
$u->set();
$toEcho;
switch($action) {
    case 'login':
        $toEcho = $u->checkLogin();
        break;
    case 'isLogged':
        $toEcho = $u->isLogged();
        break;
    case 'logout':
        $toEcho = $u->logout();
        break; 
}

echo $toEcho;
?>