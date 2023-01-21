<?php

class Request {
    public static function getParam($key = '') {
        $request = isset($_GET[$key]) ? self::clean($_GET[$key]) : null;
        return $request;
    }
    public static function getMethod() {
        return strtoupper($_SERVER['REQUEST_METHOD']);
    }
    public static function clean($data) {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                unset($data[$key]);
                $data[self::clean($key)] = self::clean($value);
            }
        } else {
            $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
        }
        return $data;
    }
}