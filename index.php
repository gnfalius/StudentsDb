<?php
session_start();
require_once('./header.php');
spl_autoload_register(function ($class) {
    if (file_exists($class . '.php')) include_once($class . '.php');
});
$studDB = new StudentDB;
$totalStuds = $studDB->studentCount();
echo "Всего абитуриентов: " . $totalStuds['totalStudents'];
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else $page = 1;
$rowsPerPage = 3;
?>
<link rel="stylesheet" href="search.css">
<header>
    <div class="raz">
        <form action="index.php" method="get"><input type="textarea" placeholder="Поиск" name="keywords"> <input
                    type="submit" value="Найти"></form>
    </div>
</header>
<?php
if (!isset($_GET['keywords'])) $totalPages = ceil($totalStuds['totalStudents'] / $rowsPerPage);
else {
    $keywords = $_GET['keywords'];
    $totalSearchedStuds = $studDB->searchedStudentCount($keywords);
    $totalPages = ceil($totalSearchedStuds['totalStudents'] / $rowsPerPage);
}
if (isset($_GET['keywords'])) {
    $keywords = $_GET['keywords'];
    $arr = $studDB->search($keywords);
} else if (isset($_GET['sortByName'])) {
    $arr = $studDB->sortByName($rowsPerPage, ($page * $rowsPerPage) - $rowsPerPage);
    $_SESSION['sortByName'] = 'on';
    unset($_SESSION['sortBySecondName']);
    unset($_SESSION['sortByGroup']);
    unset($_SESSION['sortByScore']);
} else if (isset($_GET['sortBySecondName'])) {
    $arr = $studDB->sortBySecondName($rowsPerPage, ($page * $rowsPerPage) - $rowsPerPage);
    $_SESSION['sortBySecondName'] = 'on';
    unset($_SESSION['sortByName']);
    unset($_SESSION['sortByGroup']);
    unset($_SESSION['sortByScore']);
} else if (isset($_GET['sortByGroup'])) {
    $arr = $studDB->sortByGroup($rowsPerPage, ($page * $rowsPerPage) - $rowsPerPage);
    $_SESSION['sortByGroup'] = 'on';
    unset($_SESSION['sortBySecondName']);
    unset($_SESSION['sortByGroup']);
    unset($_SESSION['sortByName']);
} else if (isset($_GET['sortByScore'])) {
    $arr = $studDB->sortByScore($rowsPerPage, ($page * $rowsPerPage) - $rowsPerPage);
    $_SESSION['sortByScore'] = 'on';
    unset($_SESSION['sortBySecondName']);
    unset($_SESSION['sortByGroup']);
    unset($_SESSION['sortByName']);
} else if (isset($_SESSION['sortByName'])) {
    $arr = $studDB->sortByName($rowsPerPage, ($page * $rowsPerPage) - $rowsPerPage);
} else if (isset($_SESSION['sortBySecondName'])) {
    $arr = $studDB->sortBySecondName($rowsPerPage, ($page * $rowsPerPage) - $rowsPerPage);
} else if (isset($_SESSION['sortByGroup'])) {
    $arr = $studDB->sortByGroup($rowsPerPage, ($page * $rowsPerPage) - $rowsPerPage);
} else if (isset($_SESSION['sortByScore'])) {
    $arr = $studDB->sortByScore($rowsPerPage, ($page * $rowsPerPage) - $rowsPerPage);
} else $arr = $studDB->fetchObject($rowsPerPage, ($page * $rowsPerPage) - $rowsPerPage);
if (empty($arr)) echo "Пользователь не найден";
else {
    echo "<table class='table table-bordered'>
<tr><thead class='thead-dark'>
<th><form action='index.php' method='get'><input type='submit' class='btn btn-light' value='Имя' name='sortByName' ></th>
<th><input type='submit' class='btn btn-light' value='Фамилия' name='sortBySecondName'></th>
<th><input type='submit' class='btn btn-light' value='Группа' name='sortByGroup'></th>
<th><input type='submit' class='btn btn-light' value='Кол-во баллов' name='sortByScore'></th></thead></tr></form> ";
    foreach ($arr as $row => $value) {
        echo "<tr>";
        echo "<td>" . $value->studentName . "</td>";
        echo "<td>" . $value->secondName . "</td>";
        echo "<td>" . $value->gruppa . "</td>";
        echo "<td>" . $value->score . "</td>";
    }
    echo "</table>";
    if ($totalPages > 1) {
        echo "Страницы: ";
        for ($i = 1; $i <= $totalPages; $i++) {
            echo "<a href=index.php?page=$i class='link-secondary'>$i  </a>";
        }
    }
}
?>

