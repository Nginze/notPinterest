<?php

class SavedPin extends Model
{
    public function __construct()
    {
        $db = new Database;
        $this->tableName = "savedpins";
        $this->conn = $db->connect();
    }
    public function savePin($data)
    {
        $data['saverid'] = $this->getUserId();
        $this->insert($data);
    }

    public function deleteSave($pinid)
    {
        $userid = $this->getUserId();
        try {
            $query = "DELETE FROM $this->tableName WHERE saverid = :userid AND pinid = :pinid";
            $statement = $this->conn->prepare($query);
            $statement->bindValue(":pinid", $pinid);
            $statement->bindValue(":userid", $userid);
            $statement->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function checkSave($data)
    {
        $pinid = $data['pinid'];
        $userid = $this->getUserId();
        try {
            $sql = "select * from $this->tableName where pinid = '$pinid' and saverid = '$userid'";
            $q = $this->conn->query($sql);
            $q->setFetchMode(PDO::FETCH_ASSOC);
            if ($q->rowCount() > 0) {
                $this->deleteSave($pinid);
            } else {
                $this->savePin($data);
            }
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
