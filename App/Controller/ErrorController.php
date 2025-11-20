<?php 

namespace App\Controller;

class ErrorController
{
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
