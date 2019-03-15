<?php

namespace Generic\Database;

class Connection
{

    private $pdo;

    public function __construct(
        string $databaseName,
        string $databaseUser,
        string $databasePass
    ) {

        $dns ='mysql:host=localhost;dbname=' .$databaseName;
        
        $this->connect($dns, $databaseUser, $databasePass);
    }

    private function connect(string $dsn, string $user, string $pass): void
    {
        try {
            $this->pdo = new \PDO($dsn, $user, $pass, [
                \PDO::MYSQL_ATTR_INIT_COMMAND => "SET names utf8"
            ]);
        } catch (\PDOException $e) {
            echo "Erreur lors de la connexion : " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function query(string $query)
    {
        $pdoStatement = $this->pdo->query($query);
        return $pdoStatement->fetchAll(); // transforme la requete en array
    }

    public function preparedQuery(string  $query) : array
    {

        // Préparation
       // $query = "SELECT * FROM product WHERE id = :idCustom";
        
        $statement = $this->pdo->prepare($query);

         //Execution
         $id=1;
         $statement->bindParam(':idCustom', $id);
         $statement->execute();

         return $statement->fetchAll();
    }
}
