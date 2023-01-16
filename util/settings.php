<?php
    class Settings {
        protected $db;
        protected $error;

        public function __construct() {
            $this->db = new Database();
        }

        public function get($name) {
            $sql = 'SELECT * FROM settings WHERE name=:name';

            $query = $this->db->prepare($sql);
            $query->execute([
                ':name' => $name
            ]);

            if ($query->rowCount() > 0) {
                $data = $query->fetch(PDO::FETCH_OBJ);
                return $data->value;
            }

            return false;
        }

        public function set($name, $value) {
            $sql = 'UPDATE settings SET value=:value WHERE name=:name';

            $query = $this->db->prepare($sql);
            $query->execute([
                ':name' => $name,
                ':value' => $value
            ]);

            return true;
        }
    }