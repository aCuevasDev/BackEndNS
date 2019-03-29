<?php
/**
 * Created by PhpStorm.
 * User: alexc
 * Date: 21/03/2019
 * Time: 19:12
 */

require_once('token.php');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type,
Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
/*SI NO HAY TOKEN, CREAMOS EL TOKEN CON LA INFO DEL USUARIO*/
$data = file_get_contents('php://input'); //$data = {“nom”:”juan”,”pass”:”1234}
$token = jwtGetCodeJSON($data);
echo '{"token":"' . $token . '"}';
//$arrayAssoc = json_decode($data);
//echo "nom: ". $arrayAssoc->nom;
//THIS SHOULD BE COMMENTED I THINK

function checkAuthToken()
{
    $headers = apache_request_headers();
    if (isset($headers["Authorization"]) && $headers["Authorization"] != "") {
        $token_recibido = $headers["Authorization"];
        if (jwtCheckCodeJSON($token_recibido)) {//SI HAY TOKEN, MIRAMOS SI ES CORRECTO
// podemos extraer el encabezado, el contenido y la signatura.
            $jwt_values = explode('.', $jwt_token);
            $payload = base64_decode($jwt_values[1]);
            return json_encode($payload);
        }
    }
}


?>