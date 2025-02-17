<?php
namespace App\Models;
use App\Models\Enums\UserType;
use JsonSerializable;

class User implements JsonSerializable {

    public int $id;
    public UserType $type_of_user;   
    public ?string $first_name;
    public ?string $last_name;
    public ?string $phone_number;
    public string $email;
    public string $hashed_password; 
    public string $salt;

    /**
     * Get the value of id
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * Set the value of id
     * @param int $id
     * @return self
     */
    public function setId(int $id): self {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the value of type_of_user
     * @return UserType
     */
    public function getTypeOfUser(): UserType {
        return $this->type_of_user;
    }

    /**
     * Set the value of type_of_user
     * @param UserType $type_of_user
     * @return self
     */
    public function setTypeOfUser(UserType $type_of_user): self {
        $this->type_of_user = $type_of_user;
        return $this;
    }

    /**
     * Get the value of first_name
     * @return ?string
     */
    public function getFirstName(): ?string {
        return $this->first_name;
    }

    /**
     * Set the value of first_name
     * @param ?string $first_name
     * @return self
     */
    public function setFirstName(?string $first_name): self {
        $this->first_name = $first_name;
        return $this;
    }

    /**
     * Get the value of last_name
     * @return ?string
     */
    public function getLastName(): ?string {
        return $this->last_name;
    }

    /**
     * Set the value of last_name
     * @param ?string $last_name
     * @return self
     */
    public function setLastName(?string $last_name): self {
        $this->last_name = $last_name;
        return $this;
    }

    /**
     * Get the value of phone_number
     * @return ?string
     */
    public function getPhoneNumber(): ?string {
        return $this->phone_number;
    }

    /**
     * Set the value of phone_number
     * @param ?string $phone_number
     * @return self
     */
    public function setPhoneNumber(?string $phone_number): self {
        $this->phone_number = $phone_number;
        return $this;
    }

    /**
     * Get the value of email
     * @return string
     */
    public function getEmail(): string {
        return $this->email;
    }

    /**
     * Set the value of email
     * @param string $email
     * @return self
     */
    public function setEmail(string $email): self {
        $this->email = $email;
        return $this;
    }

    /**
     * Get the value of hashed_password
     * @return string
     */
    public function getHashedPassword(): string {
        return $this->hashed_password;
    }

    /**
     * Set the value of hashed_password
     * @param string $hashed_password
     * @return self
     */
    public function setHashedPassword(string $hashed_password): self {
        $this->hashed_password = $hashed_password;
        return $this;
    }

    /**
     * Get the value of salt
     * @return string
     */
    public function getSalt(): string {
        return $this->salt;
    }

    /**
     * Set the value of salt
     * @param string $salt
     * @return self
     */
    public function setSalt(string $salt): self {
        $this->salt = $salt;
        return $this;
    }

    public function jsonSerialize(): mixed {
        return get_object_vars($this); 
    }
}
