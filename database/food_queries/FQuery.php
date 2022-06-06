<?php

function foodQuery($string)
{
    $query = "SELECT 
        g.fddrp_desc,
        f.shrt_desc,
        f.ndb_no,
        f.long_desc,
        f.fdgrp_cd,
        n.ndb_no,
        n.nutr_no,
        n.nutr_val,
        n.num_data_pts
    FROM
        food_des f
    LEFT JOIN
        fd_group g ON f.fdgrp_cd = g.fdgrp_cd

    LEFT JOIN 
        nut_data n ON f.ndb_no = n.ndb_no ";

    return $query . $string;
}

function foodsQuery($string)
{
    $query = 'SELECT 
            g.fddrp_desc, /* food group description */
            f.ndb_no, /* food id */
            f.shrt_desc, /* food description */
            f.fdgrp_cd /* food group id */
        FROM
            food_des f
        LEFT JOIN
            fd_group g ON f.fdgrp_cd = g.fdgrp_cd ';
    return $query . $string;
}
