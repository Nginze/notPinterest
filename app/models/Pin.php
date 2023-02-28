<?php

class Pin extends Model
{
    public function __construct()
    {
        $this->tableName = "pins";
        $db = new Database;
        $this->conn = $db->connect();
    }

    public function getUserFeed($page)
    {
        $userid  = $this->getUserId();
        $offset = $page * 20;
        $sql = "select pinid, userid, username, category, avatarurl, imgurl, websiteurl ,displayname 
                from pins 
                inner join appuser
                on userid = creatorid 
                where ispublic = true and category in (select interest from userinterests where userid = $userid)
                limit 20 offset $offset 
       ";
        $q = $this->conn->query($sql);
        $q->setFetchMode(PDO::FETCH_ASSOC);
        return $q;
    }

    public function getFollowingFeed($page)
    {
        $userid  = $this->getUserId();
        $offset = $page * 20;
        $sql = "select pinid, userid, username, category, avatarurl, imgurl, websiteurl ,displayname 
                from pins 
                inner join appuser
                on userid = creatorid 
                where ispublic = true and userid in (select userid from pins where creatorid in (
                    select followerid from userfollow where userid = $userid
                )) 
                limit 20 offset $offset 
       ";
        $q = $this->conn->query($sql);
        $q->setFetchMode(PDO::FETCH_ASSOC);
        return $q;
    }
    public function getPinById($pinid)
    {
        try {

            $query = "SELECT userid, 
                             pintitle, 
                             pindesc, 
                             username, 
                             avatarurl, 
                             imgurl, 
                             displayname 
                      FROM $this->tableName 
                      INNER JOIN appuser
                      ON creatorid = appuser.userid 
                      WHERE pinid = :pinid
                ";
            $statement = $this->conn->prepare($query);
            $statement->bindValue(":pinid", $pinid);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function createPin($pin)
    {
        $creatorid = $this->getUserId();
        $pin['creatorid'] = $this->getUserId();
        $result = $this->insert($pin);
        if ($result) {
            return $this->conn->lastInsertId();
        }
        return null;
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
            $query = "SELECT pins.pinid, 
                             imgurl, 
                             websiteurl 
                      FROM  $this->tableName
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


    public function search($query, $by)
    {
        try {
            $query = $by == "pins" ? "SELECT pinid, pintitle, imgurl FROM $this->tableName
                      WHERE (`pintitle` LIKE '%" . $query . "%') OR (`pindesc` LIKE '%" . $query . "%')
                      LIMIT 4"
                : "SELECT userid, username, avatarurl FROM $by
                      WHERE (`username` LIKE '%" . $query . "%') OR (`emailaddress` LIKE '%" . $query . "%')
                      LIMIT 4";
            // echo $query;
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
