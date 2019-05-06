<?php

    class ForumPost {
        public $title;
        public $content;
        public $author;
        public $created_date;

        public function __construct(string $title, 
                                    string $content, 
                                    User $author, 
                                    string $created_date) 
        {
            $this->title = $title;
            $this->content = $content;
            $this->author = $author;
            $this->created_date = $created_date;
        }
    }

    function get_all_posts(mysqli $database): array {
        $result = array();

        $query = "SELECT * FROM forum_posts JOIN users ON forum_posts.author=users.ID";

        $db_result = $database->query($query);

        while($row = $db_result->fetch_array()) {
            $user = create_user_from_table($row);
            $post = new ForumPost($row["title"], $row["content"], $user, $row["created_date"]);
            array_push($result, $post);
        }

        return $result;
    }

?>