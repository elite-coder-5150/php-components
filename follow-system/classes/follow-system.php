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
                    $sql = "INSERT INTO follow_system(follow_by, follow_by_u, follow_to, follow_to_u, time)
                        VALUES(:session, :session_u, :get, :get_u, now())";

                    $query = $this->db->prepare($sql);
                    $query->execute([
                        ':session' => $session,
                        ':session_u' => $session_u,
                        ':get' => $get,
                        ':get_u' => $get_u
                    ]);

                    $notify->followNotify($get, 'follow');

                    return "ok";
                } else {
                    return 'already following';
                }
            }
       }
       
    public function unfollow($get) {
        if (self::isFollowing($get)) {
            $session = $_SESSION['id'];

            $sql = "DELETE FROM follow_system WHERE follow_by=:session AND follow_to=:get LIMIT 1";

            $query = $this->db->prepare($sql);
            $query->execute([
                ':session' => $session,
                ':get' => $get
            ]);
        }
    }

    public function getFollowers($get) {
        $sql = "SELECT follow_by FROM follow_system WHERE follow_to=:get";

        $query = $this->db->prepare($sql);
        $query->execute([
            ':get' => $get
        ]);

        $count = $query->rowCount();
        return $count;
    }

    public function followers($get) {
        echo '<div class="test"></div>';
    }
}