<?php
    include "../../path.php";
    include "../../app/controllers/commentsController.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/8691fe9de8.js" crossorigin="anonymous"></script>

    <!-- Custom Styling -->
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <title>Discovery.Bashkiria</title>
</head>

<body>

<!-- Блок HEADER START -->

<?php include("../../app/include/header-admin.php"); ?>

<!-- Блок HEADER END -->


<!-- Блок MAIN START -->

<div class="container">
    <?php include "../../app/include/sidebar-admin.php"; ?>
        <div class="posts col-10">
            <div class="row title-table">
                <h2>Управление комментариями</h2>
                <div class="col-1">ID</div>
                <div class="col-5">Текст</div>
                <div class="col-2">Автор</div>
                <div class="col-4">Управление</div>
            </div>
            <?php foreach ($commentsForAdm as $key => $comment): ?>
                <div class="row post">
                    <div class="id col-1"><?=$comment['comment_id']; ?></div>
                    <div class="title col-5"><?=$comment['comment']; ?></div>
                    <?php
                        $user = $comment['user_email'];
                        $user = explode('@', $user);
                        $user = $user[0];
                    ?>
                    <div class="author col-3"><?=$user . '@'; ?></div>
                    <div class="edit col-1"><a href="edit.php?id=<?=$comment['comment_id']; ?>">Edit</a></div>
                    <div class="delete col-1"><a href="edit.php?delete_id=<?=$comment['comment_id']; ?>">Delete</a></div>
                    <?php if ($comment['comment_status']): ?>
                        <div class="status col-1"><a href="edit.php?publish=0&pub_id=<?=$comment['comment_id']; ?>">unpublish</a></div>
                    <?php else: ?>
                        <div class="status col-1"><a href="edit.php?publish=1&pub_id=<?=$comment['comment_id']; ?>">publish</a></div>
                    <? endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- Блок MAIN START -->



<!-- Блок footer START -->

<?php include("../../app/include/footer.php"); ?>

<!-- Блок footer END -->



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
-->
</body>
</html>
