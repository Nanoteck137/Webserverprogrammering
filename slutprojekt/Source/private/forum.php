<?php

    class PostNotFoundException extends Exception {}

    class ForumPost 
    {
        public $id;
        public $title;
        public $content;
        public $author;
        public $created_date;

        public function __construct(int $id,
                                    string $title, 
                                    string $content, 
                                    User $author, 
                                    string $created_date) 
        {
            $this->id = $id;
            $this->title = $title;
            $this->content = $content;
            $this->author = $author;
            $this->created_date = $created_date;
        }
    }

    function get_all_posts(mysqli $database): array 
    {
        $result = array();

        $query = "SELECT *, forum_posts.ID as forum_id FROM forum_posts JOIN users ON forum_posts.author=users.ID";

        $db_result = $database->query($query);

        while($row = $db_result->fetch_array()) {
            $user = create_user_from_table($row);
            $post = new ForumPost($row["forum_id"], $row["title"], $row["content"], $user, $row["created_date"]);
            array_push($result, $post);
        }

        return $result;
    }

    function get_post_by_id(mysqli $database, int $id): ForumPost 
    {
        $query = "SELECT *, forum_posts.ID as forum_id FROM forum_posts JOIN users ON forum_posts.author=users.ID WHERE forum_posts.ID=$id";

        $result = $database->query($query);

        if($result->num_rows <= 0) 
        {
            throw new PostNotFoundException();
        } 
        else 
        {
            $row = $result->fetch_array();

            $user = create_user_from_table($row);
            $post = new ForumPost($row["forum_id"], $row["title"], $row["content"], $user, $row["created_date"]);

            return $post;
        }
    }

?>