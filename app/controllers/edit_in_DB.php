<?php
session_start();
include '../models/functions.php';
var_dump($_POST);
var_dump($_SESSION);
$user_for_edit = $_SESSION['user_for_edit'];

if ($_POST['username'] != $user_for_edit['username']):
    $data = 'username';
    $update = $_POST['username'];
    $param1 = 'email';
    $param2 = $user_for_edit['email'];
    update_data_in_DB($data, $update, $param1, $param2);
endif;
redirect_to(BASE_URL);
