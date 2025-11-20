<?php

namespace App\Controller;

use App\Model\Movie;
use App\Model\Category;
use App\Repository\MovieRepository;
use App\Utils\Tools;

class MovieController
{
    //Attributs
    private MovieRepository $movieRepository;

    //Constructeur
    public function __construct()
    {
        $this->movieRepository = new MovieRepository();
    }

    //Méthodes
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

    //Méthode pour ajouter un film (Movie)
    public function addMovie()
    {
        //Tableau avec les messages pour la vue
        $data = [];
        //Tester si le formulaire est soumis
        if (isset($_POST["submit"])) {
            if (
                !empty($_POST["title"]) &&
                !empty($_POST["description"]) &&
                !empty($_POST["publish_at"])
                ) {

            }
            //Afficher un message d'erreur
            else {
                $data["error"] = "Veuillez renseigner les champs du formulaire";
            }
        }

        return $this->render("add_movie", "Add Category", $data);
    }
}
