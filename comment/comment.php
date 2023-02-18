<?php
    class Comment {
        protected $db;
        protected $post_id;
        protected $commentor_id;
        
        public function __construct($post_id, $commentor_id) {
            $this->db = new Database();
            $this->post_id = $post_id;
            $this->commentor_id = $commentor_id;
        }
    }