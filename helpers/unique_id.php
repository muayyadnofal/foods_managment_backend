<?php

// unique han made id generator
function generateID($connection, $table, $id, $jump)
{
    // order all identifiers in the table to get the grater id
    $id = "SELECT " . $id . " FROM " . $table . " ORDER BY NULLIF(regexp_replace(" . $id . ", '\D', '', 'g'), '')::int DESC";
    // prepare the query statement
    $stmt = prepare($connection, $id);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // add  jump value for the grater id on the table
    return $row['fdgrp_cd'] + $jump;
}
