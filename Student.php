<?php

class Student
{
    public $name;
    public $secondName;
    public $group;
    public $score;
    public $email;

    function __construct($name, $secondName, $group, $score, $email)
    {
        $this->name = $name;
        $this->secondName = $secondName;
        $this->group = $group;
        $this->score = $score;
        $this->email = $email;
    }
}

