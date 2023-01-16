<?php
    class Utility {
        protected $db;

        public function __construct() {
            $this->db = new Database();
        }

        public function getDetails($get_id, $what) {
            $sql = "SELECT $what FROM users WHERE id=:id";

            $query = $this->db->prepare($sql);
            $query->execute([
                ':id' => $get_id
            ]);

            $row = $query->fetch(PDO::FETCH_OBJ);
            return $row->$what;
        }
    }