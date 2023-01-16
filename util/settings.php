<?php
    class Settings {
        protected $db;
        protected $util;
        protected $avatar;
        protected $mutual;
        protected $error;

        public function __construct() {
            $this->db = new Database();
            $this->util = new Utility();
            $this->avatar = new Avatar();
            $this->mutual = new Mutual();
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

        public function amIBlocked($user) {
            $session = $_SESSION['user_id'];
            
            $sql = "SELECT block_id FROM block WHERE block_by =:by AND block_to=:to";

            $query = $this->db->prepare($sql);
            $query->execute([
                ':by' => $session,
                ':to' => $user
            ]);

            $count = $query->rowCount();

            if ($count == 0) {
                return false;
            } else if ($count > 0) {
                return true;
            }
        }

        public function isBlocked($user) {
            if (isset($_SESSION['user_id'])) {
                $session = $_SESSION['user_id'];

                $sql = "SELECT block_id FROM block WHERE block_by=:by AND block_to=:to";

                $query = $this->db->prepare($sql);
                $query->execute([
                    ':by' => $user,
                    ':to' => $session
                ]);

                $count = $query->rowCount();

                if ($count == 0) {
                    return false;
                } else if ($count > 0) {
                    return true;
                }
            }
        }

        public function unblock($id) {
            $session = $_SESSION['user_id'];

            $sql = "DELETE FROM block WHERE block_by=:by AND block_to=:to";

            $query = $this->db->prepare($sql);
            $query->execute([
                ':by' => $session,
                ':to' => $id
            ]);

            $this->util->getDetails($id, "username");
        }

        public function blockedUsers() {
            $session = $_SESSION['user_id'];

            
        }
    }