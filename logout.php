<?php
session_start();
setcookie('loggedIn','student',time()-99999999);
session_destroy();
header('Location:registration.php');