<?php

namespace controller;

require_once (__DIR__ . "/../model/dao/RequestUsers.php");
require_once (__DIR__ . "/../model/dao/RequestsArticle.php");
require_once (__DIR__ . "/../model/User.php");
require_once (__DIR__ . "/../model/Article.php");
require_once (__DIR__ . "/../libs/jwt_utils.php");
use model\dao\RequestUsers;
use model\dao\RequestsArticle;
use model\User;
use model\Article;


// Identification du type de méthode HTTP envoyée par le client
$http_method = $_SERVER['REQUEST_METHOD'];
$requestArticle = new RequestsArticle();
switch ($http_method) {
    // Cas de la méthode GET
    case "GET":
        $bearer_token = get_bearer_token();
        if (is_jwt_valid($bearer_token)) {
            // Récupération des critères de recherche envoyés par le Client
            $matchingData = null;
            if (isset($_GET['id'])) {
                $matchingData = $requestArticle->getArticleId($_GET['id']);
                deliverResponse(200, "Article", $matchingData);
            }
        } else {
            $matchingData = $requestArticle->getArticles();
            deliverResponse(200, "Liste des articles", $matchingData);
        }
    case "POST":
        break;
    case "PUT":
        break;
    case "DELETE":
        break;
    default:
        deliverResponse(405, "Méthode non autorisée", null);
        break;
}
// Envoi de la réponse au Client
function deliverResponse($status, $statusMessage, $data): void
{
    // Paramétrage de l'entête HTTP, suite
    header("HTTP/1.1 $status $statusMessage");

    // Paramétrage de la réponse retournée
    $response['status'] = $status;
    $response['status_message'] = $statusMessage;
    $response['data'] = $data;

    // Mapping de la réponse au format JSON
    $jsonResponse = json_encode($response);
    echo $jsonResponse;
}


/* algo
si le rôle est publisher then
    post, get
    fin if;
    if le nom de l'auteur == a nom du publisher connecter the
        delete, post, put
    fin if;
*/

