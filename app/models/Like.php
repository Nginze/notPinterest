<?php

class Like extends Model{

    public function __construct()
    {
        $this->tableName = "likes";
        $db = new Database;
        $this->conn =$db->connect();
    }

    public function createLike($commentid){
        $sql = 'insert into likes (commentid, creatorid)
        values(
            ?, ?
        )';

        $q = $this->conn->prepare($sql);
        $q->execute([$commentid, $this->getUserId()]);
    }
    
    public function deleteLike($commentid)
    {
        $userid = $this->getUserId();
        $sql = "delete from likes where commentid = '$commentid' and creatorid = '$userid'";
        $q = $this->conn->prepare($sql);
        $q->execute();
    }
    public function checkLike($commentid)
    {
        $userid = $this->getUserId();
        $sql = "select * from likes where commentid = '$commentid' and creatorid = '$userid'";
        $q = $this->conn->query($sql);
        $q->setFetchMode(PDO::FETCH_ASSOC);
        if($q->rowCount() > 0){
            $this->deleteLike($commentid);
        }else{
            $this->createLike($commentid);
        }
    }
}