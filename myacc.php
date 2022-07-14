<?php
session_start();
include_once('./header.php');
spl_autoload_register(function ($class) {
    if(file_exists($class.'.php')) include_once($class.'.php');
});
if(!isset($_COOKIE['loggedIn'])){
    header('Location: ./registration.php');
}
$insertId=$_COOKIE['loggedIn'];
$studDb=new StudentDB();
$name=$studDb->yourInfo('studentName',$insertId);
$secondName=$studDb->yourInfo('secondName',$insertId);
$group=$studDb->yourInfo('gruppa',$insertId);
$score=$studDb->yourInfo('score',$insertId);
?>
<h2>Часик в радость, чифир в сладость, <?php echo $name['studentName'] ?></h2>
<ul>
<li> Фамилия: <?php echo $secondName['secondName']?> </li>
<li> Группа: <?php echo $group['gruppa'] ?> </li>
<li> Кол-во баллов: <?php echo $score['score'] ?> </li>
</ul>
<h2>Изменение данных</h2>
<form action="userUpdate.php" method="post">
    <p>Изменить имя: <input type="text" name="nameUpd"></p>
    <p>Изменить фамилию: <input type="text" name="secondNameUpd"></p>
    <p>Изменить номер группы: <input type="text" name="groupUpd"></p>
    <p>Изменить количество баллов: <input type="number" name="scoreUpd"></p>
    <input type="submit" value="Подтвердить">
</form>
<form action="logout.php" method="get">
    <input type="submit" value="Добавить нового пользователя">
</form>
