<?php
include 'app/database/db.php';

$errMsg = '';

/**
 * @param $data
 * @return void
 */
function userAuth($data): void
{
    $_SESSION['id'] = $data['user_id'];
    $_SESSION['login'] = $data['user_name'];
    $_SESSION['admin'] = $data['is_user_admin'];

    if ($_SESSION['admin']) {
        header('location' . BASE_URL . 'admin/admin.php');
    } else {
        header('location: ' . BASE_URL);
    }
}

// Код для регистрации
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-reg'])){

    $admin = 0;
    $login = trim($_POST['login']);
    $email = trim($_POST['email']);
    $passwordFirst = trim($_POST['password-first']);
    $passwordSecond = trim($_POST['password-second']);

    if($login === '' || $email === '' || $passwordFirst === ''){
        $errMsg = "Не все поля заполнены!";
    }elseif (mb_strlen($login, 'UTF-8') < 2){
        $errMsg = "Логин должен быть больше двух символов";
    }elseif ($passwordFirst !== $passwordSecond){
        $errMsg = "Пароли должны соответствовать друг другу";
    }else{
        $exist = selectOne('users', ['user_email' => $email]);
        if ($exist['user_email'] === $email){
            $errMsg = "Пользователь с такой почтой уже есть!";
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
        $errMsg = "Не все поля заполнены!";
    }else{
        $exist = selectOne('users', ['user_email' => $email]);
        if ($exist && password_verify($password, $exist['user_password'])){
            userAuth($exist);
        } else {
            $errMsg = "Почта либо пароль введены неверно!";
        }
    }
}else{
    $email = '';
}