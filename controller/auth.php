<?php

namespace controller;

require_once (__DIR__ . "/../model/dao/Database.php");
require_once (__DIR__ . "/../model/dao/RequestUsers.php");
require_once (__DIR__ . "/../model/User.php");
require_once (__DIR__ . "/../libs/jwt_utils.php");

use model\dao\RequestUsers;
use model\dao\Database;
use model\User;



// Paramétrage de l'entête HTTP (pour la réponse au Client)
header("Content-Type:application/json");

// Identification du type de méthode HTTP envoyée par le client
$http_method = $_SERVER['REQUEST_METHOD'];
if ($http_method == 'POST'){
    $data = (array) json_decode(file_get_contents('php://input'), true);
    $pass = hash('sha256',$data['password']);
    if (isValidUser($data['username'], $pass)){
        // Traitement
        $username = $data['username'];
        $headers = array(
            'typ' => 'JWT',
            'alg' => 'HS256'
        );

        $login = $data['username'];
        $password = $pass;
        $requestUsers = new RequestUsers();
        $user = $requestUsers->getUser($login, $password);
        $role = $user->getRole();
        $payload = array(
            'username' => $username,
            'exp' => (time() + 600),
            'role' => $role
        );
        $jwt = generate_jwt($headers, $payload);
        deliverResponse(200, "Vous êtes connecté en tant que $username", $jwt);
    } else {
        deliverResponse(401, "Vous n'êtes pas autorisé à accéder à cette ressource", null);
    }
}

function deliverResponse($status, $statusMessage,$data): void{
    // Paramétrage de l'entête HTTP, suite
    header("HTTP/1.1 $status $statusMessage");

    // Paramétrage de la réponse retournée
    $response['status'] = $status;
    $response['status_message'] = $statusMessage;
    $response['jeton'] = $data;

    // Mapping de la réponse au format JSON
    $jsonResponse = json_encode($response);
    echo $jsonResponse;
}

//Vérifie si l'utilisateur est valide
function isValidUser($username,$password): bool{
    $requestUsers = new RequestUsers();
    $user = $requestUsers->getUser($username, $password);
    if ($user == null){
        return false;
    }
    return true;
}
?>

