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

    class ForumComment 
    {
        public $id;
        public $content;
        public $author;
        public $created_date;

        public function __construct(int $id, 
                                    string $content,
                                    User $author,
                                    string $created_date) 
        {
            $this->id = $id;
            $this->content = $content;
            $this->author = $author;
            $this->created_date = $created_date;
        }
    }

    function get_all_posts(mysqli $database): array 
    {
        $result = array();

        $query = "SELECT *, forum_posts.ID as forum_id, forum_posts.created_date as forum_created_date FROM forum_posts JOIN users ON forum_posts.author=users.ID";

        $db_result = $database->query($query);

        while($row = $db_result->fetch_array()) 
        {
            $user = create_user_from_table($row);
            $post = new ForumPost($row["forum_id"], $row["title"], $row["content"], $user, $row["forum_created_date"]);
            array_push($result, $post);
        }

        return $result;
    }

    function get_posts_by_id(mysqli $database, int $id): ForumPost 
    {
        $query = "SELECT *, forum_posts.ID as forum_id, forum_posts.created_date as forum_created_date FROM forum_posts JOIN users ON forum_posts.author=users.ID WHERE forum_posts.ID=$id";

        $result = $database->query($query);

        if($result->num_rows <= 0) 
        {
            throw new PostNotFoundException();
        } 
        else 
        {
            $row = $result->fetch_array();

            $user = create_user_from_table($row);
            $post = new ForumPost($row["forum_id"], $row["title"], $row["content"], $user, $row["forum_created_date"]);

            return $post;
        }
    }

    function get_posts_by_user(mysqli $database, User $user): array
    {
        $result = array();

        $user_id = $user->id;
        $query = "SELECT *, forum_posts.ID as forum_id, forum_posts.created_date as forum_created_date FROM forum_posts JOIN users ON forum_posts.author=users.ID WHERE users.ID=$user_id";

        $db_result = $database->query($query);

        while($row = $db_result->fetch_array())
        {
            $post = new ForumPost($row["forum_id"], $row["title"], $row["content"], $user, $row["forum_created_date"]);
            array_push($result, $post);
        }

        return $result;
    }

    function get_comments_from_user_id(mysqli $database, User $user): array
    {
        $result = array();

        $user_id = $user->id;
        
        $query = "SELECT *, forum_comments.ID as comment_id, forum_comments.created_date as comment_created_date FROM forum_comments JOIN users ON forum_comments.author=users.ID WHERE author=$user_id;";
        $db_result = $database->query($query);

        while($row = $db_result->fetch_array()) 
        {
            $comment = new ForumComment($row["comment_id"], $row["content"], $user, $row["comment_created_date"]);

            array_push($result, $comment);
        }

        return $result;
    }

    function get_comments_from_post(mysqli $database, ForumPost $post): array
    {
        $result = array();

        $forum_id = $post->id;
        
        $query = "SELECT *, forum_comments.ID as comment_id, forum_comments.created_date as comment_created_date FROM forum_comments JOIN users ON forum_comments.author=users.ID WHERE forum_id=$forum_id";
        $db_result = $database->query($query);

        while($row = $db_result->fetch_array()) 
        {
            $user = create_user_from_table($row);
            $comment = new ForumComment($row["comment_id"], $row["content"], $user, $row["comment_created_date"]);

            array_push($result, $comment);
        }

        return $result;
    }

?>