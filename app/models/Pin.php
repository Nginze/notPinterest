<?php

class Pin extends Model {
    public function __construct()
    {
        $this->tableName = "pins";
    }
    public function getUserFeed($userid)
    {
       echo var_dump($this->conn);
       $sql = "select * from 
                pins where ispublic = true
       ";
       $q = $this->conn->query($sql);
       $q->setFetchMode(PDO::FETCH_ASSOC);
       return $q; 
    }

    public function getPinById($id){
        $sql = "select * from pins where pinid = $id";
        $q = $this->conn->query($sql);
        $q->setFetchMode(PDO::FETCH_ASSOC);
        return $q;
    }

    public function createPin($pindata){
        $title = $pindata['title'];
        $desc =  $pindata['desc'];
        $link =  $pindata['link'];
        $creatorid =1;
        $imgurl = "https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__340.jpg";
        $ispublic = true;
        $sql = "insert into pins(pintitle, pindesc, creatorid, websiteurl, imgurl, ispublic) values (?,?,?,?,?,?)";
       $q = $this->conn->prepare($sql);
       $q->execute([$title, $desc,$creatorid, $link, $imgurl, $ispublic]);
       return $q; 
    }

    public function updatePin($pinid){

    }

    public function deletePin($pinid){

    }
    
}