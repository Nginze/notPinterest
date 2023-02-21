<?php

class Reply extends Model
{

    public function __construct()
    {
        $this->tableName = "replies";
        $db = new Database;
        $this->conn = $db->connect();
    }

    public function createReply($data)
    {
        $data['creatorid'] = $this->getUserId();
        return $this->insert($data);
    }

    public function getReplies($commentid)
    {
        try {
            $query = "SELECT * FROM $this->tableName 
                      INNER JOIN appuser
                      ON creatorid = appuser.userid
                      WHERE commentid = :id 
            ";
            $statement = $this->conn->prepare($query);
            $statement->bindValue(":id", $commentid);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
