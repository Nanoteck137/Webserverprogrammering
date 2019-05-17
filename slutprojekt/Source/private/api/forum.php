<?php

class ForumPostNotFoundException extends Exception {}

class Comment 
{

}

class Post 
{
    public $database;

    public $id;
    public $title;
    public $content;
    public $author;
    public $createdDate;

    private function __construct(Database $database,
                                int $id, 
                                string $title, 
                                string $content, 
                                AuthUser $author, 
                                string $createdDate)
    {
        $this->database = $database;
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->author = $author;
        $this->createdDate = $createdDate;
    }

    public static function CreateFromRow(Database $database, $row): Post
    {
        $user = AuthUser::CreateFromRow($database, $row);

        return new Post(
            $database,
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

        $query = "SELECT * FROM forum_posts JOIN users ON forum_posts.pID = users.uID";
        $result = $this->database->Query($query);

        for($i = 0; $i < $result->GetNumRows(); $i++) 
        {
            $row = $result->GetRow($i);
            $post = Post::CreateFromRow($this->database, $row);

            array_push($posts, $post);
        }

        return $posts;
    }

    public function GetPostById(int $id): ?Post
    {
        $query = "SELECT * FROM forum_posts JOIN users ON forum_posts.pID = users.uID WHERE pID=$id";
        $result = $this->database->Query($query);

        if($result->GetNumRows() === 1)
        {

        } 
        else 
        {
            throw new ForumPostNotFoundException();
        }
    }
}

?>