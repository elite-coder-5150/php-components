<?php
    class Avatar {
        protected $db;
        protected $error;
        
        public function __construct() {
            $this->db = new Database();
        }
    }