<?php

include SITE_ROOT . "/app/database/db.php";

$errMsg = '';
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
    $title = trim($_POST['post_title']);
    $content = trim($_POST['post_content']);
    $topic = trim($_POST['post_topic']);
    $publish = isset($_POST['publish']) ? 1 : 0;

    if($title === '' || $content === '' || $topic === ''){
        $errMsg = "Не все поля заполнены!";
    }elseif (mb_strlen($title, 'UTF-8') < 5){
        $errMsg = "Название статьи должно быть более 5-ти символов";
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
    $title = '';
    $content = '';
}


//// редактирование категории
//
//if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
//    $id = $_GET['id'];
//    $topic = selectOne('topics', ['topic_id' => $id]);
//    $name = $topic['topic_name'];
//    $description = $topic['topic_description'];
//}
//
//if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['topic-edit'])) {
//
//    $name = trim($_POST['name']);
//    $description = trim($_POST['description']);
//
//
//    if($name === '' || $description === ''){
//        $errMsg = "Не все поля заполнены!";
//    }elseif (mb_strlen($name, 'UTF-8') < 2){
//        $errMsg = "Категория должна быть более 2-х символов";
//    }else{
//        $topic = [
//            'topic_name' => $name,
//            'topic_description' => $description,
//        ];
//        $id = $_POST['id'];
//        $topic_id = update_topic('topics', $id, $topic);
//        header('location: ' . BASE_URL . 'admin/topics/index.php');
//    }
//}
//
//// удаление категории
//
//if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])) {
//    $id = $_GET['delete_id'];
//
//    delete_topic('topics', $id);
//    header('location: ' . BASE_URL . 'admin/topics/index.php');
//}