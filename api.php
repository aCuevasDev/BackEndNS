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
$token =jwtGetCodeJSON($data);
echo '{"token":"'.$token.'"}';
$arrayAssoc = json_decode($data);
echo "nom: ". $arrayAssoc->nom;


?>