<?php

class ForumPostNotFoundException extends Exception {}

class Comment 
{
    public $id;
    public $post;
    public $content;
    public $author;
    public $createdDate;

    private function __construct(int $id,
                                Post $post,
                                string $content,
                                AuthUser $author,
                                string $createdDate) 
    {
        $this->id = $id;
        $this->post = $post;
        $this->content = $content;
        $this->author = $author;
        $this->createdDate = $createdDate;
    }

    public static function CreateForPost(Auth $auth, Post $post, $row)
    {
        $user = $auth->GetUserById($row["cAuthor"]);

        return new Comment(
            $row["cID"],
            $post,
            $row["cContent"],
            $user,
            $row["cCreatedDate"]
        );
    }

    public static function CreateForUser(Forum $forum, AuthUser $user, $row) 
    {
        $post = $forum->GetPostById($row["cPostID"]);

        return new Comment(
            $row["cID"],
            $post,
            $row["cContent"],
            $user,
            $row["cCreatedDate"]
        );
    }
}

class Post 
{
    public $database;
    public $auth;

    public $id;
    public $title;
    public $content;
    public $author;
    public $createdDate;

    private function __construct(Database $database,
                                Auth $auth,
                                int $id, 
                                string $title, 
                                string $content, 
                                AuthUser $author, 
                                string $createdDate)
    {
        $this->database = $database;
        $this->auth = $auth;

        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->author = $author;
        $this->createdDate = $createdDate;
    }

    public function PostComment(AuthUser $user, string $content) 
    {
        $postID = $this->id;
        $userID = $user->id;
        
        $query = "INSERT INTO forum_comments(cPostID, cAuthor, cContent) VALUES ($postID, $userID, '$content')";

        $this->database->Query($query);
    }

    public function GetAllComments(): array
    {
        $comments = array();

        $postID = $this->id;
        $query = "SELECT * FROM forum_comments WHERE forum_comments.cPostID=$postID ORDER BY forum_comments.cCreatedDate";
        $result = $this->database->Query($query);

        for($i = 0; $i < $result->GetNumRows(); $i++)
        {
            $row = $result->GetRow($i);
            $comment = Comment::CreateForPost($this->auth, $this, $row);

            array_push($comments, $comment);
        }

        return $comments;
    }

    public static function CreateFromRow(Database $database, Auth $auth, $row): Post
    {
        $user = $auth->GetUserById($row["pAuthor"]);

        return new Post(
            $database,
            $auth,
            $row["pID"],
            $row["pTitle"],
            $row["pContent"],
            $user,
            $row["pCreatedDate"]
        );
    }

    public static function CreateForUser(Database $database, Auth $auth, AuthUser $user, $row): Post
    {
        return new Post(
            $database,
            $auth,
            $row["pID"],
            $row["pTitle"],
            $row["pContent"],
            $user,
            $row["pCreatedDate"]
        );
    }
}

class Forum
{
    private $database;
    private $auth;

    public function __construct(Database $database, Auth $auth)
    {
        $this->database = $database;
        $this->auth = $auth;
    }

    public function GetAllPosts(): array
    {
        $posts = array();

        $query = "SELECT * FROM forum_posts";
        $result = $this->database->Query($query);

        for($i = 0; $i < $result->GetNumRows(); $i++) 
        {
            $row = $result->GetRow($i);
            $post = Post::CreateFromRow($this->database, $this->auth, $row);

            array_push($posts, $post);
        }

        return $posts;
    }

    public function GetPostById(int $id): ?Post
    {
        $query = "SELECT * FROM forum_posts WHERE pID=$id";
        $result = $this->database->Query($query);

        if($result->GetNumRows() === 1)
        {
            $row = $result->GetRow(0);
            return Post::CreateFromRow($this->database, $this->auth, $row);
        } 
        else 
        {
            throw new ForumPostNotFoundException();
        }
    }

    public function GetCommentsFromUser(AuthUser $user): array
    {
        $comments = array();

        $query = "SELECT * FROM forum_comments WHERE forum_comments.cAuthor=1";
        $result = $this->database->Query($query);
        
        for($i = 0; $i < $result->GetNumRows(); $i++)
        {
            $row = $result->GetRow($i);
            $comment = Comment::CreateForUser($this, $user, $row);

            array_push($comments, $comment);
        }

        return $comments;
    }
}

?>