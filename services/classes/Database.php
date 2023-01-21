<?php

class Database {

    //<--- Database: Localhost --->///
    private static $DB_HOST     = 'localhost';
    private static $DB_USERNAME = 'root';
    private static $DB_PASSWORD = '';
    private static $DB_NAME     = 'digio';

    private static $connect = null;
    private static $response = true;

    //<--- Database: Connection --->///
    public static function connect() {
        try {
            self::$connect = new PDO('mysql:host='.self::$DB_HOST.';
                                dbname='.self::$DB_NAME.';
                                charset=utf8', 
                                self::$DB_USERNAME,
                                self::$DB_PASSWORD);
            self::$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$connect->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            return self::$connect;
        } catch(PDOException $error) {
            // echo "Connection Failed: ";
            // echo $error->getMessage();
            exit();
        }
    }

    //<--- Database: Query --->///
    public static function query($query = null, $params = array()) {
        if (self::$connect instanceof PDO) {
            try {
                $statement = self::$connect->prepare($query);
                $statement->execute($params);
                $command = strtoupper(explode(' ', $query)[0]);
                switch ($command) {
                    case 'SELECT':
                        self::$response = $statement->fetchAll(PDO::FETCH_OBJ);
                        break;
                    case 'INSERT':
                        self::$response = self::$connect->lastInsertId();
                        break;
                    default:
                        self::$response = $statement->rowCount();
                }
                return self::$response;
            } catch (Throwable $error) {
                http_response_code(500);
                // echo "Query Error: ";
                // echo $error->getMessage();
                exit();
            }
        } else {
            http_response_code(500);
            // echo "Unable to connect to database";
            exit();
        }
    }
}

Database::connect();