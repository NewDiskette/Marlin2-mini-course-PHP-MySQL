<?php
session_start();
// удалить
if (isset($_SESSION['user'])) unset($_SESSION['user']);
if (isset($_SESSION['password'])) unset($_SESSION['password']);

include '../models/functions.php';
redirect_to('../../index.php');