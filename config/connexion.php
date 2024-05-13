<?php
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'easyrecruit';

    try {
        $pdo = new PDO(
            "mysql:host=$servername;dbname=$dbname",
            $username,
            $password
        );
            
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

       // echo "Connected successfully";
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    class Connection
    {
        private static $pdo = null;
    
        public static function getConnection()
        {
            if (!isset($pdo)) {
                try {
                    self::$pdo = new PDO("mysql:host=localhost;dbname=signup;", 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
                } catch (PDOException $e) {
                    die("Erreur " . $e->getMessage());
                }
            }
            return self::$pdo;
        }
    }

?>
