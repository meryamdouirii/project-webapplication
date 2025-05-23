<?php
namespace App\Services;
use App\Models\User;

class UserService {
    public function getAll() {
        $repository = new \App\Repositories\UserRepository();
        return $repository->getAll();
    }
    public function getById($id){
        $repository = new \App\Repositories\UserRepository();
        return $repository->getById($id);
    }
    public function getByEmail($email){
        $repository = new \App\Repositories\UserRepository();
        return $repository->getByEmail($email);
    }
    public function getByOrderId($orderId) : ?User{
        $repository = new \App\Repositories\UserRepository();
        return $repository->getByOrderId($orderId);
    }
    public function insert($user) {
        $repository = new \App\Repositories\UserRepository();
        return $repository->insert($user);
    }
    public function update($user) {
        $repository = new \App\Repositories\UserRepository();
        return $repository->update($user);
    }
    public function delete($id) {
        $repository = new \App\Repositories\UserRepository();
        return $repository->delete($id);
    }
    public function setToken($reset_token_hash, $reset_token_expires_at, $email){
        $repository = new \App\Repositories\UserRepository();
        return $repository->setToken($reset_token_hash, $reset_token_expires_at, $email);
    }
    public function getByResetTokenHash($token_hash) {
        $repository = new \App\Repositories\UserRepository();
        return $repository->getByResetTokenHash($token_hash);
    }
    
    public function updateUserPassword($email, $hashed_password, $salt){ 
        $repository = new \App\Repositories\UserRepository();
        return $repository->updateUserPassword($email, $hashed_password, $salt);
    }

    public function updatePersonalInformation($user){
        $repository = new \App\Repositories\UserRepository();
        return $repository->updatePersonalInformation($user);
    }

    public function updatePasswordInManageAccount($userId, $newHashedPassword, $newSalt){
        $repository = new \App\Repositories\UserRepository();
        return $repository->updatePasswordInManageAccount($userId, $newHashedPassword, $newSalt);
    }


    

}