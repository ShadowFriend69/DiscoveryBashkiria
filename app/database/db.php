<?php

session_start();
require ('connect.php');

function tt($value){
    echo '<pre>';
    print_r($value);
    echo '<pre>';
    exit();
}

// Проверка выполнения запроса
function dbCheckError($query){
    $errInfo = $query->errorInfo();
    if ($errInfo[0] !== PDO::ERR_NONE){
        echo $errInfo[2];
        exit();
    }
    return true;
}

// Запрос на получение даннных из одной таблицы
function selectAll($table, $params = []){
    global $pdo;

    $sql = "SELECT * FROM $table";

    if(!empty($params)){
        $i = 0;
        foreach ($params as $key => $value){
            if (!is_numeric($value)){
                $value = "'" . $value . "'";
            }

            if ($i === 0){
                $sql = $sql . " WHERE $key = $value";
            }else{
                $sql = $sql . " AND $key = $value";
            }
            $i++;
        }
    }

    $query = $pdo->prepare($sql);
    $query->execute();

    dbCheckError($query);

    return $query->fetchAll();
}

// Запрос на получение одной строки из таблицы с параметром
function selectOne($table, $params = []){
    global $pdo;

    $sql = "SELECT * FROM $table";

    if(!empty($params)){
        $i = 0;
        foreach ($params as $key => $value){
            if (!is_numeric($value)){
                $value = "'" . $value . "'";
            }

            if ($i === 0){
                $sql = $sql . " WHERE $key = $value";
            }else{
                $sql = $sql . " AND $key = $value";
            }
            $i++;
        }
    }

    // $sql = $sql . " LIMIT 1 ";
    $query = $pdo->prepare($sql);
    $query->execute();

    dbCheckError($query);

    return $query->fetch();
}

// Запись в таблицу БД
function insert($table, $params){
    global $pdo;
    $i = 0;
    $col = '';
    $mask = '';
    foreach ($params as $key => $value){
        if ($i === 0){
            $col = $col . $key;
            $mask = $mask . "'" . "$value" . "'";
        }else{
            $col = $col . ", $key";
            $mask = $mask . ", '" . "$value" . "'";
        }
        $i++;
    }

    $sql = "INSERT INTO $table ($col) VALUES ($mask)";
    $query = $pdo->prepare($sql);
    $query->execute($params);

    dbCheckError($query);

    return $pdo->lastInsertId();
}

// Обновление строки в таблице
function update($table, $user_id, $params){
    global $pdo;
    $i = 0;
    $str = '';
    foreach ($params as $key => $value){
        if ($i === 0){
            $str = $str . $key . " = '" . $value . "'";
        }else{
            $str = $str . ", $key" . " = '" . $value . "'";
        }
        $i++;
    }

    $sql = "UPDATE $table SET $str WHERE user_id = $user_id";

    $query = $pdo->prepare($sql);
    $query->execute($params);

    dbCheckError($query);
}

// обновление категории
function update_topic($table, $topic_id, $params){
    global $pdo;
    $i = 0;
    $str = '';
    foreach ($params as $key => $value){
        if ($i === 0){
            $str = $str . $key . " = '" . $value . "'";
        }else{
            $str = $str . ", $key" . " = '" . $value . "'";
        }
        $i++;
    }

    $sql = "UPDATE $table SET $str WHERE topic_id = $topic_id";

    $query = $pdo->prepare($sql);
    $query->execute($params);

    dbCheckError($query);
}
// обновление поста
function update_post($table, $post_id, $params){
    global $pdo;
    $i = 0;
    $str = '';
    foreach ($params as $key => $value){
        if ($i === 0){
            $str = $str . $key . " = '" . $value . "'";
        }else{
            $str = $str . ", $key" . " = '" . $value . "'";
        }
        $i++;
    }

    $sql = "UPDATE $table SET $str WHERE post_id = $post_id";

    $query = $pdo->prepare($sql);
    $query->execute($params);

    dbCheckError($query);
}

// Удаление строки в таблице
function delete($table, $user_id){
    global $pdo;

    $sql = "DELETE FROM $table WHERE user_id = $user_id";

    $query = $pdo->prepare($sql);
    $query->execute();

    dbCheckError($query);
}

// Удаление строки в таблице topics
function delete_topic($table, $topic_id){
    global $pdo;

    $sql = "DELETE FROM $table WHERE topic_id = $topic_id";

    $query = $pdo->prepare($sql);
    $query->execute();

    dbCheckError($query);
}

// Удаление строки в таблице с постами
function delete_post($table, $post_id){
    global $pdo;

    $sql = "DELETE FROM $table WHERE post_id = $post_id";

    $query = $pdo->prepare($sql);
    $query->execute();

    dbCheckError($query);
}

// Выборка постов с автором в админку
function selectAllFromPostsWithUsers($table1, $table2){
    global $pdo;

    $sql = "
            SELECT 
                t1.post_id,
                t1.post_title,
                t1.post_img,
                t1.post_content,
                t1.post_status,
                t1.topic_id,
                t1.post_created_date,
                t2.user_name
            FROM 
                $table1 AS t1 JOIN $table2 AS t2 ON t1.user_id = t2.user_id
    ";

    $query = $pdo->prepare($sql);
    $query->execute();

    dbCheckError($query);

    return $query->fetchAll();
}

// Выборка опубликованных постов с автором с необязательным параметром
function selectAllFromPostsWithUsersOnIndex($table1, $table2, $params = []){
    global $pdo;

    $sql = "
            SELECT 
                p.*,
                u.user_name
            FROM 
                $table1 AS p 
            JOIN
                $table2 AS u ON p.user_id = u.user_id 
            WHERE
                p.post_status = 1
    ";

    if(!empty($params)){
        foreach ($params as $key => $value){
            if (!is_numeric($value)){
                $value = "'" . $value . "'";
            }
            $sql = $sql . " AND $key = $value";
        }
    }

    $query = $pdo->prepare($sql);
    $query->execute();

    dbCheckError($query);

    return $query->fetchAll();
}

// Выборка топ постов на главную
function selectTopPostOnIndex($table1){
    global $pdo;

    $sql = "SELECT * FROM $table1 WHERE topic_id = 12";

    $query = $pdo->prepare($sql);
    $query->execute();

    dbCheckError($query);

    return $query->fetchAll();
}

// Поиск по заголовкам и содержимому (простой)
function searchInTitleAndContent($text, $table1, $table2){
    $text = trim(strip_tags(stripcslashes(htmlspecialchars($text))));
    global $pdo;

    $sql = "
            SELECT 
                p.*,
                u.user_name
            FROM 
                $table1 AS p 
            JOIN 
                $table2 AS u ON p.user_id = u.user_id 
            WHERE
                p.post_status = 1
            AND 
                p.post_title LIKE '%$text%' 
            OR
                p.post_content LIKE '%$text%'
    ";

    $query = $pdo->prepare($sql);
    $query->execute();

    dbCheckError($query);

    return $query->fetchAll();
}

// Выборка поста с автором для сингл
function selectPostFromPostsWithUsersOnSingle($table1, $table2, $id){
    global $pdo;

    $sql = "
            SELECT 
                p.*,
                u.user_name
            FROM 
                $table1 AS p
            JOIN
                $table2 AS u ON p.user_id = u.user_id
            WHERE
                p.post_id = $id
    ";

    $query = $pdo->prepare($sql);
    $query->execute();

    dbCheckError($query);

    return $query->fetch();
}