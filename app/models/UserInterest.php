<?php


class UserInterest extends Model
{
    public function __construct()
    {
        $this->tableName = "userinterests";
        $db = new Database;
        $this->conn = $db->connect();
    }

    public function createInterests($interests)
    {
        $userid = $this->getUserId();
        foreach ($interests as $key => $value) {
            $this->insert(["userid" => $userid, "interest" => $value]);
        }
    }
}
