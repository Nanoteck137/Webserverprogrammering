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

    private function ChangeRate($userID, $postID, $upvote)
    {
        $value = 0;
        if($upvote === true) 
        {
            $value = 1;
        } 
        else 
        {
            $value = -1;
        }

        $query = "SELECT * FROM forum_post_rate WHERE upUser=$userID AND upPost=$postID";
        $result = $this->database->Query($query);

        if($result->GetNumRows() <= 0)
        {
            $query = "INSERT INTO forum_post_rate(upUser, upPost, upValue) VALUES ($userID, $postID, $value)";
            $this->database->Query($query);
        } 
        else 
        {
            $row = $result->GetRow(0);

            $value = $row["upValue"];

            if($upvote === true)
            {
                if($value < 0) 
                {
                    $query = "UPDATE forum_post_rate SET upValue=$value * -1 WHERE upUser=$userID AND upPost=$postID";
                    $this->database->Query($query);
                }
            } 
            else 
            {
                if($value > 0) 
                {
                    $query = "UPDATE forum_post_rate SET upValue=$value * -1 WHERE upUser=$userID AND upPost=$postID";
                    $this->database->Query($query);
                }
            }
        }
    }

    public function Upvote(AuthUser $user)
    {
        $userID = $user->id;
        $postID = $this->id;

        $this->ChangeRate($userID, $postID, true);
    }

    public function Downvote(AuthUser $user) 
    {
        $userID = $user->id;
        $postID = $this->id;

        $this->ChangeRate($userID, $postID, false);
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

    public function GetPostFromUser(AuthUser $user): array 
    {
        $posts = array();
        
        $userID = $user->id;
        $query = "SELECT * FROM forum_posts WHERE forum_posts.pAuthor=$userID";
        $result = $this->database->Query($query);

        for($i = 0; $i < $result->GetNumRows(); $i++)
        {
            $row = $result->GetRow($i);
            $post = Post::CreateForUser($this->database, $this->auth, $user, $row);

            array_push($posts, $post);
        }

        return $posts;
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