<?php

class Like extends Model
{

    public function __construct()
    {
        $this->tableName = "likes";
        $db = new Database;
        $this->conn = $db->connect();
    }

    public function createLike($like)
    {

        $like['creatorid'] = $this->getUserId();
        return $this->insert($like);
    }

    public function deleteLike($commentid)
    {
        try {
            $query = "DELETE FROM $this->tableName
                      WHERE commentid = :commentid AND creatorid = :userid 
                     ";
            $statement = $this->conn->prepare($query);
            $statement->bindValue(":commentid", $commentid);
            $statement->bindValue(":creatorid", $this->getUserId());
            $statement->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    public function checkLike($like)
    {
        $userid = $this->getUserId();
        $commentid = $like['commentid'];
        $query = "SELECT * FROM likes 
                WHERE commentid = :commentid AND creatorid = :creatorid";
        $statement = $this->conn->prepare($query);
        $statement->bindValue(":commentid", $commentid);
        $statement->bindValue(":creatorid", $this->getUserId());
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        if ($statement->rowCount() > 0) {
            return $this->deleteLike($commentid);
        } else {
            return $this->createLike($like);
        }
    }

    public function getLikeMap($commentid)
    {
        try {
            $query = "SELECT creatorid FROM $this->tableName WHERE commentid = :id";
            $statement = $this->conn->prepare($query);
            $statement->bindValue(":id", $commentid);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
