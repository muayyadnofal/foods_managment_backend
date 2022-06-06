<?php

$path = $_SERVER['DOCUMENT_ROOT'] . '/amescom_foods';
require $path . '/database/prepare.php';

class Nut {
    private $connection;

    // nut_data table properties
    public $nutr_val;

    // Nut model constructor __ setting the db connection to prepare queries in this model
    public function __construct($db)
    {
        $this->connection = $db;
    }

    // get nut info for a food
    public function read_nut()
    {
        $query = "SELECT nutr_val FROM nut_data WHERE ndb_no = ?";
        return prepareP($this->connection, $query, $this->ndb_no);
    }
}