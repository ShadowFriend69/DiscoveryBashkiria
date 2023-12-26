<?php
// контроллер

include_once SITE_ROOT . "/app/database/db.php";
$commentsForAdm = selectAll('comments');

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

// удаление комментария
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];

    delete_comm('comments', $id);
    header('location: ' . BASE_URL . 'admin/comments/index.php');
}

// изменение статуса комментария
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pub_id'])) {
    $id = $_GET['pub_id'];
    $publish = $_GET['publish'];

    $postId = update_com('comments', $id, ['comment_status' => $publish]);

    header('location: ' . BASE_URL . 'admin/comments/index.php');
    exit();
}

// редактирование поста
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $comment = selectOne('comments', ['comment_id' => $_GET['id']]);

    $id =  $comment['comment_id'];
    $email = $comment['user_email'];
    $content = $comment['comment'];
    $publish = $comment['comment_status'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_comment'])) {

    $id =  $_POST['id'];
    $content = trim($_POST['content']);
    $publish = isset($_POST['publish']) ? 1 : 0;

    if($content === ''){
        array_push($errMsg, "Комментарий не имеет текста!");
    }elseif (mb_strlen($content, 'UTF-8') < 5){
        array_push($errMsg, "Длинна комментария должна быть более 5-ти символов");
    }else{
        $com = [
            'comment' => $content,
            'comment_status' => $publish,
        ];
        $comment = update_com('comments', $id, $com);
        header('location: ' . BASE_URL . 'admin/comments/index.php');
    }
}else{
//    $title = $_POST['post_title'];
//    $content = $_POST['post_content'];
    $publish = isset($_POST['publish']) ? 1: 0;
//    $topic = $_POST['post_topic'];
}