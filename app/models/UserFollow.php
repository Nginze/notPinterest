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
        try {
            $userid = $this->getUserId();
            $query = "DELETE 
                 FROM $this->tableName 
                 WHERE followerid = :followerid and userid= :userid";
            $statement = $this->conn->prepare($query);
            $statement->bindValue(":followerid", $followerid);
            $statement->bindValue(":userid", $userid);
            $statement->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    public function checkFollow($follow)
    {
        $userid = $this->getUserId();
        $followerid = $follow['followerid'];
        $query = "SELECT * 
                  FROM $this->tableName 
                  WHERE followerid = :followerid and userid= :userid";
        $statement = $this->conn->query($query);
        $statement->bindValue(":followerid", $followerid);
        $statement->bindValue(":userid", $userid);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        if ($statement->rowCount() > 0) {
            return $this->deleteFollow($followerid);
        } else {
            return $this->createFollow($follow);
        }
    }

    public function getFollowMap()
    {
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

    public function getCurrentUserFollowerCount()
    {
        try {
            $query = "SELECT count(userid) as followercount FROM $this->tableName WHERE followerid = :id";
            $statement = $this->conn->prepare($query);
            $statement->bindValue(":id", $this->getUserId());
            $statement->execute();
            return $statement->fetch();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
