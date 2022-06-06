<?php

$path = $_SERVER['DOCUMENT_ROOT'] . '/amescom_foods';
require $path . '/database/prepare.php';
require $path . '/helpers/unique_id.php';

class FoodGroup
{
    private $connection;
    private $table = 'fd_group';

    // fd_group table properties
    public $fdgrp_cd;
    public $fddrp_desc;
    public $handled = false;

    // FoodGroup model constructor __ setting the db connection to prepare queries in this model
    public function __construct($db)
    {
        $this->connection = $db;
    }

    // get all food groups data from food_des table 
    public function read()
    {
        if (!$this->handled) {
            $this->handleDelete();
            $this->handled = true;
        }
        // preparing the query which gets all food groups data
        $query = 'SELECT g.fdgrp_cd, g.fddrp_desc FROM ' . $this->table . ' g ';
        return prepare($this->connection, $query);
    }

    // create group food 
    public function create()
    {
        // generate a unique_id for the new food group row
        $id = generateID($this->connection, 'fd_group', 'fdgrp_cd', 100);
        $query = 'INSERT INTO ' . $this->table . "(fdgrp_cd, fddrp_desc) VALUES (" . $id . ", :description)";
        return prepareV($this->connection, $query, ':description', $this->fddrp_desc);
    }

    public function delete()
    {
        $query = 'DELETE FROM ' . $this->table . ' WHERE fdgrp_cd = ?';
        return prepareP($this->connection, $query, $this->fdgrp_cd);
    }

    public function addCascadeDelete($table1, $table2, $fk, $key)
    {
        $query = "
        ALTER TABLE " . $table1 . "
        DROP CONSTRAINT " . $fk . ",
        ADD CONSTRAINT " . $fk . "
        FOREIGN KEY (" . $key . ")
        REFERENCES " . $table2 . "(" . $key . ")
           ON DELETE CASCADE
        ";
        prepare($this->connection, $query);
    }

    public function handleDelete()
    {
        $this->addCascadeDelete('food_des', 'fd_group', 'food_des_fdgrp_cd_fkey', 'fdgrp_cd');
        $this->addCascadeDelete('nut_data', 'food_des', 'nut_data_ndb_no_fkey', 'ndb_no');
        $this->addCascadeDelete('weight', 'food_des', 'weight_ndb_no_fkey', 'ndb_no');
        $this->addCascadeDelete('datsrcln', 'nut_data', 'datsrcln_ndb_no_fkey', 'ndb_no, nutr_no');
        $this->addCascadeDelete('footnote', 'food_des', 'footnote_ndb_no_fkey', 'ndb_no');
    }
}
