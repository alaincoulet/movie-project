<?php 

namespace App\Controller;

use App\Model\Category;
use App\Utils\Tools;

class CategoryController
{
    private Category $categoryModel;

    public function __construct(
    )
    {
        $this->categoryModel = new Category("");
    }

    /**
     * Méthode pour rendre une vue avec un template
     * @param string $template Le nom du template à inclure
     * @param string|null $title Le titre de la page
     * @param array $data Les données à passer au template
     * @return void
     */
    public function render(string $template, ?string $title, array $data = []): void
    {
        include __DIR__ . "/../../template/template_" . $template . ".php";
    }

    public function addCategory()
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
                if (!$this->categoryModel->isCategoryExistsByName($category->getName())) {
                    //Ajout en BDD
                    $this->categoryModel->saveCategory($category);
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

    public function showAllCategories()
    {
        $categories = $this->categoryModel->findAllCategories();
        //afficher le template avec render
        return $this->render("all_categories","Categories", $categories);
    }
}
