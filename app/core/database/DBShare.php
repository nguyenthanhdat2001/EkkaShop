<?php
class DBShare
{
    public $db;
    function __construct()
    {
        $this->db = new Database;
    }
}
