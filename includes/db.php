<?php

class Database {
    public $pdo;
	
    public function __construct($db = "test", $user="root", $pwd="", $host="localhost") {
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pwd);
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected to database: [ $db ]\n";
        } catch(PDOException $e) {
            die("Connection failed: ") . $e->getMessage();
        }
    }
	
    public function execute($sql, $placeholder = null) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($placeholder);
        return $stmt;
    }
}

// $pdo = new Database();
?>