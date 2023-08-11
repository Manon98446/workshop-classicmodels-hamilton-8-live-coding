<?php
declare(strict_types=1);

namespace Models;

use PDO;

class User extends Database
{
    public function userLogin(string $username): array
    {
        $stmt = $this->query(
            "SELECT * FROM users WHERE username = ?",
            [$username]
        );
        $user=$stmt->fetch(PDO::FETCH_ASSOC);
        return $user; 
    }
    public function userInsert($username, $email, $passwordHash){
        $this->query(
            "
                INSERT INTO users (username, email, password) 
                VALUES (?, ?, ?)
            ",
            [$username, $email, $passwordHash]
        );
    }
}