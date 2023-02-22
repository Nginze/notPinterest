<?php

class UserFollow extends Model
{
    public function __construct()
    {
        $db = new Database;
        $this->tableName = "userFollow";
        $this->conn = $db->connect();
    }

    public function createFollow($data)
    {
        $data['userid'] = $this->getUserId();
        return $this->insert($data);
    }

    public function deleteFollow($followerid)
    {
        $userid = $this->getUserId();
        $sql = "delete from userfollow where followerid= '$followerid' and userid= '$userid'";
        $q = $this->conn->prepare($sql);
        $q->execute();
    }
    public function checkFollow($data)
    {
        $userid = $this->getUserId();
        $followerid = $data['followerid'];
        $sql = "select * from userfollow where followerid = '$followerid' and userid= '$userid'";
        $q = $this->conn->query($sql);
        $q->setFetchMode(PDO::FETCH_ASSOC);
        if($q->rowCount() > 0){
            $this->deleteFollow($followerid);
        }else{
            $this->createFollow($data);
        }
    }

    public function getFollowMap(){
        try {
            $query = "SELECT followerid FROM $this->tableName WHERE userid = :id";
            $statement = $this->conn->prepare($query);
            $statement->bindValue(":id", $this->getUserId());
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
