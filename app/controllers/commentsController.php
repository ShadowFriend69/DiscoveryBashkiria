<?php
// контроллер

include_once SITE_ROOT . "/app/database/db.php";

$page = $_GET['post'];
$email = '';
$comment = '';
$errMsg = [];
$status = 0;
$comments = [];

// Код для формы создания комментария
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['goComment'])) {

    $email = trim($_POST['email']);
    $comment = trim($_POST['comment']);

    if($email === '' || $comment === ''){
        array_push($errMsg, "Не все поля заполнены!");
    }elseif (mb_strlen($comment, 'UTF-8') < 5){
        array_push($errMsg, "Комментарий должен быть длинее 5 символов");
    }else{
        $user = selectOne('users', ['user_email' => $email]);
        if ($user['user_email'] == $email){
            $status = 1;
        }

        $comment = [
            'comment_status' => $status,
            'comment_page' => $page,
            'user_email' => $email,
            'comment' => $comment,
        ];
        $comment = insert('comments', $comment);
        $comments = selectAll('comments', ['comment_page' => $page, 'comment_status' => 1]);
    }
}else{
    $email = '';
    $comment = '';
    $comments = selectAll('comments', ['comment_page' => $page, 'comment_status' => 1]);
}