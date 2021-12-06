<?php
define('BASE_URL', 'http://lessons_www/test/marlin2/');

const WARNING = 'danger text-dark" role="alert';
const SUCCESS = 'success';
const ATTENTION = '<strong>Уведомление! </strong>';

function format_flash_message($type, $attention, $message){
    $flash_message = '<div class="alert alert-' . $type . '">' . $attention . "$message</div>";
    return $flash_message;
}

/* 
        Parametrs:
            string - $name (ключ)
            string - $flash_message (значение, текст сообщения)
        
        Description: подготовить флеш сообщение

        Return value: null
*/
function set_flash_message($name, $flash_message) {
    $_SESSION[$name] = $flash_message;
}

/* 
        Parametrs:
            string - $name (ключ)
        
        Description: вывести флеш сообщение

        Return value: null
*/
function display_flash_message($name) {
    // получить
    if (isset($_SESSION[$name])) echo $_SESSION[$name];

    // удалить
    if (isset($_SESSION[$name])) unset($_SESSION[$name]);
}

/* 
        Parametrs:
            string - $path
        
        Description: перенаправить на другую страницу

        Return value: null
*/
function redirect_to($path) {
    header('Location: ' . $path);
}

function get_data_from_DB($data){

    $sql = "SELECT $data FROM `users`";
    include 'connect.php';
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $arrayDB = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $arrayDB;

}

function get_data_by_param_from_DB($data, $param1, $param2){

    $sql = "SELECT $data FROM `users` WHERE $param1 = '$param2'";
    include 'connect.php';
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $arrayDB = $statement->fetch(PDO::FETCH_ASSOC);
    return $arrayDB;

}

function give_error_verify($name, $message, $path){
        
    $flash_message = format_flash_message(WARNING, ATTENTION, $message);
    set_flash_message($name,$flash_message);
    redirect_to($path);die;
    
}

/* 
        Parametrs:
            string - $email
        
        Description: поиск пользователя по эл. адресу

        Return value: array
*/
function get_user_by_email($email) {
   
    $arrayEmail = array("email" => $email);
    $arrayEmailDB = get_data_from_DB('`email`');
    
    if (in_array($arrayEmail, $arrayEmailDB)){

        $name = 'email is busy';
        $message = 'Этот эл. адрес уже занят другим пользователем.';
        $path = BASE_URL . 'app/views/page_register.php';
        give_error_verify($name, $message, $path);
    }
}

function registered($name){
    $message = 'Регистрация успешна';
    $flash_message = format_flash_message(SUCCESS, '', $message);
    set_flash_message($name,$flash_message);
    redirect_to(BASE_URL . 'app/views/page_login.php');
}

/* 
        Parametrs:
            string - $email
            string - $password
        
        Description: добавить пользователя в БД

        Return value: int (user_id)
*/
function add_user($email,$password) {
    $sql = "INSERT INTO `users` (email, password) VALUES (:email, :password)";
    include 'connect.php';
    $statement = $pdo->prepare($sql);
    $statement->bindParam(":email", $email);
    $statement->bindParam(":password", $password);
    $statement->execute();

    registered('registеred');

}

function login($email, $password){
    $arrayUser = array("email" => $email, "password" => $password);
    $arrayUserDB = get_data_from_DB('`email`, `password`');
    $infoAdminDB = get_data_by_param_from_DB('`admin`', '`email`', $email);

    if (!in_array($arrayUser, $arrayUserDB)){
        $name = 'verify false';
        $message = 'Логин и пароль не совпадают.';
        $path = BASE_URL . 'app/views/page_login.php';
        give_error_verify($name, $message, $path);

    }else
        $_SESSION['user'] = $email;
        $_SESSION['password'] = $password;
        $_SESSION['admin'] = $infoAdminDB;
        redirect_to(BASE_URL);

}

