<?php

class FoodGroupResource
{
    private $result;

    // passing the result from the execution on the query
    public function __construct($result)
    {
        $this->result = $result;
    }

    // foodGroups response 
    public function foodGroupResponse()
    {
        $foodGroups_array = array();
        // fetching the data from the result which contains all fetched data from the query
        while ($row = $this->result->fetch(PDO::FETCH_ASSOC)) {
            // extracting a single row to use its properties from the variables defined in FoodGroup model
            extract($row);

            $foodGroup_item = array(
                'id' => $fdgrp_cd,
                'description' => $fddrp_desc
            );

            array_push($foodGroups_array, $foodGroup_item);
        }
        // return handled information data in an array
        return $foodGroups_array;
    }
}
