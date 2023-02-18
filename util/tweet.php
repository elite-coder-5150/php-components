<?php
    class Tweet {
        protected $db;

        public function __construct() {
            $this->db = new Database();
        }

        public function getTweet($id) {
            $sql = "SELECT * FROM tweets WHERE id = :id";
            $query = $this->db->prepare($sql);
            $query->execute([':id' => $id]);
            $row = $query->fetch(PDO::FETCH_ASSOC);
            return $row;
        }

        public function getTweets($user_id) {
            $sql = "SELECT * FROM tweets WHERE user_id = :user_id";
            $query = $this->db->prepare($sql);
            $query->execute([':user_id' => $user_id]);
            $rows = $query->fetchAll(PDO::FETCH_ASSOC);
            return $rows;
        }

        public function getTweetCount($user_id) {
            $sql = "SELECT COUNT(*) FROM tweets WHERE user_id = :user_id";
            $query = $this->db->prepare($sql);
            $query->execute([':user_id' => $user_id]);
            $row = $query->fetch(PDO::FETCH_ASSOC);
            return $row['COUNT(*)'];
        }

        public function getTweetLikes($id) {
            $sql = "SELECT COUNT(*) FROM likes WHERE tweet_id = :tweet_id";
            $query = $this->db->prepare($sql);
            $query->execute([':tweet_id' => $id]);
            $row = $query->fetch(PDO::FETCH_ASSOC);
            return $row['COUNT(*)'];
        }

        public function getTweetRetweets($id) {
            $sql = "SELECT COUNT(*) FROM retweets WHERE tweet_id = :tweet_id";
            $query = $this->db->prepare($sql);
            $query->execute([':tweet_id' => $id]);
            $row = $query->fetch(PDO::FETCH_ASSOC);
            return $row['COUNT(*)'];
        }

        public function getTweetReplies($id) {
            $sql = "SELECT COUNT(*) FROM replies WHERE tweet_id = :tweet_id";
            $query = $this->db->prepare($sql);
            $query->execute([':tweet_id' => $id]);
            $row = $query->fetch(PDO::FETCH_ASSOC);
            return $row['COUNT(*)'];
        }

        public function getTweetComments($id) {
            $sql = "SELECT COUNT(*) FROM comments WHERE tweet_id = :tweet_id";
            $query = $this->db->prepare($sql);
            $query->execute([':tweet_id' => $id]);
            $row = $query->fetch(PDO::FETCH_ASSOC);
            return $row['COUNT(*)'];
        }

        public function getTweetLikesByUser($tweet_id, $user_id) {
            $sql = "SELECT COUNT(*) FROM likes WHERE tweet_id = :tweet_id AND user_id = :user_id";
            $query = $this->db->prepare($sql);
            $query->execute([':tweet_id' => $tweet_id, ':user_id' => $user_id]);
            $row = $query->fetch(PDO::FETCH_ASSOC);
            return $row['COUNT(*)'];
        }

        public function getTweetRetweetsByUser($tweet_id, $user_id) {
            $sql = "SELECT COUNT(*) FROM retweets WHERE tweet_id = :tweet_id AND user_id = :user_id";
            $query = $this->db->prepare($sql);
            $query->execute([':tweet_id' => $tweet_id, ':user_id' => $user_id]);
            $row = $query->fetch(PDO::FETCH_ASSOC);
            return $row['COUNT(*)'];
        }

        public function getTweetRepliesByUser($tweet_id, $user_id) {
            $sql = "SELECT COUNT(*) FROM replies WHERE tweet_id = :tweet_id AND user_id = :user_id";
            $query = $this->db->prepare($sql);
            $query->execute([':tweet_id' => $tweet_id, ':user_id' => $user_id]);
            $row = $query->fetch(PDO::FETCH_ASSOC);
            return $row['COUNT(*)'];
        }
    }