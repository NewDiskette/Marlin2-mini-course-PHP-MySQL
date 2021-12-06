<?php
session_start();

$email = $_POST['email'];
$password = $_POST['password'];

include '../models/functions.php';

login($email, $password);
