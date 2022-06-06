<?php

class NutResource
{
    private $result;

    // passing the result from the execution on the query
    public function __construct($result)
    {
        $this->result = $result;
    }

    public function nutResponse() {
        $nut_data = array();    
        while ($row = $this->result->fetch(PDO::FETCH_ASSOC)){
            array_push($nut_data, $row['nutr_val']);
        }
        return array(
            'carbohydrate' => $nut_data[0],
            'energy' => $nut_data[1],
            'caffeine' => $nut_data[2],
            'theobromine' => $nut_data[3],
            'sugar' => $nut_data[4],
        );
    }
}
