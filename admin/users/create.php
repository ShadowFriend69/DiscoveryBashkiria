<?php
    include '../../app/database/db.php';
    include '../../app/controllers/users.php';
    include '../../path.php';

// session_start();
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

<?php include('../../app/include/header-admin.php'); ?>

<!-- Блок HEADER END -->


<!-- Блок MAIN START -->

<div class="container">
    <?php include "../../app/include/sidebar-admin.php"; ?>
        <div class="posts col-10">
            <div class="button-row">
                <a href="<?php echo BASE_URL . "admin/users/create.php"; ?>" class="col-2 btn btn-success">Добавить</a>
                <span class="col-1"></span>
                <a href="<?php echo BASE_URL . "admin/users/index.php"; ?>" class="col-2 btn btn-warning">Редактировать</a>
            </div>
            <div class="row title-table">
                <h2>Добавление пользователя</h2>
            </div>
            <div class="row add-post">
                <form action="create.php" method="post">
                    <div class="col">
                        <label for="formGroupExampleInput" class="form-label">Ваш логин</label>
                        <input name="login" value="<?=$login?>" type="text" class="form-control" id="formGroupExampleInput">
                    </div>
                    <div class="col">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input name="email" value="<?=$email?>" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="col">
                        <label for="exampleInputPassword1" class="form-label">Пароль</label>
                        <input name="password-first" type="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="col">
                        <label for="exampleInputPassword2" class="form-label">Повторите пароль</label>
                        <input name="password-second" type="password" class="form-control" id="exampleInputPassword2">
                    </div>
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        <option value="1">User</option>
                        <option value="2">Admin</option>
                    </select>
                    <div class="col">
                        <button class="btn btn-primary" type="submit">Добавить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Блок MAIN START -->



<!-- Блок footer START -->

<?php include('../../app/include/footer.php'); ?>

<!-- Блок footer END -->



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
-->
</body>
</html>
