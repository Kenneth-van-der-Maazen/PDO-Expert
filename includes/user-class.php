<?php
require "db.php";

class User {
    private $pdo;

    public function __construct() {
        $this->pdo = new Database();
    }

    // Functie om nieuwe gebruiker te registreren
    public function registerUser(String $name, String $email, String $password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $this->pdo->execute(
            "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)",
            ["name"=>$name, "email"=>$email, "password"=>$hash]
        );        
    }

    // Functie om in te loggen met een gebruikersnaam en wachtwoord
    public function loginUser($name) {
        return $this->pdo->execute("SELECT * FROM users WHERE name = :name", ["name"=>$name])->fetch();
    }


}