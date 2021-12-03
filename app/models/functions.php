<?php
include '../../path.php';

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


function email_is_busy($name){
    $message = 'Этот эл. адрес уже занят другим пользователем.';
    $flash_message = format_flash_message(WARNING, ATTENTION, $message);
    set_flash_message($name,$flash_message);
    redirect_to(BASE_URL . 'app/views/page_register.php');
}

/* 
        Parametrs:
            string - $email
        
        Description: поиск пользователя по эл. адресу

        Return value: array
*/
function get_user_by_email($email) {
    $sql = "SELECT `email` FROM `users`";
    include 'connect.php';
    $statement = $pdo->prepare($sql);
    $statement->execute();

    $arrayEmailDB = $statement->fetchAll(PDO::FETCH_ASSOC);
    $arrayEmail = array("email" => $email);
    
    if (in_array($arrayEmail, $arrayEmailDB)){
        email_is_busy('email is busy');
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