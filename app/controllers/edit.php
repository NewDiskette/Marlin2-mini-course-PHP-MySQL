<?php
session_start();
var_dump($_SESSION);
var_dump($_GET);
include '../models/functions.php';

if($_SESSION['roleDB'] != array('role'=> 'admin')):
    $emailDB = $_SESSION['emailDB'];
else:
    $emailDB = $_GET['emailDB'];
endif;
var_dump ($emailDB);
$_SESSION['user_for_edit'] = get_data_by_param_from_DB('*', 'email', $emailDB);
// var_dump($user_for_edit);
redirect_to(BASE_URL . 'app/views/page_edit.php');
