<?php
session_start();
include_once('./header.php');

?>
    <form action="usercheck.php" method="post">
        <p>Ваше имя:</p><input type="text" name="name">
        <div class="text-danger"><?php if (isset($_SESSION['name_error'])) echo $_SESSION['name_error'] ?></div>
        <p>Ваша фамилия: </p><input type="text" name="secondName">
        <div class="text-danger"><?php if (isset($_SESSION['secondName_error'])) echo $_SESSION['secondName_error'] ?></div>
        <p>Ваш номер группы:</p><input type="text" name="group">
        <div class="text-danger"><?php if (isset($_SESSION['group_error'])) echo $_SESSION['group_error'] ?></div>
        <p>Ваше количество баллов:</p><input type="number" name="score">
        <div class="text-danger"><?php if (isset($_SESSION['score_error'])) echo $_SESSION['score_error'] ?></div>
        <p>Ваше email: </p><input type="email" name="email">
        <div class="text-danger"><?php if (isset($_SESSION['email_error'])) echo $_SESSION['email_error'] ?></div>
        <p></p><input type="submit" value="Отправить">
        <div class="text-danger"
    </form>
<?php
session_destroy();
?>