<?php
require_once 'modules/jwt-utils.php';

// Paramétrage de l'entête HTTP (pour la réponse au Client)
header("Content-Type:application/json");

// Identification du type de méthode HTTP envoyée par le client
$http_method = $_SERVER['REQUEST_METHOD'];
if ($http_method == 'POST'){
    $data = (array) json_decode(file_get_contents('php://input'), true);
    if (isValidUser($data['username'], $data['password'], $data['role'])){
        // Traitement
        $username = $data['username'];
        $headers = array(
            'typ' => 'JWT',
            'alg' => 'HS256'
        );

        $payload = array(
            'username' => $username,
            'exp' => (time() + 400),
            'role' => $data['role']
        );
        $jwt = generate_jwt($headers, $payload);
        deliverResponse(200, "Vous êtes connecté", $jwt);
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

function isValidUser($username,$password,$role): bool{
    $users = array(
        'username' => 'amina',
        'password' => '$iutinfo',
        'role' => 'publisher'
    );
    if ($username == $users['username'] && $password == $users['password'] && $role == $users['role']){
        return true;
    }
    return false;


/*if ($role == $users['publisher']){
        $permissions = array(
            'publisher' => array('getAllElements', 'insertData', 'deleteElement','updateElement'),
            //'users' => array('read')
            );
            }
        }*/
    }
        //faire un try catch ou sinon un switch case pour tester si le libellé du role existe dans le tableau
        //si oui, donner les droits correspondants
        //sinon, on retourne un message d'erreur
    
     $http_method = $_SERVER['REQUEST_METHOD'];
    switch ($http_method){
        $bearer_token = get_bearer_token();
        //Decode le token de l'utilisateur
        $matchingData = decode_jwt($bearer_token);
        if (is_jwt_valid($bearer_token)){
            // si le rôle est moderateur
            
            // Envoi de la réponse au Client
            deliverResponse(200, "Vous êtes connecté en tant que ", $matchingData);
        } else{

            //doit renvoyer un utilisateur anonyme
            

            }
        break;
        }



?>