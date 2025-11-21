<?php 

namespace App\Controller;

use App\Controller\AbstractController;

class ErrorController extends AbstractController
{
    /**
     * Méthode pour afficher l'erreur 404 la ressource n'existe pas
     * @return mixed Retourne le template
     */
    public function error404(): mixed
    {
        http_response_code(404);
        return $this->render("error404", "Error404");
    }

    /**
     * Méthode pour afficher l'erreur 401 problème de droit (Grant)
     * @return mixed Retourne le template
     */
    public function error401()
    {
        return $this->render("error401", "Error401");
    }
}
