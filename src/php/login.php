<?php
// recupération des données requêtes
include_once("connectionDB.php");
# code...
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");


// Assurez-vous d'ajuster le chemin selon votre structure de fichiers
require_once '../../vendor/autoload.php'; 
use Firebase\JWT\JWT;

$data = array();
$action = '';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
}
//condion si les action sont bien envoyer
try {
    //code...
    if ($action == 'conn') {

        $username = $_POST['username'];
        $password = $_POST['password'];
        $keySecret="zifukoro22";

        $sql = "SELECT * FROM UTILISATEUR WHERE matricule=:mat AND motdepasse =:pwd;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':mat', $username);
        $stmt->bindParam(':pwd', $password);

        if ($stmt->execute()) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($results) {
                $token = array(
                    "user_id" => $results[0]['id'],
                    "matricule" => $results[0]['matricule'],
                    "nom" => $results[0]['nom'],
                    "prenom" => $results[0]['prenom'],
                    "role" => $results[0]['role'],
                    "telephone" => $results[0]['telephone'],
                );
                
                $jwt = JWT::encode($token, $keySecret, 'HS256');
                $data['token'] = $jwt;
               
                $data['success'] = true;
                $data['message'] = 'vous etes connecter...';
            }else{
                # code...
                $data['success'] = false;
                $data['message'] = 'votre matricule ou mot de passe sont incorrect';
            }
           
        } else {
            $data['success'] = false;
            $data['message'] = 'Erreur lors de l\'exécution de la requête.';

        }
    }
} catch (PDOException $e) {
    $data['message'] = 'Error à l\'Exception PDO :'. $e->getMessage();
   
}
$pdo= null;
echo json_encode($data);
die();
