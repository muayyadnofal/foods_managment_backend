<?php

// prepare query statement function
function prepare($connection, $query)
{
    $stmt = $connection->prepare($query);
    $stmt->execute();
    return $stmt;
}

// prepare query statement function based on input param
function prepareP($connection, $query, $param)
{
    $stmt = $connection->prepare($query);
    $stmt->bindParam(1, $param);
    $stmt->execute();
    return $stmt;
}

// prepare query statement function based on input value
function prepareV($connection, $query, $input, $value)
{
    $stmt = $connection->prepare($query);
    $stmt->bindValue($input, $value);
    if ($stmt->execute()) return true;

    printf("Error: %s. \n", $stmt->error);
    return false;
}
