<?php
    class follow_system {
        protected $db;
        protected $error;

        public function __construct() {
            $this->db = new Database();
        }

        public function isFollowing($get) {
            $session = $_SESSION['user_id'];

            $sql = 'SELECT * FROM follow_system WHERE follower=:follower AND following=:following';

            $query = $this->db->prepare($sql);
            $query->execute([
                ':follower' => $session,
                ':following' => $get
            ]);

            if ($query->rowCount() > 0) {
                return true;
            }

            return false;
        }

       public function follow($get) {
            $utility = new Utility();
            $settings = new Settings();
            $notify = new Notification();

            $session = $_SESSION['user_id'];
            $session_u = $utility->getDetails($session, "username");
            $get_u = $utility->getDetails($get, "username");

            if ($settings->amIBlocked($get) == false) {
                if ($this->isFollowing($get) == false) {

                }
            }
       }


    }