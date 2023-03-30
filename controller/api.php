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
        var_dump($payload);
        $role = $payload->role;
        if (isset($_GET['id'])) {
            $matchingData = null;
            // Récupération des critères de recherche envoyés par le Client
            $matchingData = $requestArticle->getArticleId($_GET['id']);
            if ($role == 'moderator') {
                //revoie les données du client et le nombre de like et dislike
                $matchingData ['likes'] = $requestArticle->getLikes($_GET['id']);
                $matchingData ['dislike'] = $requestArticle->getDislikes($_GET['id']);
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
    // Cas de la méthode POST
    case "POST":
    $bearer_token = get_bearer_token();
    if (is_jwt_valid($bearer_token)) {
        $payload = get_jwt_payload($bearer_token);
        $role = $payload->role;
        if ($role == "publisher") {
            $auteur = $payload->username;
            $data = json_decode(file_get_contents('php://input'), true);
            $contenu = $data['contenu'];
            //$data ['contenu'] = $contenu;
            $datePub = date("Y-m-d H:i:s");
            $requestArticle->postArticle($auteur, $contenu, $datePub);
            deliverResponse(200, "Article mis à jour", $data);
        } else {
            deliverResponse(401, "Vous n'avez pas le droit d'ajouter un article", null);
        }
    } else {
        deliverResponse(401, "Votre token a expiré", null);
    }
    break;

    // Cas de la méthode PATCH
    case "PATCH":
        $bearer_token = get_bearer_token();
        if (is_jwt_valid($bearer_token)) {
            $payload = get_jwt_payload($bearer_token);
            $role = $payload->role;
            if ($role == "publisher") {
                $auteur = $payload->username;
                $id = $_GET['id'];
                $article = $requestArticle->getArticles($id);
                if ($article) {
                    $contenu = $_POST['contenu'];
                    if (!empty($contenu)) {
                        $requestArticle->patchArticle($id, $contenu);
                        deliverResponse(200, "Article modifié", null);
                    } else {
                        deliverResponse(400, "Le champ contenu est requis", null);
                    }
                } else {
                    deliverResponse(404, "L'article n'existe pas", null);
                }
            } else {
                deliverResponse(401, "Vous n'avez pas le droit de modifier un article", null);
            }
        } else {
            deliverResponse(401, "Votre token a expiré", null);
        }
    break;
    
    //Cas de la méthode PUT
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

//Cas de la méthode DELETE
case "DELETE":
    $bearer_token = get_bearer_token();
    if (is_jwt_valid($bearer_token)) {
        $payload = get_jwt_payload($bearer_token);
        $role = $payload->role;
        if ($role == "publisher") {
            $id = $_GET['id'];
            $auteur = $_GET['auteur'];
            $requestArticle->deleteLike($id,$auteur);
            $requestArticle->deletedislike($id,$auteur);
            $requestArticle->deleteArticle($id,$auteur);
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

