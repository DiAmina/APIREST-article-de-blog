<?php

namespace controller;

require_once (__DIR__ . "/../model/dao/RequestUsers.php");
require_once (__DIR__ . "/../model/dao/RequestsArticle.php");
require_once (__DIR__ . "/../model/User.php");
require_once (__DIR__ . "/../model/Article.php");
require_once (__DIR__ . "/../libs/jwt_utils.php");
use model\dao\RequestUsers;
use model\dao\RequestsArticle;



// Identification du type de méthode HTTP envoyée par le client
$http_method = $_SERVER['REQUEST_METHOD'];
$requestArticle = new RequestsArticle();
$requestUser = new RequestUsers();


switch ($http_method) {
    // Cas de la méthode GET
    case "GET":
        $bearer_token = get_bearer_token();
        if (is_jwt_valid($bearer_token)) {
            $payload = get_jwt_payload($bearer_token);
            $role = $payload->role;
            if ($role == 'moderator') {
                // Récupération des critères de recherche envoyés par le Client
                $matchingData = null;
                if (isset($_GET['id'])) {
                    $matchingData = $requestArticle->getArticleId($_GET['id']);
                    //revoie les données du client et le nombre de like et dislike
                    $matchingData['likes'] = $requestArticle->getLikes($_GET['id']);
                    $matchingData['dislikes'] = $requestArticle->getDislikes($_GET['id']);
                    deliverResponse(200, "Article", $matchingData);
                }
            } else {
                $matchingData = $requestArticle->getArticles();
                deliverResponse(200, "Liste des articles", $matchingData);
            }
            } else {
                deliverResponse(401, "Votre token a expiré", null);
            }
        break;

        case
            "POST":
        $bearer_token = get_bearer_token();
        if (is_jwt_valid($bearer_token)) {
            $payload = get_jwt_payload($bearer_token);
            $role = $payload->role;
            if ($role == "publisher") {
                $auteur = $payload->username;
                $contenu = $_POST['contenu'];
                $datePub = date("Y-m-d H:i:s");
                $requestArticle->postArticle($auteur, $contenu, $datePub);
                deliverResponse(200, "Article mis à jour", null);
            } else {
                deliverResponse(401, "Vous n'avez pas le droit d'ajouter un article", null);
            }
        } else {
            deliverResponse(401, "Votre token a expiré", null);
        }
        break;
    case "PUT":
        $bearer_token = get_bearer_token();
        if (is_jwt_valid($bearer_token)) {
            $payload = get_jwt_payload($bearer_token);
            $role = $payload->role;
            if ($role == "publisher") {
                $auteur = $payload->username;
                $id = $_GET['id'];
                $contenu = $_POST['contenu'];
                $requestArticle->putArticle($id, $contenu);
                deliverResponse(200, "Article modifié", null);
            } else {
                deliverResponse(401, "Vous n'avez pas le droit de modifier un article", null);
            }
        } else {
            deliverResponse(401, "Votre token a expiré", null);
        }
    break;

    case "DELETE":
        $bearer_token = get_bearer_token();
        if (is_jwt_valid($bearer_token)) {
            $payload = get_jwt_payload($bearer_token);
            $role = $payload->role;
            if ($role == "publisher") {
                $id = $_GET['id'];
                $requestArticle->deleteLike($id);
                $requestArticle->deletedislike($id);
                $requestArticle->deleteArticle($id);
                deliverResponse(200, "Article supprimé", null);
            } else {
                deliverResponse(401, "Vous n'avez pas le droit de supprimer un article", null);
            }
        } else {
            deliverResponse(401, "Votre token a expiré", null);
        }
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
?>

