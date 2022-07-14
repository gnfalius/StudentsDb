<?php
session_start();
spl_autoload_register(function ($class) {
    if(file_exists($class.'.php')) include_once($class.'.php');
});
$studDb= new StudentDB;
$targetId=$_COOKIE['loggedIn'];
if(isset($_POST['nameUpd'])&&strlen(trim(htmlspecialchars($_POST['nameUpd'])))>2){
    $newInfo=$_POST['nameUpd'];
    $studDb->updateInfo('studentName',$newInfo,$targetId);
}
if(isset($_POST['secondNameUpd'])&&strlen(trim(htmlspecialchars($_POST['secondNameUpd'])))>2){
    $newInfo=$_POST['secondNameUpd'];
    $studDb->updateInfo('secondName',$newInfo,$targetId);
}
if(isset($_POST['groupUpd'])&&strlen(trim(htmlspecialchars($_POST['groupUpd'])))>3){
    $newInfo=$_POST['groupUpd'];
    $studDb->updateInfo('gruppa',$newInfo,$targetId);
}
if(isset($_POST['scoreUpd'])&&htmlspecialchars($_POST['scoreUpd'])>0){
    $newInfo=$_POST['scoreUpd'];
    $studDb->updateInfo('score',$newInfo,$targetId);
}
header('location: myacc.php');
