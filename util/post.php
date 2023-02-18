<?php
    class Post {
        protected $db;
        protected $id;

        public function __construct($id) {
            $this->db = new Database();
            $this->id = $id;
        }

        public function getId() {
            return $this->id;
        }

        public function getTitle() {
            $sql = "SELECT title FROM posts WHERE id = :id";
            $query = $this->db->prepare($sql);
            $query->execute([':id' => $this->id]);
            $row = $query->fetch(PDO::FETCH_OBJ);
            return $row->title;
        }

        public function getPostId() {
            $sql = "SELECT id FROM posts WHERE id = :id";
            $query = $this->db->prepare($sql);
            $query->execute([':id' => $this->id]);
            $row = $query->fetch(PDO::FETCH_OBJ);
            return $row->id;
        }
    }