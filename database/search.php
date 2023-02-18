<?php
class Search {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function searchPeople($value) {
        $sql=  "SELECT id FROM users WHERE id = :value LIMIT 10";

        $query = $this->db->prepare($sql);
        $query->execute([':value' => $value]);

        echo "<div class='people-search'>";
            while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $user = new User($row['id']);
                echo "<a href='profile.php?id=" . $user->getId() . "'>" . $user->getUsername() . "</a>";
            }
        echo "</div>";
    }

    public function searchById($id) {
        $sql = "SELECT id FROM users WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->execute([':id' => $id]);
        $row = $query->fetch(PDO::FETCH_OBJ);
        return $row->id;
    }

    public function searchAuthors($value) {
        $sql = "SELECT id FROM users WHERE id = :value LIMIT 10";
        $query = $this->db->prepare($sql);
        $query->execute([':value' => $value]);

        echo "<div class='people-search'>";
            while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $user = new User($row['id']);
                echo "<a href='profile.php?id=" . $user->getId() . "'>" . $user->getUsername() . "</a>";
            }
        echo "</div>";
    }

    public function searchPosts($value) {
        $sql = "SELECT id FROM posts WHERE id = :value LIMIT 10";
        $query = $this->db->prepare($sql);
        $query->execute([':value' => $value]);

        echo "<div class='people-search'>";
            while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $post = new Post($row['id']);
                echo "<a href='post.php?id=" . $post->getId() . "'>" . $post->getTitle() . "</a>";
            }
        echo "</div>";
    }

    public function searchUserName($value) {
        $sql = "SELECT id FROM users WHERE username = :value LIMIT 10";
        $query = $this->db->prepare($sql);
        $query->execute([':value' => $value]);

        // 
        echo "<div class='people-search'>";
            while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $user = new User($row['id']);
                echo "<a href='profile.php?id=" . $user->getId() . "'>" . $user->getUsername() . "</a>";
            }
        echo "</div>";
    }

    public function searchComments($value) {
        $sql = "SELECT id FROM comments WHERE id = :value LIMIT 10";
        $query = $this->db->prepare($sql);
        $query->execute([':value' => $value]);

        // TODO: write the html for this component
        echo "<div class='people-search'>";
            while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $comment = new Comment($row['id'], $row['post_id'], $row['user_id'], $row['content'], $row['created_at']);
                echo "<a href='post.php?id=" . $comment->getPostId() . "'>" . $comment->getContent($value, $comment) . "</a>";
            }
    }

    public function searchTweets($value) {
        $sql = "SELECT id FROM tweets WHERE id = :value LIMIT 10";
        $query = $this->db->prepare($sql);
        $query->execute([':value' => $value]);

        echo "<div class='people-search'>";
            while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $tweet = new Tweet($row['id'], $row['user_id'], $row['content'], $row['created_at']);
                echo "<a href='profile.php?id=" . $tweet->getUserId() . "'>" . $tweet->getContent() . "</a>";
            }
        echo "</div>";
    }
}