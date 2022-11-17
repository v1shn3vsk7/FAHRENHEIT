<?php

namespace App\Providers;

use \Illuminate\Contracts\Auth\Authenticatable as Authenticatable;
use \Illuminate\Contracts\Auth\UserProvider as UserProvider;
use \Illuminate\Auth\GenericUser as GenericUser;
use \Illuminate\Support\Facades\DB;
use PDO;

class SUSUsersProvider implements UserProvider
{

    public function conn()
    {
        return DB::connection()->getPdo();
    }

    public function retrieveById($identifier)
    {
        /* $row = $this->conn()->query("SELECT * FROM users WHERE id=".$identifier)->fetch();
        if($row)
            return $this->getGenericUser($row); */
        return \App\Models\User::find($identifier);
    }

    public function retrieveByCredentials(array $credentials)
    {

        //$sth = $this->conn()->prepare('SELECT * FROM users WHERE (login = :login OR email = :login OR phone = :login) AND password = :password');
        $sth = $this->conn()->prepare('SELECT * FROM users WHERE (login = :login OR email = :email OR phone = :phone) AND password = :password');
        $sth->bindParam(':login', $credentials['login'], PDO::PARAM_STR);
        $sth->bindParam(':email', $credentials['login'], PDO::PARAM_STR);
        $sth->bindParam(':phone', $credentials['login'], PDO::PARAM_STR);
        $sth->bindParam(':password', $credentials['password'], PDO::PARAM_STR);
        $sth->execute();
        $row = $sth->fetch();

        if($row)
            return \App\Models\User::find($row['id']);
        //if ($row)
            //return new \App\Models\User((array)$row);
           // return $this->getGenericUser($row);
    }

    public function getGenericUser($user)
    {
        if (!is_null($user)) {
            return new GenericUSer((array)$user);
        }
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        return $user->password == $credentials['password'];
    }
    public function retrieveByToken($identifier, $token)
    {
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
    }


}
