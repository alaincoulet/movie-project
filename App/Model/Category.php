<?php

namespace App\Model;

use App\Database\Mysql;

class Category
{
    //Attributs
    private ?int $id;
    private ?string $name;
    private \PDO $connect;

    //Constructeur
    public function __construct(
        string $name
    )
    {
        $this->name = $name;
        //Injection de dépendance
        $this->connect = (new Mysql())->connectBDD();
    }

    //Getters et Setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }
    //Méthodes
    //Ajouter une category
    public function saveCategory(Category $category): void
    {
        try {
            //Requête SQL
            $sql = "INSERT INTO category(`name`) VALUE(?)";
            //péparation
            $req = $this->connect->prepare($sql);
            //Assignation du paramètre
            $req->bindValue(1, $category->getName(), \PDO::PARAM_STR);
            //Exécution de la requête
            $req->execute();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
    //Afficher une category (par son id)
    public function findAllCategoryById(int $id): array
    {
        return [];
    }
    
    //Afficher toutes les categories
    public function findAllCategories():array
    {
        try {
            //Requête SQL
            $sql = "SELECT c.id, c.name FROM category AS c ORDER BY c.name";
            //péparation
            $req = $this->connect->prepare($sql);
            //Exécution de la requête
            $req->execute();
            //Fetch
            $categories = $req->fetchAll(\PDO::FETCH_ASSOC);
            
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
        //Retour de la liste des categories
        return $categories;
    }

    public function isCategoryExistsByName(string $name) :bool
    {
        try {
            //Ecrire la requête
            $sql = "SELECT id FROM category WHERE `name` = ?";
            //Préparer la requête
            $req = $this->connect->prepare($sql);
            //Assigner le paramètre
            $req->bindParam(1, $name, \PDO::PARAM_STR);
            //Exécuter la requête
            $req->execute();
            //Fetch le resultat
            $category = $req->fetch(\PDO::FETCH_ASSOC);
            //Test si la categorie n'existe pas
            if (empty($category)) {
                return false;
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
            return false;
        }
        return true;
    } 
}
