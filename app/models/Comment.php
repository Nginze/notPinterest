<?php

class Comment extends Model
{

    public function __construct()
    {
        $this->tableName = "comments";
        $db = new Database;
        $this->conn = $db->connect();
    }
    public function createComment($data)
    {
        $data['creatorid'] = $this->getUserId();
        return $this->insert($data);
    }

    public function getComments($pinid)
    {
        try {
            $query = "select commentid, content, creatorid, username, avatarurl, displayname from comments 
                inner join appuser
                on comments.creatorid = appuser.userid
                where pinid = :id 
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
