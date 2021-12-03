<?php
session_start();

$email = $_POST['emailverify'];
$password = $_POST['userpassword'];
// echo 'register.php';

include '../models/functions.php';
// big_test();
get_user_by_email($email);
add_user($email,$password);
