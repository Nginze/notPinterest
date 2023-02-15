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
        $sql = "select userid, username, avatarurl, imgurl, websiteurl ,displayname 
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
        $sql = "select * from pins where pinid = $id";
        $q = $this->conn->query($sql);
        $q->setFetchMode(PDO::FETCH_ASSOC);
        return $q;
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
}
