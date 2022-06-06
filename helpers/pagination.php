<?php

// offset calculator 
function getOffset($items)
{
    // set the current number
    isset($_GET['page']) ? $page = $_GET['page'] : $page = 1;
    // calculate the offset by the current page number
    $offset = ($page - 1) * $items;
    return $offset;
}

// total pages count on a table calculator
function getTotalPages($connection, $table, $per_page)
{
    // getting the number of rows query
    $count = 'SELECT count(*) AS count FROM ' . $table;
    // preparing the query statement
    $row_count = prepare($connection, $count)->fetch();
    $count = $row_count['count'];

    // calculate the total number of pages
    return ceil($count / $per_page);
}
