<?php
// The singleton pattern (Mẫu này giúp chỉ kết nối database 1 lần duy nhất)

class Connection
{
    // public $conn;
    private static $instance = null;

    private function __construct($dbConfig)
    {
        try {
            $dsn = "mysql:host={$dbConfig['host']};dbname={$dbConfig['db']};charset=utf8";

            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ];

            $conn = new PDO($dsn, $dbConfig['user'], $dbConfig['password'] ?? '', $options);
            self::$instance = $conn;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance($dbConfig)
    {
        if (self::$instance == null) {
            new Connection($dbConfig);
        }

        return self::$instance;
    }
}
