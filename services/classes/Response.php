<?php 

class Response {
    public static function success($result = [], $message = "success", $code = 200) {
        $response = array( 
            'status'     => true,
            'result'     => $result,
            'message'    => $message,
        );
        http_response_code($code);
        echo json_encode($response);
    }
    public static function error($errorMessage = "error", $code = 404) {
        $response = array( 
            'status'  => false,
            'message' => $errorMessage,
        );
        http_response_code($code);
        echo json_encode($response);
    }
}