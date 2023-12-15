<?php

include SITE_ROOT . "/app/database/db.php";

$errMsg = '';
$id = '';
$name = '';
$description = '';
$topics = selectAll('topics');


// Код для добавления новой категории
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['topic-create'])) {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);


    if($name === '' || $description === ''){
        $errMsg = "Не все поля заполнены!";
    }elseif (mb_strlen($name, 'UTF-8') < 2){
        $errMsg = "Категория должна быть более 2-х символов";
    }else{
        $exist = selectOne('topics', ['topic_name' => $name]);
        if ($exist['topic_name'] === $name){
            $errMsg = "Такая категория уже есть!";
        }else{
            $topic = [
                'topic_name' => $name,
                'topic_description' => $description,
            ];
            $id = insert('topics', $topic);
            $topic = selectOne('topics', ['topic_id' => $id]);
            header('location: ' . BASE_URL . 'admin/topics/index.php');
        }
    }
}else{
    $name = '';
    $description = '';
}


// редактирование категории

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $topic = selectOne('topics', ['topic_id' => $id]);
    $name = $topic['topic_name'];
    $description = $topic['topic_description'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['topic-edit'])) {

    $name = trim($_POST['name']);
    $description = trim($_POST['description']);


    if($name === '' || $description === ''){
        $errMsg = "Не все поля заполнены!";
    }elseif (mb_strlen($name, 'UTF-8') < 2){
        $errMsg = "Категория должна быть более 2-х символов";
    }else{
        $topic = [
            'topic_name' => $name,
            'topic_description' => $description,
        ];
        $id = $_POST['id'];
        $topic_id = update_topic('topics', $id, $topic);
        header('location: ' . BASE_URL . 'admin/topics/index.php');
    }
}

// удаление категории

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];

    delete_topic('topics', $id);
    header('location: ' . BASE_URL . 'admin/topics/index.php');
}