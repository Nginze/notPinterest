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
                    'username' => $user->displayName,
                    'emailaddress' => $user->email
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

    public function updateUser($data)
    {
        return $this->update($this->getUserId(), $data, 'userid');
    }

    public function deleteUser()
    {
    }

    public function signUp($user)
    {
        $encryptedPassword = password_hash($user['password'], PASSWORD_DEFAULT);
        $user['password'] = $encryptedPassword;
        $success = $this->insert($user);
        if ($success) {

            $userid = $this->conn->lastInsertId(); 
            $_SESSION['user'] = $this->getUserById($userid);
            return true;
        }
        return false;
    }

    public function login($user)
    {
        try {
            $query = "select * from $this->tableName
                      where emailaddress = :email 
            ";
            $statement = $this->conn->prepare($query);
            $statement->bindValue(":email", $user['emailaddress']);
            $statement->execute();
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                echo var_dump($user['password']);
                if (password_verify($user['password'], $row['password'])) {
                    $_SESSION['user'] = $row;
                    return true;
                }
                return false;
            }
            return false;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
