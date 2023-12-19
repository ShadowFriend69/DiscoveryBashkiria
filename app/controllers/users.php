<?php
include SITE_ROOT . "/app/database/db.php";

$errMsg = [];

/**
 * @param $user
 * @return void
 */
function userAuth($user): void
{
    $_SESSION['id'] = $user['user_id'];
    $_SESSION['login'] = $user['user_name'];
    $_SESSION['admin'] = $user['is_user_admin'];

    if ($_SESSION['admin']) {
        header('location:' . BASE_URL . 'admin/posts/index.php');
    } else {
        header('location: ' . BASE_URL);
    }
}

$users = selectAll('users');

// Код для регистрации
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-reg'])){

    $admin = 0;
    $login = trim($_POST['login']);
    $email = trim($_POST['email']);
    $passwordFirst = trim($_POST['password-first']);
    $passwordSecond = trim($_POST['password-second']);

    if($login === '' || $email === '' || $passwordFirst === ''){
        array_push($errMsg, "Не все поля заполнены!");
    }elseif (mb_strlen($login, 'UTF-8') < 2){
        array_push($errMsg, "Логин должен быть больше двух символов");
    }elseif ($passwordFirst !== $passwordSecond){
        array_push($errMsg, "Пароли должны соответствовать друг другу");
    }else{
        $exist = selectOne('users', ['user_email' => $email]);
        if ($exist['user_email'] === $email){
            array_push($errMsg, "Пользователь с такой почтой уже есть!");
        }else{
            $password = password_hash($passwordFirst, PASSWORD_DEFAULT);
            $post = [
                'is_user_admin' => $admin,
                'user_name' => $login,
                'user_email' => $email,
                'user_password' => $password,
            ];
            $id = insert('users', $post);
            $user = selectOne('users', ['user_id' => $id]);
            userAuth($user);
        }
    }
}else{
    $login = '';
    $email = '';
}

// Код для авторизации
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-log'])) {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if($email === '' || $password === '') {
        array_push($errMsg, "Не все поля заполнены!");
    }else{
        $exist = selectOne('users', ['user_email' => $email]);
        if ($exist && password_verify($password, $exist['user_password'])){
            userAuth($exist);
        } else {
            array_push($errMsg, "Почта либо пароль введены неверно!");
        }
    }
}else{
    $email = '';
}

// Код для добавления пользователя через админ панель
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create-user'])){

    $admin = 0;
    $login = trim($_POST['login']);
    $email = trim($_POST['email']);
    $passwordFirst = trim($_POST['password-first']);
    $passwordSecond = trim($_POST['password-second']);

    if($login === '' || $email === '' || $passwordFirst === ''){
        array_push($errMsg, "Не все поля заполнены!");
    }elseif (mb_strlen($login, 'UTF-8') < 2){
        array_push($errMsg, "Логин должен быть больше двух символов");
    }elseif ($passwordFirst !== $passwordSecond){
        array_push($errMsg, "Пароли должны соответствовать друг другу");
    }else{
        $exist = selectOne('users', ['user_email' => $email]);
        if ($exist['user_email'] === $email){
            array_push($errMsg, "Пользователь с такой почтой уже есть!");
        }else{
            $password = password_hash($passwordFirst, PASSWORD_DEFAULT);
            if (isset($_POST['admin'])) $admin = 1;
            $user = [
                'is_user_admin' => $admin,
                'user_name' => $login,
                'user_email' => $email,
                'user_password' => $password,
            ];
            $id = insert('users', $user);
            $user = selectOne('users', ['user_id' => $id]);
            userAuth($user);
        }
    }
}else{
    $login = '';
    $email = '';
}

// удаление пользователя в админке
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];

    delete('users', $id);
    header('location: ' . BASE_URL . 'admin/users/index.php');
}

// редактирование пользователя в админке
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['edit_id'])) {
    $user = selectOne('users', ['user_id' => $_GET['edit_id']]);

    // tt($user);

    $id =  $user['user_id'];
    $admin = $user['is_user_admin'];
    $username = $user['user_name'];
    $email = $user['user_email'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update-user'])) {

    $id =  $_POST['id'];
    $email = trim($_POST['email']);
    $login = trim($_POST['login']);
    $passwordFirst = trim($_POST['password-first']);
    $passwordSecond = trim($_POST['password-second']);
    $admin = isset($_POST['admin']) ? 1 : 0;

    if($email === '' || $login === ''){
        array_push($errMsg, "Не все поля заполнены!");
    }elseif (mb_strlen($login, 'UTF-8') < 2){
        array_push($errMsg, "Логин должен быть больше двух символов");
    }elseif ($passwordFirst !== $passwordSecond){
        array_push($errMsg, "Пароли должны соответствовать друг другу");
    }else{
        $password = password_hash($passwordFirst, PASSWORD_DEFAULT);
        if (isset($_POST['admin'])) $admin = 1;
        $user = [
            'is_user_admin' => $admin,
            'user_name' => $login,
           // 'user_email' => $email,
            'user_password' => $password,
        ];
        $post = update('users', $id, $user);
        header('location: ' . BASE_URL . 'admin/users/index.php');
    }
}else{
//    $login = '';
//    $email = '';
}