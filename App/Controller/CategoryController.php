<?php 

namespace App\Controller;

use App\Model\Category;
use App\Repository\CategoryRepository;
use App\Utils\Tools;
use App\Controller\AbstractController;

class CategoryController extends AbstractController
{
    private CategoryRepository $categoryRepository;

    public function __construct(
    )
    {
        $this->categoryRepository = new CategoryRepository();
    }

    //Méthodes
    /**
     * Méthode pour ajouter une Catégorie (Category)
     * @return mixed Retourne le template
     */
    public function addCategory(): mixed
    {
        $data = [];
        //test si le formulaire
        if (isset($_POST["submit"])) {
            //Tester si le champs name est remplis
            if (!empty($_POST["name"])) {
                //nettoyer
                $_POST["name"] = Tools::sanitize($_POST["name"]);
                //valider
                //Création d'un objet categorie
                $category = new Category($_POST["name"]);
                //Test si la categorie n'existe pas
                if (!$this->categoryRepository->isCategoryExistsWithName($category->getName())) {
                    //Ajout en BDD
                    $this->categoryRepository->saveCategory($category);
                    //Message de validation
                    $data["valid"] = "La categorie a été ajouté en BDD";
                } 
                //Sinon si la categorie
                else {
                    //Message d'erreur
                    $data["error"] = "La categorie existe déja en BDD";
                }
            }
        }

        //afficher le template avec render
        return $this->render("add_category","Add category", $data);
    }

    /**
     * Méthode qui affiche la liste des Catégories (Category)
     * @return mixed Retourne le template
     */
    public function showAllCategories(): mixed
    {
        $categories = $this->categoryRepository->findAllCategories();
        //afficher le template avec render
        return $this->render("all_categories","Categories", $categories);
    }
}
