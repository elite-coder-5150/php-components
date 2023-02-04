<?php
    class Mutual {
        protected $db;
        protected $error;
        
        public function __construct() {
            $this->db = new Database();
        }

        public function getMutualFriendsList($user_id, $friend_id) {
            //? this is absolute garbage, code and doesn't work
            //?----------------------------------------------------------------
            //! $this->db->query("SELECT * FROM friends WHERE user_id = :user_id AND friend_id = :friend_id");
            //! $this->db->bind(':user_id', $user_id);
            //! $this->db->bind(':friend_id', $friend_id);
            //! $this->db->execute();
            //! $result = $this->db->single();
            //! if($result) {
            //!     return true;
            //! } else {
            //!     return false;
            //! }
            //?----------------------------------------------------------------
            $sql = "SELECT * FROM friends WHERE user_id = :user_id AND friend_id = :friend_id";

            $query = $this->db->prepare($sql);
            $query->execute([
                ':user_id' => $user_id,
                ':friend_id' => $friend_id
    
            ]);

            $result = $query->fetch(PDO::FETCH_OBJ);

            return ($result == true) ? true : false;
            
            // q: how can i simplify this code?
            // a: return ($result == true) ? true : false;

            //? my code was the same code that copilot suggested, so that means I have grown as a developer
        }
       
        public function test() {}
    }