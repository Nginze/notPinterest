<?php

class User extends Model
{
    public function __construct()
    {
        $db = new Database;
        $this->tableName = "appuser";
        $this->conn = $db->connect();
    }
    public function getCurrentUserProfile()
    {
        return $this->findById($this->getUserId(), 'userid');
    }

    public function getUserById($id)
    {
        return $this->findById($id, 'userid');
    }
    public function getUserByProviderId($id, $provider)
    {
        $id = strval($id);
        $providerColumn = $provider . "id";
        try {
            $query = "SELECT * FROM $this->tableName WHERE $providerColumn = :id";
            $statement = $this->conn->prepare($query);
            $statement->bindValue(":id", $id);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    public function createUser($user, $provider)
    {
        switch ($provider) {
            case 'google':
                $data = [
                    'googleid' => $user->identifier,
                    'avatarurl' => $user->photoURL,
                    'displayname' => $user->displayName
                ];
                $this->insert($data);
                break;

            case 'github':
                $data = [
                    "githubid" => strval($user->identifier),
                    "avatarurl" => $user->photoURL,
                    "displayname" => $user->displayName
                ];
                $this->insert($data);
                break;

            default:
                break;
        }
    }

    public function updateUser($id, $data)
    {
        return $this->update($id, $data, 'userid');
    }

    public function deleteUser()
    {
    }
}
