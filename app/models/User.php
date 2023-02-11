<?php

class User extends Model
{
    public function __construct()
    {
        $this->tableName = "appuser";
    }

    public function getUserById($id)
    {
    }
    public function getUserByProviderId($provider, $id)
    {
    }
    public function createUser($user, $provider)
    {
        switch ($provider) {
            case 'google':
                break;

            case 'github':
                $data = [
                    "githubid" => strval($user->identifier),
                    "avatarurl" => $user->photoUrl,
                    "displayname" => $user->displayName
                ];
                $this->insert($data);
                break;

            case 'discord':
                break;
            default:
                break;
        }
    }

    public function updateUser()
    {
    }

    public function deleteUser()
    {
    }
}
