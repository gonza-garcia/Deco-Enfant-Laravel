<?php

  /**
   *
   */
  class Usuario {
    protected $id;
    protected $user_name;
    protected $first_name;
    protected $last_name;
    protected $date_of_birth;
    protected $phone;
    protected $email;
    protected $pass;
    protected $date_upload;
    protected $date_update;
    protected $sex_id;
    protected $user_status_id;
    protected $role_id;

      function __construct(Array $datos)
      {
          if (isset($datos["id"])) {
            $this->id = $datos["id"];
            $this->pass = $datos["pass"];
          } else {
            $this->id = null;
            $this->pass = password_hash($datos["pass"], PASSWORD_DEFAULT);
          }

          $this->email = $datos["email"];

          if (isset($datos["user_name"])) {
            $this->user_name = $datos["user_name"];
            $this->first_name = $datos["first_name"];
            $this->last_name = $datos["last_name"];
            $this->date_of_birth = $datos["date_of_birth"];
            $this->phone = $datos["phone"];
            // $this->date_upload = $datos["date_upload"];
            // $this->date_update = $datos["date_update"];
            // $this->sex_id = $datos["sex_id"];
            // $this->user_status_id = $datos["user_status_id"];
            $this->role_id = 2;
          }

      }

      public function getId() {
        return $this->id;
      }
      public function getUser_name() {
        return $this->user_name;
      }
      public function getFirst_name() {
        return $this->first_name;
      }
      public function getLast_name() {
        return $this->last_name;
      }
      public function getDate_of_birth() {
        return $this->date_of_birth;
      }
      public function getPhone() {
        return $this->phone;
      }
      public function getEmail() {
        return $this->email;
      }
      public function getPass() {
        return $this->pass;
      }
      public function getDate_upload() {
        return $this->date_upload;
      }

      public function getDate_update() {
        return $this->date_update;
      }

      public function getSex_id() {
        return $this->sex_id;
      }

      public function getUser_status_id() {
        return $this->user_status_id;
      }

      public function getRole_id() {
        return $this->role_id;
      }

      public function setId($id) {
        $this->id = $id;
        return $this;
      }
      public function setUser_name($user_name) {
        $this->user_name = $user_name;
        return $this;
      }
      public function setFirst_name($first_name) {
        $this->first_name = $first_name;
        return $this;
      }
      public function setLast_name($last_name) {
        $this->last_name = $last_name;
        return $this;
      }
      public function setDate_of_birth($date_of_birth) {
        $this->date_of_birth = $date_of_birth;
        return $this;
      }
      public function setPhone($phone) {
        $this->phone = $phone;
        return $this;
      }
      public function setPass($pass) {
        $this->pass = $pass;
        return $this;
      }
      public function setEmail($email) {
        $this->email = $email;
        return $this;
      }
      public function setDate_upload($date_upload) {
        $this->date_upload = $date_upload;
        return $this;
      }

      public function setDate_update($date_update) {
        $this->date_update = $date_update;
        return $this;
      }

      public function setSex_id($sex_id) {
        $this->sex_id = $sex_id;
        return $this;
      }

      public function setUser_status_id($user_status_id) {
        $this->user_status_id;
        return $this;
      }

      public function setRole_id($role_id) {
        $this->role_id = $role_id;
        return $this;
      }
  }

 ?>
