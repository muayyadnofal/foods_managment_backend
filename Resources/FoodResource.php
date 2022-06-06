<?php

class FoodResource
{
    private $result;

    // passing the result from the execution on the query
    public function __construct($result)
    {
        $this->result = $result;
    }

    // foods response 
    public function foodsResponse()
    {
        $foods_array = array();
        // fetching the data from the result which contains all fetched data from the query
        while ($row = $this->result->fetch(PDO::FETCH_ASSOC)) {
            // extracting a single row to use its properties from the variables defined in Food model
            extract($row);

            $food_item = array(
                'id' => $ndb_no,
                'group_id' => $fdgrp_cd,
                'description' => $shrt_desc,
                'group_description' => $fddrp_desc,
            );

            array_push($foods_array, $food_item);
        }
        // return handled information data in an array
        return $foods_array;
    }

    // one food item response
    public function foodResponse()
    {
        $row = $this->result->fetch(PDO::FETCH_ASSOC);
        $food_item = array(
            'id' => $row['ndb_no'],
            'group_id' => $row['fdgrp_cd'],
            'description' => $row['long_desc'],
            'group_description' => $row['fddrp_desc'],
            'nutr' => [
                'nutr_no' => $row['nutr_no'],
                'nutr_val' => $row['nutr_val'],
                'num_data_pts' => $row['num_data_pts']
            ]
        );
        return $food_item;
    }
}
