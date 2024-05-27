<?php

class Menu{

private $db;

public function __construct()
{
    $this->db = Database::getInstance()->getConnect();
}



}