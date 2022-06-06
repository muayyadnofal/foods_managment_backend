<?php

$path = $_SERVER['DOCUMENT_ROOT'] . '/amescom_foods';
require $path . '/database/food_queries/FQuery.php';
require $path . '/database/prepare.php';
require $path . '/helpers/pagination.php';

class Food
{
    private $connection;

    // food_des table properties
    public $ndb_no;
    public $fdgrp_cd;
    public $fddrp_desc;
    public $long_desc;
    public $shrt_desc;

    // nut_data table properties
    public $nutr_no;
    public $nutr_val;
    public $num_data_pts;

    // Food model constructor __ setting the db connection to prepare queries in this model
    public function __construct($db)
    {
        $this->connection = $db;
    }

    // get all foods data from food_des table
    public function getAll()
    {
        // preparing the query which gets all foods data
        return prepare($this->connection, foodsQuery(null));
    }

    // getting a single food info based on food_id
    public function getOne()
    {
        $getOne = 'WHERE f.ndb_no = ? LIMIT 1';
        return prepareP($this->connection, foodQuery($getOne), $this->ndb_no);
    }

    // paginate the food_des table data to get only 20 food items
    public function paginate()
    {
        $paginate = 'LIMIT 20 OFFSET ' . getOffset(20);
        return prepare($this->connection, foodsQuery($paginate));
    }

    // search for foods by its short description
    public function search()
    {
        $search = "WHERE f.shrt_desc LIKE '%' ||?|| '%'";
        return prepareP($this->connection, foodsQuery($search), $this->shrt_desc);
    }

    // sort all foods in the page
    public function sort()
    {
        $sort = "ORDER BY f.shrt_desc ASC LIMIT 20 OFFSET " . getOffset(20);
        return prepare($this->connection, foodsQuery($sort));
    }
}
