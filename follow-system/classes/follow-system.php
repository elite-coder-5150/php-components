<?php
    class follow_system {
        protected $db;
        protected $error;

        public function __construct() {
            $this->db = new Database();
        }

       public function follow($get) {
            $utility = new Utility();
            $settings = new Settings();
            $notify = new Notification();

            $session = $_SESSION['user_id'];
            // $session_u = $utility->getDetails($session);
       }


    }