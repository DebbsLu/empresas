<?php

class Database {
    private static $host = "localhost";
    private static $user = "root";
    private static $pass = "";
    private static $db   = "incorporate_1"; // Eliminé el punto y coma extra
    private static $conn;

    public static function connect() {
        if (!self::$conn) {
            try {
                $dsn = "mysql:host=" . self::$host . ";dbname=" . self::$db . ";charset=utf8mb4";
                
                $options = [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ];

                self::$conn = new PDO($dsn, self::$user, self::$pass, $options);
            } catch (PDOException $e) {
                die("Error de conexión: " . $e->getMessage());
            }
        }
        return self::$conn;
    }
}