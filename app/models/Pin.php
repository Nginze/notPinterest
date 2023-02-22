<?php

class Pin extends Model
{
    public function __construct()
    {
        $this->tableName = "pins";
        $db = new Database;
        $this->conn = $db->connect();
    }
    public function getUserFeed($userid)
    {
        $sql = "select pinid, userid, username, avatarurl, imgurl, websiteurl ,displayname 
                from pins 
                inner join appuser
                on userid = creatorid 
                where ispublic = true
       ";
        $q = $this->conn->query($sql);
        $q->setFetchMode(PDO::FETCH_ASSOC);
        return $q;
    }

    public function getPinById($id)
    {
        try {

            $query = "select userid, pintitle, pindesc, username, avatarurl, imgurl, displayname from pins 
                inner join appuser
                on creatorid = appuser.userid 
                where pinid = :id 
                ";
            $statement = $this->conn->prepare($query);
            $statement->bindValue(":id", $id);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function createPin($pindata)
    {
        $title = $pindata['title'];
        $desc =  $pindata['desc'];
        $link =  $pindata['link'];
        $creatorid = $this->getUserId();
        $ispublic = true;
        $sql = "insert into pins(pintitle, pindesc, creatorid, websiteurl, ispublic) values (?,?,?,?,?)";
        $q = $this->conn->prepare($sql);
        $q->execute([$title, $desc, $creatorid, $link, $ispublic]);
        return $this->conn->lastInsertId();
    }


    public function updatePin($pinid, $data)
    {
        return $this->update($pinid, $data, "pinid");
    }

    public function deletePin($pinid)
    {
    }

    public function getCurrentUserCreated()
    {

        try {
            $query = "SELECT pins.pinid, imgurl, websiteurl FROM $this->tableName
                      WHERE creatorid= :id";
            $statement = $this->conn->prepare($query);
            $statement->bindValue(":id", $this->getUserId());
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }


    public function search($query)
    {
        try {
            $query = "SELECT pinid, pintitle, imgurl FROM $this->tableName
                      WHERE (`pintitle` LIKE '%" . $query . "%') OR (`pindesc` LIKE '%" . $query . "%')";
            $statement = $this->conn->prepare($query);
            $statement->bindValue(":id", $this->getUserId());
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
