<?php
session_start();
spl_autoload_register(function ($class) {
    if(file_exists($class.'.php')) include_once($class.'.php');
}
);
$studentDb=new StudentDB();

if (isset($_POST['name']) && strlen(trim($_POST['name'])) > 2) {
    $name = $_POST['name'];
} else {
    $_SESSION['name_error'] = 'Введите корректное имя';
    header('Location:registration.php');
    exit;
}
if (isset($_POST['secondName']) && strlen(trim($_POST['secondName'])) > 2) {
    $secondName = $_POST['secondName'];
} else {
    $_SESSION['secondName_error'] = 'Введите корректную фамилию';
    header('Location:registration.php');
    exit;
}
if (isset($_POST['group']) && strlen(trim($_POST['group'])) > 3 && strlen(trim($_POST['group'])) < 5) {
    $group = $_POST['group'];
} else {
    $_SESSION['group_error'] = 'Введите корректный номер группы';
    header('Location:registration.php');
    exit;
}
if (isset($_POST['score']) && $_POST['score'] > 0 && $_POST['score']<=300) {
    $score = $_POST['score'];
} else {
    $_SESSION['score_error'] = 'Введите корректное количество баллов';
    header('Location:registration.php');
    exit;
}
if (isset($_POST['email'])&& $studentDb->emailExists($_POST['email'])==0 &&strlen(trim($_POST['email']))>4){
    $email=$_POST['email'];
} else{
    $_SESSION['email_error']='Введите корректный email';
    header('Location:registration.php');
    exit;

}
$student = new Student($name, $secondName, $group, $score,$email);
$insertId=$studentDb->addUser($student);
setcookie('loggedIn',$insertId, time()+99999999);
header('Location: myacc.php');






