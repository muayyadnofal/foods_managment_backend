<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/amescom_foods';
require $path . '/database/prepare.php';

function addCascadeDelete($connection, $table1, $table2, $fk, $key) {
    $query = "
        ALTER TABLE " . $table1 ."
        DROP CONSTRAINT ". $fk .",
        ADD CONSTRAINT ". $fk ."
        FOREIGN KEY (". $key .")
        REFERENCES ". $table2 ."(". $key .")
           ON DELETE CASCADE";
    prepare($connection, $query);
}

function handleDelete($connection) {
    addCascadeDelete($connection, 'food_des', 'fd_group', 'food_des_fdgrp_cd_fkey', 'fdgrp_cd');
    addCascadeDelete($connection, 'nut_data', 'food_des', 'nut_data_ndb_no_fkey', 'ndb_no');
    addCascadeDelete($connection, 'weight', 'food_des', 'weight_ndb_no_fkey', 'ndb_no');
    addCascadeDelete($connection, 'datsrcln', 'nut_data', 'datsrcln_ndb_no_fkey', 'ndb_no, nutr_no');
}