<?php

namespace App\Repository;

use App\Database\Mysql;
use App\Model\Category;

class CategoryRepository
{
    //Attributs
    private \PDO $connect;

    //Constructeur
    public function __construct()
    {
        //Injection de dépendance
        $this->connect = (new Mysql())->connectBDD();
    }

    //Méthodes
    /**
     * Ajouter une Catégorie (Category) en BDD
     * @param Category $category Category a ajouter en BDD
     * @return void
     * @throws \Exception erreur SQL
     */
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
    
    /**
     * Méthode qui retourne une Catégorie (Category) de la BDD par son ID
     * @param int $id id de la Catégorie
     * @return array<string> $category Catégories 
     * @throws \Exception erreur SQL
     */
    public function findAllCategoryById(int $id): array|false
    {
        return [];
    }
    
    /**
     * Méthode qui retourne toutes les Catégories (Category) de la BDD
     * @return array<Category> $categories liste des Catégories 
     * @throws \Exception erreur SQL
     */
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

    /**
     * Méthode qui verifie si une Catégorie (Category) existe en BDD
     * @return bool true si existe/ false si n'existe pas
     * @throws \Exception erreur SQL
     */
    public function isCategoryExistsWithName(string $name) :bool
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