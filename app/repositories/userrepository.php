<?php
namespace App\Repositories;

use DateTime;

use PDO;
use App\Models\User;
use App\Models\Enums\UserType;


class UserRepository extends Repository {

    public function getAll() {
        $stmt = $this->connection->prepare("SELECT * FROM user");
        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $users = array_map(function ($row) {
            $user = new User();
            $user->id = (int)$row['id'];
            $user->hashed_password = $row['password_hash'];
            $user->email = $row['email_address'];
            $user->salt = $row['salt'];
            $user->type_of_user = UserType::from($row['type']); // Convert string to enum
            $user->first_name = $row['first_name']; 
            $user->last_name = $row['last_name'];
            $user->phone_number = $row['phone_number'];
            return $user;
        }, $rows);

        return $users;
    }
    public function getByEmail($email){
        $stmt = $this->connection->prepare("SELECT * FROM user WHERE email_address = :email_address");
        $stmt->execute([':email_address' => $email]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null; // User not found
        }

        $user = new User();
        $user->id = (int)$row['id'];
        $user->hashed_password = $row['password_hash'];
        $user->email = $row['email_address'];
        $user->salt = $row['salt'];
        $user->type_of_user = UserType::from($row['type']); // Convert string to enum
        $user->first_name = $row['first_name']; 
        $user->last_name = $row['last_name'];
        $user->phone_number = $row['phone_number'];
        return $user;
    }
    public function getById($id) {
        $stmt = $this->connection->prepare("SELECT * FROM user WHERE id = :id");
        $stmt->execute([':id' => $id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null; // User not found
        }

        $user = new User();
        $user->id = (int)$row['id'];
        $user->hashed_password = $row['password_hash'];
        $user->email = $row['email_address'];
        $user->salt = $row['salt'];
        $user->type_of_user = UserType::from($row['type']); // Convert string to enum
        $user->first_name = $row['first_name']; 
        $user->last_name = $row['last_name'];
        $user->phone_number = $row['phone_number'];
        return $user;
    }
    public function insert($user) {
        $stmt = $this->connection->prepare("INSERT INTO `user` (`password_hash`, `email_address`, `type`, `first_name`, `last_name`, `phone_number`, `salt`)
        VALUES (:password_hash, :email_address, :type_of_user, :first_name, :last_name, :phone_number, :salt)");

        $results = $stmt->execute([
            ':password_hash' => $user->hashed_password,
            ':email_address' => $user->email,
            ':type_of_user' => $user->type_of_user->jsonSerialize(), // Convert enum to string
            ':first_name' => $user->first_name,
            ':last_name' => $user->last_name,
            ':phone_number' => $user->phone_number,
            ':salt' => $user->salt
        ]);

        return $results;
    }
    public function update($user){
        $stmt = $this->connection->prepare("UPDATE user SET password_hash = :password_hash, email_address = :email_address, type = :type_of_user, first_name = :first_name, last_name = :last_name, phone_number = :phone_number, salt = :salt WHERE id = :id");

        $results = $stmt->execute([
            ':password_hash' => $user->hashed_password,
            ':email_address' => $user->email,
            ':type_of_user' => $user->type_of_user->jsonSerialize(), 
            ':first_name' => $user->first_name,
            ':last_name' => $user->last_name,
            ':phone_number' => $user->phone_number,
            ':salt' => $user->salt,
            ':id' => $user->id
        ]);

        return $results;
    }
    public function delete($id) {
        $stmt = $this->connection->prepare("DELETE FROM user WHERE id = :id");
    
        $results = $stmt->execute([
            ':id' => $id
        ]);
    
        return $results;
    }

    public function setToken($reset_token_hash, $reset_token_expires_at, $email) {
        $stmt = $this->connection->prepare("UPDATE user SET reset_token_hash = :reset_token_hash, reset_token_expires_at = :reset_token_expires_at WHERE email_address = :email_address");
    
        $results = $stmt->execute([
            ':reset_token_hash' => $reset_token_hash,
            ':reset_token_expires_at' => $reset_token_expires_at,
            ':email_address' => $email
        ]);
        return $results;
    }

    public function getByResetTokenHash($token_hash) {
        $stmt = $this->connection->prepare(
            "SELECT * FROM user WHERE reset_token_hash = :reset_token_hash AND reset_token_expires_at > NOW()"
        );
    
        $stmt->execute([':reset_token_hash' => $token_hash]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (!$row) {
            return null; // No matching user found
        }
    
        $user = new User();
        $user->id = (int)$row['id'];
        $user->email = $row['email_address'];
        $user->reset_token_hash = $row['reset_token_hash'];
        $user->reset_token_expires_at = new DateTime($row['reset_token_expires_at']); // Convert string to DateTime
    
        return $user;
    }

    
    public function updateUserPassword($email, $hashed_password, $salt) {
        $stmt = $this->connection->prepare("
            UPDATE user 
            SET password_hash = :password_hash, 
                salt = :salt
            WHERE email_address = :email_address
        ");

        //reset_token_hash = NULL, 
        //reset_token_expires_at = NULL 
    
        $results = $stmt->execute([
            ':password_hash' => $hashed_password,
            ':salt' => $salt,
            ':email_address' => $email
        ]);
        
    
        return $results;
    }

    public function updatePersonalInformation(User $user) {
        $stmt = $this->connection->prepare("
            UPDATE user 
            SET email_address = :email_address,
                first_name = :first_name,
                last_name = :last_name,
                phone_number = :phone_number
            WHERE id = :id
        ");
        return $stmt->execute([
            ':email_address' => $user->email,
            ':first_name'    => $user->first_name,
            ':last_name'     => $user->last_name,
            ':phone_number'  => $user->phone_number,
            ':id'            => $user->id
        ]);
    }

    public function updatePasswordInManageAccount($userId, $newHashedPassword, $newSalt) {
        $stmt = $this->connection->prepare("
            UPDATE user 
            SET password_hash = :password_hash,
                salt = :salt
            WHERE id = :id
        ");
        
        $result = $stmt->execute([
            ':password_hash' => $newHashedPassword,
            ':salt'          => $newSalt,
            ':id'            => $userId
        ]); 
        return $result;
    }

    

    

}