<?php

class Model
{

    protected $conn;
    protected $tableName;
    public function __construct()
    {
        $db = new Database;
    }

    public function getUserId()
    {
        return isset($_SESSION['user']) ? $_SESSION['user']['userid'] : null;
    }

    public function insert($data)
    {

        try {
            $columns = implode(", ", array_keys($data));
            $values = ":" . implode(", :", array_keys($data));
            $query = "INSERT INTO $this->tableName ($columns) VALUES ($values)";
            $statement = $this->conn->prepare($query);
            foreach ($data as $key => $value) {
                $statement->bindValue(":$key", $value);
            }
            $statement->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function selectAll()
    {
        try {
            $query = "SELECT * FROM $this->tableName";
            $statement = $this->conn->prepare($query);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function findById($id, $column)
    {
        try {
            $query = "SELECT * FROM $this->tableName WHERE $column = :id";
            $statement = $this->conn->prepare($query);
            $statement->bindValue(":id", $id);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function update($id, $data, $column)
    {
        try {
            $sets = array();
            foreach ($data as $key => $value) {
                $sets[] = "$key = :$key";
            }
            $sets = implode(", ", $sets);
            $query = "UPDATE $this->tableName SET $sets WHERE $column = :id";
            $statement = $this->conn->prepare($query);
            $statement->bindValue(":id", $id);
            foreach ($data as $key => $value) {
                $statement->bindValue(":$key", $value);
            }
            $statement->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function delete($id)
    {
        try {
            $query = "DELETE FROM $this->tableName WHERE id = :id";
            $statement = $this->conn->prepare($query);
            $statement->bindValue(":id", $id);
            $statement->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
