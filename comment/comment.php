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

        public function getContent($post_id, $commentor_id) { 
            $sql = "SELECT content FROM comments WHERE post_id = :post_id AND commentor_id = :commentor_id";
            $query = $this->db->prepare($sql);
            $query->execute([':post_id' => $post_id, ':commentor_id' => $commentor_id]);
            $row = $query->fetch(PDO::FETCH_ASSOC);
            return $row['content'];
        }

        public function getPostId() {
            $sql = "SELECT post_id FROM comments WHERE post_id = :post_id";
            $query = $this->db->prepare($sql);
            $query->execute([':post_id' => $this->post_id]);
            $row = $query->fetch(PDO::FETCH_ASSOC);
            return $row['post_id'];
        }
    }