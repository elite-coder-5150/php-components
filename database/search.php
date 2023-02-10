<?php
class Search {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function searchById($value) {
        $sql=  "SELECT id FROM users WHERE id = :value LIMIT 10";

        $query = $this->db->prepare($sql);
        $query->execute([':value' => $value]);

        echo /*html*/`
            <div class="people-search">
        `;
    }
}