<?php
    class Relation {
        protected $db;
        protected $error;

        public function __construct() {
            $this->db = new Database();
        }

        public function request($from, $to) {
            $sql = 'SELECT * FROM relations WHERE from=:from AND to=:to';

            $query = $this->db->prepare($sql);
            $query->execute([
                ':from' => $from,
                ':to' => $to
            ]);

            if ($query->rowCount() > 0) {
                $this->error = 'You have already sent a friend request to this user.';
                return false;
            }


            $sql = 'SELECT * FROM relations WHERE (
                    status="pending" AND from=:from AND to=:to
                ) OR (
                    status="pending" AND from=:to AND to=:from
                )';

            $query = $this->db->prepare($sql);
            $query->execute([
                ':from' => $from,
                ':to' => $to
            ]);

            if ($query->rowCount() > 0) {
                $this->error = 'You\'re request is pending.';
                return false;
            }

            $sql = 'INSERT INTO relations (from, to, status) VALUES (:from, :to, "pending")';

            $query = $this->db->prepare($sql);
            $query->execute([
                ':from' => $from,
                ':to' => $to
            ]);

            return true;
        }

        public function accept($from, $to) {
            
        }
    }