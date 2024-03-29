<?php

//Génère le token JWT
function generate_jwt($headers, $payload, $secret = 'secret') {

	$headers_encoded = base64url_encode(json_encode($headers));

	$payload_encoded = base64url_encode(json_encode($payload));

	$signature = hash_hmac('SHA256', "$headers_encoded.$payload_encoded", $secret, true);
	$signature_encoded = base64url_encode($signature);

	$jwt = "$headers_encoded.$payload_encoded.$signature_encoded";

	return $jwt;
}

//Vérifie si le token est valide
function is_jwt_valid($jwt, $secret = 'secret') {
	// split le jwt
	$tokenParts = explode('.', $jwt);
	$header = base64_decode($tokenParts[0]);
	$payload = base64_decode($tokenParts[1]);
	$signature_provided = $tokenParts[2];

	//Vérifie le temps d'expiration, il y'aura une erreur si le token n'expire jamais
	$expiration = json_decode($payload)->exp;
	$is_token_expired = ($expiration - time()) < 0;

	//Construit une signature basée sur le header et le payload en utilisant le SECRET
	$base64_url_header = base64url_encode($header);
	$base64_url_payload = base64url_encode($payload);
	$signature = hash_hmac('SHA256', $base64_url_header . "." . $base64_url_payload, $secret, true);
	$base64_url_signature = base64url_encode($signature);

	//Vérifie si la signature matche bien avec celle fournie dans le JWT
	$is_signature_valid = ($base64_url_signature === $signature_provided);

	if ($is_token_expired || !$is_signature_valid) {
		return FALSE;
	} else {
		return TRUE;
	}
}

//On "nettoie" les valeurs encodées
//On retire les +, / et =
function base64url_encode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

//On vérifie si on reçoit un token
function get_authorization_header(){
	$headers = null;

	if (isset($_SERVER['Authorization'])) {
		$headers = trim($_SERVER["Authorization"]);
	} else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { 
		$headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
	} else if (function_exists('apache_request_headers')) {
		$requestHeaders = apache_request_headers();
		$requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
		//print_r($requestHeaders);
		if (isset($requestHeaders['Authorization'])) {
			$headers = trim($requestHeaders['Authorization']);
		}
	}

	return $headers;
}

function get_bearer_token() {
    $headers = get_authorization_header();

    // HEADER: Obtient le jeton d'accès à partir de l'en-tête
    if (!empty($headers)) {
        if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
            return $matches[1];
        }
    }
    return null;
}


 //Récupère la charge utile (payload) d'un jeton JWT
function get_jwt_payload(string $jwt): object {
    // Séparation de l'en-tête, de la charge utile et de la signature du jeton JWT
    $jwt_parts = explode(".", $jwt);
    $jwt_payload_base64 = $jwt_parts[1];
    // Décodage de la charge utile au format JSON
    $jwt_payload_json = base64_decode($jwt_payload_base64);
    // Transformation de la charge utile en objet PHP
    $jwt_payload = json_decode($jwt_payload_json);
    return $jwt_payload;
}


?>
