<?php
namespace App\Services;

class AuthService
{
    public function hashPassword($password)
    {
        $salt = bin2hex(random_bytes(16)); 
        $hashedPassword = hash('sha256', $password . $salt); 
        return ['hashed_password' => $hashedPassword, 'salt' => $salt];
    }

    public function verifyPassword($password, $storedHash, $storedSalt)
    {
        $hashedPassword = hash('sha256', $password . $storedSalt);
        return $hashedPassword === $storedHash;
    }
}

