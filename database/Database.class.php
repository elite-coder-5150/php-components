<?php
    /**
     * PDO DATABASE class
     * connects to the database using pdo
     *  creates prepared statements
     *  binds parmas to values
     * returns rows and results
     */
    class Database extends PDO {
        protected static $inst;
        protected static $host = 'localhost';
        protected static $db_name = 'friend-request';
        protected static $user = 'root';
        protected static $pass = 'root';
        
        public function __construct() {
            try {
                self::$inst = new PDO('mysql:host='.self::$host.';dbname='.self::$db_name, self::$user, self::$pass);
                self::$inst->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                echo 'Connection Error: '.$e->getMessage();
            }
        }

        public function createDatabase($db_name) {
            $sql = "CREATE DATABASE IF NOT EXISTS $db_name";
            $query = self::$inst->prepare($sql);
            $query->execute();
        }

        public function createTable($table_name, $fields) {
            $sql = "CREATE TABLE IF NOT EXISTS $table_name ($fields)";
            $query = self::$inst->prepare($sql);
            $query->execute();
        }

        public function insert($table_name, $fields, $values) {
            $sql = "INSERT INTO $table_name ($fields) VALUES ($values)";
            $query = self::$inst->prepare($sql);
            $query->execute();
        }

        
    } 