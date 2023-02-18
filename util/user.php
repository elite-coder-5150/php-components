<?php
    class User {
        protected $db;
        protected $id;

        public function __construct() {
            $this->db = new Database();
            $this->id = $this->uuid();
        }

        public function getUsername() {
            $sql = "SELECT username FROM users WHERE id = :id";
            $query = $this->db->prepare($sql);
            $query->execute([':id' => $this->id]);
            $row = $query->fetch(PDO::FETCH_ASSOC);
            return $row['username'];
        }

        public function getId() {
            return $this->id;
        }

        public function getProfilePicture() {
            $sql = "SELECT profile_picture FROM users WHERE id = :id";
            $query = $this->db->prepare($sql);
            $query->execute([':id' => $this->id]);
            $row = $query->fetch(PDO::FETCH_ASSOC);
            return $row['profile_picture'];
        }

        public function getBio() {
            $sql = "SELECT bio FROM users WHERE id = :id";
            $query = $this->db->prepare($sql);
            $query->execute([':id' => $this->id]);
            $row = $query->fetch(PDO::FETCH_ASSOC);
            return $row['bio'];
        }

        public function getFirstName() {
            $sql = "SELECT first_name FROM users WHERE id = :id";
            $query = $this->db->prepare($sql);
            $query->execute([':id' => $this->id]);
            $row = $query->fetch(PDO::FETCH_ASSOC);
            return $row['first_name'];
        }

        public function getLastName() {
            $sql = "SELECT last_name FROM users WHERE id = :id";
            $query = $this->db->prepare($sql);
            $query->execute([':id' => $this->id]);
            $row = $query->fetch(PDO::FETCH_ASSOC);
            return $row['last_name'];
        }

        public function getFullName() {
            return $this->getFirstName() . " " . $this->getLastName();
        }

        public function generateId() {
            // Generate a random id
            //? q how to generate a random id
            $this->id = $this->uuid();
        }

       

        public function uuid() {
            // Generate a random id
            //? q how to generate a random id
            $numbers = '0123456789';
            $letters = 'abcdefghijklmnopqrstuvwxyz';

            // generate a random number using the numbers and letters with the size of 32
            $id = substr(str_shuffle($numbers . $letters), 0, 32);
        }
    }