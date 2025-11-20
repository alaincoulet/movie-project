<?php 

namespace App\Database;

class Mysql
{

    /**
     * Méthode pour se connecter à la BDD Mysql
     * @return \PDO connexion à la BDD Mysql
     */
    public function connectBDD(): \PDO {

        return new \PDO('mysql:host=' . DB_SERVER . ';dbname=' . DB_NAME .'',
            DB_USERNAME,
            DB_PASSWORD, 
            [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]
        );
    }
}
