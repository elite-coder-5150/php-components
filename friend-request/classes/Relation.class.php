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
            //? update status to friends
            $sql = 'UPDATE relations SET status="friends" WHERE from=:from AND to=:to';

            $query = $this->db->prepare($sql);
            $query->execute([
                ':from' => $from,
                ':to' => $to
            ]);

            if ($query->rowCount() == 0) {
                $this->error = 'Invalid frind request.';
                return false;
            }

            $sql = 'INSERT INTO relations (from, to, status) VALUES (:from, :to, "friends")'; 

            $query = $this->db->prepare($sql);
            $query->execute([
                ':from' => $to,
                ':to' => $from
            ]);

            return true;
        }

        public function cancel($from, $to) {
            $sql = 'DELETE FROM relations WHERE status="pending" AND from=:from AND to=:to';

            $query = $this->db->prepare($sql);
            $query->execute([
                ':from' => $from,
                ':to' => $to
            ]);

            if ($query->rowCount() == 0) {
                $this->error = 'Invalid frind request.';
                return false;
            }

            return true;
        }

        /**
         * Unfriend - a user wants to unfriend someone.
         * 
         * @param int $from - the user sending the unfriend
         * @param int $to - the user they are unfriending
         * 
         * @return boolean
         */
        public function unfriend($from, $to) {
            $sql = 'DELETE FROM relations WHERE (
                        status="friends" AND from=:from AND to=:to
                    ) OR (
                        status="friends" AND from=:to AND to=:from
                    )';

            $query = $this->db->prepare($sql);
            $query->execute([
                ':from' => $from,
                ':to' => $to
            ]);

            return true;
        }

        public function block($from, $to) {
            $sql = 'INSERT INTO relations (from, to, status) VALUES (from=:from, to=:to, status="blocked"';

            $query = $this->db->prepare($sql);
            $query->execute([
                ':from' => $from,
                ':to' => $to
            ]);

            // this removes then from the friends list
            $this->unfriend($from, $to);

            return true;
        }

       
    }