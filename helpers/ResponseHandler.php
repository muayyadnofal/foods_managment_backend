<?php

class Response
{
    // failure response function
    public function failure($message)
    {
        echo json_encode(
            array(
                'success' => false,
                'message' => $message
            )
        );
    }

    // success response function
    public function success($message)
    {
        echo json_encode(
            array(
                'success' => true,
                'message' => $message
            )
        );
    }

    // data response handler function
    public function returnData($key, $value, $message)
    {
        echo json_encode(
            array(
                'success' => true,
                'message' => $message,
                $key => $value
            )
        );
    }
}
