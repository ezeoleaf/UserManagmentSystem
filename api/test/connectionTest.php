<?php
require_once ('../App/Connection.php');

$con = new Connection();
$link = $con->connect();
//print_r($link);