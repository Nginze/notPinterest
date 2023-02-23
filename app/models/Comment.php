<?php

class Comment extends Model
{

    public function __construct()
    {
        $this->tableName = "comments";
        $db = new Database;
        $this->conn = $db->connect();
    }
    public function createComment($comment)
    {
        $comment['creatorid'] = $this->getUserId();
        return $this->insert($comment);
    }

    public function getComments($pinid)
    {
        try {
            $query = "SELECT commentid, content, creatorid, username, avatarurl, displayname from comments 
                      INNER JOIN appuser
                      ON comments.creatorid = appuser.userid
                      WHERE pinid = :id 
            ";
            $statement = $this->conn->prepare($query);
            $statement->bindValue(":id", $pinid);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
