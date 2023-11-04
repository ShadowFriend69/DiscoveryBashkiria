<?php include('path.php'); ?>
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
            <h2>О компании</h2>
            <div class="about row">
                <div class="about_text col-12">
                    <p>Миссия и ценности вашей компании.</p>
                    <p>Краткое описание вашей деятельности и специализации.</p>

                    <h4>История</h4>
                    <p>История создания компании или организации.</p>
                    <p>Значимые события и достижения.</p>
                    <p>Важные этапы развития.</p>

                    <h4>Команда</h4>
                    <p>Сведения о ключевых членах команды: имена, должности, фотографии.</p>
                    <p>Биографии сотрудников, их опыт и достижения.</p>

                    <h4>Наши ценности</h4>
                    <p>Подробное описание ценностей, которыми руководствуется ваша компания.</p>
                    <p>Какие принципы и убеждения лежат в основе ваших действий и решений.</p>

                    <h4>Достижения и награды</h4>
                    <p>При необходимости укажите награды, сертификаты и достижения вашей компании.</p>

                    <h4>Контактная информация</h4>
                    <p>Адрес офиса (если есть).</p>
                    <p>Номера телефонов.</p>
                    <p>Адрес электронной почты.</p>
                    <p>Ссылки на социальные сети и другие способы связи.</p>

                    <h4>Философия и подход</h4>
                    <p>Расскажите о вашей философии в работе и вашем подходе к клиентам или проектам.</p>

                    <h4>Клиенты и партнеры</h4>
                    <p>Укажите информацию о ваших клиентах и партнерах, если это подходит к вашей деятельности.</p>

                    <h4>Фотографии и видео</h4>
                    <p>Добавьте фотографии вашей команды, офиса или деятельности компании.</p>
                    <p>Включите видеоролики, если есть.</p>

                    <h4>Карта и схема проезда</h4>
                    <p>Если у вас есть офис или местонахождение, предоставьте карту и схему проезда для удобства клиентов.</p>

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
                    <li><a href="#">По Уфе</a></li>
                    <li><a href="#">По Уфе</a></li>
                    <li><a href="#">По Уфе</a></li>
                    <li><a href="#">По Уфе</a></li>
                    <li><a href="#">По Уфе</a></li>
                    <li><a href="#">По Уфе</a></li>
                    <li><a href="#">По Уфе</a></li>
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