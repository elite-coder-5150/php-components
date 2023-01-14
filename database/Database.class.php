<?php
    /**
     * PDO DATABASE class
     * connects to the database using pdo
     *  creates prepared statements
     *  binds parmas to values
     * returns rows and results
     */
    class Database {
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
    }