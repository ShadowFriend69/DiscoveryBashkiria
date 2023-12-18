<?php

include SITE_ROOT . "/app/database/db.php";

if (!$_SESSION){
    header('location: ' . BASE_URL . 'log.php');
}

$errMsg = [];
$id = '';
$title = '';
$content = '';
$img = '';
$topic = '';

$topics = selectAll('topics');
$posts = selectAll('posts');
$postsAdm = selectAllFromPostsWithUsers('posts', 'users');


// Код для добавления нового поста
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_post'])) {

    if (!empty($_FILES['post_img']['name'])){
        $imgName = time() . "_" . $_FILES['post_img']['name'];
        $fileTmpName = $_FILES['post_img']['tmp_name'];
        $fileType = $_FILES['post_img']['type'];
        $destination = ROOT_PATH . "\assets\images\posts\\" . $imgName;

        if (strpos($fileType, 'image') === false) {
            array_push($errMsg, "Можно загружать только изображения!");
        }else{
            $result = move_uploaded_file($fileTmpName, $destination);

            if ($result){
                $_POST['post_img'] = $imgName;
            }else{
                array_push($errMsg, "Ошибка загрузки изображения на сервер!");
            }
        }
    }else{
        array_push($errMsg, "Ошибка получения картинки!");
    }

    $title = trim($_POST['post_title']);
    $content = trim($_POST['post_content']);
    $topic = trim($_POST['post_topic']);
    $publish = isset($_POST['publish']) ? 1 : 0;

    if($title === '' || $content === '' || $topic === ''){
        array_push($errMsg, "Не все поля заполнены!");
    }elseif (mb_strlen($title, 'UTF-8') < 5){
        array_push($errMsg, "Название статьи должно быть более 5-ти символов");
    }else{
        $post = [
            'user_id' => $_SESSION['id'],
            'post_title' => $title,
            'post_content' => $content,
            'post_img' => $_POST['post_img'],
            'post_status' => $publish,
            'topic_id' => $topic,
        ];
        $post = insert('posts', $post);
        $post = selectOne('posts', ['post_id' => $id]);
        header('location: ' . BASE_URL . 'admin/posts/index.php');
        }
}else{
    $id = '';
    $title = '';
    $content = '';
    $publish = '';
    $topic = '';
}


// редактирование поста
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $post = selectOne('posts', ['post_id' => $_GET['id']]);

    $id =  $post['post_id'];
    $title = $post['post_title'];
    $content = $post['post_content'];
    $topic = $post['topic_id'];
    $publish = $post['post_status'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_post'])) {
    // tt($_POST);
    $id =  $_POST['id'];
    $title = trim($_POST['post_title']);
    $content = trim($_POST['post_content']);
    $topic = trim($_POST['post_topic']);
    $publish = isset($_POST['publish']) ? 1 : 0;

    if (!empty($_FILES['post_img']['name'])){
        $imgName = time() . "_" . $_FILES['post_img']['name'];
        $fileTmpName = $_FILES['post_img']['tmp_name'];
        $fileType = $_FILES['post_img']['type'];
        $destination = ROOT_PATH . "\assets\images\posts\\" . $imgName;

        if (strpos($fileType, 'image') === false) {
            array_push($errMsg, "Можно загружать только изображения!");
        }else{
            $result = move_uploaded_file($fileTmpName, $destination);

            if ($result){
                $_POST['post_img'] = $imgName;
            }else{
                array_push($errMsg, "Ошибка загрузки изображения на сервер!");
            }
        }
    }else{
        array_push($errMsg, "Ошибка получения картинки!");
    }

    if($title === '' || $content === '' || $topic === ''){
        array_push($errMsg, "Не все поля заполнены!");
    }elseif (mb_strlen($title, 'UTF-8') < 5){
        array_push($errMsg, "Название статьи должно быть более 5-ти символов");
    }else{
        $post = [
            'user_id' => $_SESSION['id'],
            'post_title' => $title,
            'post_content' => $content,
            'post_img' => $_POST['post_img'],
            'post_status' => $publish,
            'topic_id' => $topic,
        ];
        $post = update_post('posts', $id, $post);
        header('location: ' . BASE_URL . 'admin/posts/index.php');
    }
}else{
//    $title = $_POST['post_title'];
//    $content = $_POST['post_content'];
    $publish = isset($_POST['publish']) ? 1: 0;
//    $topic = $_POST['post_topic'];
}

// изменение статуса публикации
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pub_id'])) {
    $id = $_GET['pub_id'];
    $publish = $_GET['publish'];

    $postId = update_post('posts', $id, ['post_status' => $publish]);

    header('location: ' . BASE_URL . 'admin/posts/index.php');
    exit();
}

// удаление статьи
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];

    delete_post('posts', $id);
    header('location: ' . BASE_URL . 'admin/posts/index.php');
}