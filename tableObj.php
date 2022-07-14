<?php

class TableObj
{
    public $studentName;
    public $secondName;
    public $gruppa;
    public $score;

    function __construct($studentName = '')
    {
        $this->studentName = $studentName;
    }
}