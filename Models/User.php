<?php
require_once './utils/Crud.php';

class User {
    private $crud;
    public $id;
    public $username;
    public $password;
    public $name;
    public $surname;
    public $address;

    public function __construct() {
        $this->crud = new Crud();
    }

    public function save() {
        if (isset($this->id)) {
            $request = "UPDATE users SET name = :name, surname = :surname, address = :address WHERE id = :id";
            $itemData = ['name' => $this->name, 'surname' => $this->surname, 'address' => $this->address, 'id' => $this->id];
        } else {
            $request = "INSERT INTO users (username, password, name, surname, address) VALUES (:username, :password, :name, :surname, :address)";
            $itemData = ['username' => $this->username, 'password' => $this->password, 'name' => $this->name, 'surname' => $this->surname, 'address' => $this->address];
        }
        $this->crud->add($request, $itemData);
    }

    public static function findByUsername($username) {
        $crud = new Crud();
        $data = $crud->getAll("users WHERE username = '$username'");
        return !empty($data) ? new self($data[0]) : null;
    }

    public static function findById($id) {
        $crud = new Crud();
        $data = $crud->getById("users", $id);
        return !empty($data) ? new self($data[0]) : null;
    }

    public function delete() {
        if (isset($this->id)) {
            $crud = new Crud();
            $crud->delete("users", $this->id);
        }
    }
}
