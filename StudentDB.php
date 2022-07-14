<?php

class StudentDB
{
    function addUser($user)
    {


        $conn = new PDO("mysql:host=localhost;port=3306;dbname=students", "root", "230476Igor");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("insert into Students (studentName, secondName, gruppa, score, email) values(:studentName,:secondName,:gruppa,:score,:email)");
        $stmt->bindValue('studentName', $user->name);
        $stmt->bindValue('secondName', $user->secondName);
        $stmt->bindValue('gruppa', $user->group);
        $stmt->bindValue('score', $user->score);
        $stmt->bindValue('email', $user->email);
        $stmt->execute();
        return $conn->lastInsertId();
    }

    function updateInfo($column, $newValue, $targetId)
    {
        $conn = new PDO("mysql:host=localhost;port=3306;dbname=students", "root", "230476Igor");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmnt = $conn->prepare("update Students set $column=:newVal where id=:tarId;");
        $stmnt->bindValue('newVal', $newValue);
        $stmnt->bindValue('tarId', $targetId);
        $stmnt->execute();
    }

    function emailExists($email)
    {
        $conn = new PDO("mysql:host=localhost;port=3306;dbname=students", "root", "230476Igor");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("select count(*) as rowCount from students where email=:email");
        $stmt->bindValue('email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch();
        return $row['rowCount'];
    }

    function fetchObject($x, $y)
    {
        $conn = new PDO("mysql:host=localhost;port=3306;dbname=students", "root", "230476Igor");
        $stmt = $conn->query("Select studentName, secondName, gruppa, score from students limit $x offset $y");
        $stmt->setFetchMode(PDO::FETCH_PROPS_LATE | PDO::FETCH_CLASS, "TableObj");
        return $stmt->fetchAll();
    }

    function studentCount()
    {
        $conn = new PDO("mysql:host=localhost;port=3306;dbname=students", "root", "230476Igor");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->query("Select count(*) as totalStudents from students;");
        return $stmt->fetch();
    }

    function sortByName($x, $y)
    {
        $conn = new PDO("mysql:host=localhost;port=3306;dbname=students", "root", "230476Igor");
        $stmt = $conn->query("Select studentName, secondName, gruppa, score from students order by studentName limit $x offset $y ");
        $stmt->setFetchMode(PDO::FETCH_PROPS_LATE | PDO::FETCH_CLASS, "TableObj");
        return $stmt->fetchAll();
    }

    function sortBysecondName($x, $y)
    {
        $conn = new PDO("mysql:host=localhost;port=3306;dbname=students", "root", "230476Igor");
        $stmt = $conn->query("Select studentName, secondName, gruppa, score from students order by secondName limit $x offset $y ");
        $stmt->setFetchMode(PDO::FETCH_PROPS_LATE | PDO::FETCH_CLASS, "TableObj");
        return $stmt->fetchAll();
    }

    function sortByGroup($x, $y)
    {
        $conn = new PDO("mysql:host=localhost;port=3306;dbname=students", "root", "230476Igor");
        $stmt = $conn->query("Select studentName, secondName, gruppa, score from students order by gruppa limit $x offset $y ");
        $stmt->setFetchMode(PDO::FETCH_PROPS_LATE | PDO::FETCH_CLASS, "TableObj");
        return $stmt->fetchAll();
    }

    function sortByScore($x, $y)
    {
        $conn = new PDO("mysql:host=localhost;port=3306;dbname=students", "root", "230476Igor");
        $stmt = $conn->query("Select studentName, secondName, gruppa, score from students order by score limit $x offset $y ");
        $stmt->setFetchMode(PDO::FETCH_PROPS_LATE | PDO::FETCH_CLASS, "TableObj");
        return $stmt->fetchAll();
    }

    function yourInfo($column,$insertId)
    {
        $conn = new PDO("mysql:host=localhost;port=3306;dbname=students", "root", "230476Igor");
        $stmt = $conn->prepare("Select $column from students where id= :insertId");
        $stmt->bindValue(':insertId', $insertId);
        $stmt->execute();
        return $stmt->fetch();
    }
    function search($keyword){
        $conn = new PDO("mysql:host=localhost;port=3306;dbname=students", "root", "230476Igor");
        $stmnt=$conn->prepare("select studentName, secondName, gruppa, score from students where studentName like :keyword or secondName like :keyword or  gruppa like :keyword or score like :keyword;");
        $stmnt->bindValue(':keyword', $keyword);
        $stmnt->setFetchMode(PDO::FETCH_PROPS_LATE | PDO::FETCH_CLASS, "TableObj");
        $stmnt->execute();
        return $stmnt->fetchAll();
    }
    function searchedStudentCount($keyword)
    {
        $conn = new PDO("mysql:host=localhost;port=3306;dbname=students", "root", "230476Igor");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("Select count(*) as totalStudents from students where studentName like :keyword or secondName like :keyword or  gruppa like :keyword or score like :keyword ;");
        $stmt->bindValue(':keyword',$keyword);
        $stmt->execute();
        return $stmt->fetch();
    }
}