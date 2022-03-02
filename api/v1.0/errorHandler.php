<?php


class ErrorHandler {
    public static function MakeError($err , $arrErr, $code) {
        http_response_code($code);
        echo json_encode( array( 
            "Error" => $err,
            "type" => $arrErr,
            "code" => $code
         ));
        exit();
    }
}