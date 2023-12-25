<?php
    include "path.php";
    include "app/controllers/topics.php";
    $post = selectPostFromPostsWithUsersOnSingle('posts', 'users', $_GET['post']);
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
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <title>Discovery.Bashkiria</title>
</head>

<body>

<!-- Блок Header START -->

<?php include('app/include/header.php'); ?>

<!-- Блок Header END -->

<!-- Блок main START -->

<div class="container">
    <div class="content row">
        <!-- main Content-->
        <div class="main-content col-md-9 col-12">
            <h2><?=$post['post_title']; ?></h2>
            <div class="single_post row">
                <div class="ing col-12">
                    <img src="<?=BASE_URL . 'assets/images/posts/' . $post['post_img']; ?>" alt="<?=$post['post_title']; ?>" class="img-thumbnail">
                </div>
                <div class="info">
                    <i class="far fa-user"> <?=$post['user_name']; ?></i>
                    <i class="far fa-calendar"> <?=$post['post_created_date']; ?></i>
                </div>
                <div class="single_post_text col-12">
                    <?=$post['post_content']; ?>
                </div>
            </div>
        </div>
        <!-- Sidebar Content -->
        <div class="sidebar col-md-3 col-12">
            <div class="section search">
                <h3>Поиск</h3>
                <form action="#" method="post">
                    <input type="text" name="search-term" class="text-input" placeholder="Type to search">
                </form>
            </div>
            <div class="section topics">
                <h3>Категории</h3>
                <ul>
                    <?php foreach ($topics as $key => $topic): ?>
                        <li>
                            <a href="<?=BASE_URL . 'category.php?id=' . $topic['topic_id']; ?>"><?=$topic['topic_name']; ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

        </div>
    </div>
</div>

<!-- Блок main END -->

<!-- Блок footer START -->

<?php include('app/include/footer.php'); ?>

<!-- Блок footer END -->



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
-->
</body>
</html>