<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Список абитуриентов</title>

</head>
<body>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<header>
    <a href="./index.php"> Главная страница</a>
    <?php if (!isset($_COOKIE['loggedIn'])) {

        echo '  <a href="./registration.php"> Зарегистрироваться</a >';
    }
    if (isset($_COOKIE['loggedIn'])) {

        echo ' <a href ="./myacc.php"> Отредактировать данные </a >';
    }
    ?>
</header>
</body>
</html>