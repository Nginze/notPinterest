<?php

class Comment extends Model{
    
    public function __construct()
    {
        $this->tableName = "comments";
        $db = new Database;
        $this->conn =$db->connect();

    }
    public function createComment($data)
    {
        $data['creatorid'] = $this->getUserId();
        return $this->insert($data);
    }

    public function getComments($pinid)
    {
        $sql = "select content, creatorid, username, avatarurl from comments 
                inner join appuser
                on comments.creatorid = appuser.userid
                where pinid = $pinid 
        ";

        $q = $this->conn->query($sql);
        $q->setFetchMode(PDO::FETCH_ASSOC);

        return $q;
    }
}