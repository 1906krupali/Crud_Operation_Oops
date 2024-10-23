<?php

class Details {
    private $mysqli;
    private $table_name = "users";

    public $id;
    public $name;
    public $email;
    public $password; 
    public $address;
    public $phone;
    public $dob;
    public $gender;
    public $marital_status;
    public $profile_pic; 
    public $hobbies;     

    public function __construct($db) {
        $this->mysqli = $db;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $result = $this->mysqli->query($query);
        return $result;
    }

    public function insert() {
        $query = "INSERT INTO " . $this->table_name . " (name, email, password, address, phone, dob, gender, marital_status, profile_pic, hobbies) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->mysqli->prepare($query);
        $hashed_password = password_hash($this->password, PASSWORD_DEFAULT); 
        $stmt->bind_param("ssssssssss", $this->name, $this->email, $hashed_password, $this->address, $this->phone, $this->dob, $this->gender, $this->marital_status, $this->profile_pic, $this->hobbies);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET name = ?, email = ?, password = ?, address = ?, phone = ?, dob = ?, gender = ?, marital_status = ?, profile_pic = ?, hobbies = ? WHERE id = ?";
        $stmt = $this->mysqli->prepare($query);
        $hashed_password = password_hash($this->password, PASSWORD_DEFAULT);  
        $stmt->bind_param("ssssssssssi", $this->name, $this->email, $hashed_password, $this->address, $this->phone, $this->dob, $this->gender, $this->marital_status, $this->profile_pic, $this->hobbies, $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param("i", $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
