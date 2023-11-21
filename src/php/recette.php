<?php
// recupération des données requêtes
include_once("connectionDB.php");
# code...
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");



$data = array();
$action = '';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
}
//condion si les action sont bien envoyer
try {
    //code...
    if ($action == 'ajout') {

        $montant = $_POST['montant'];
        $motif = $_POST['motif'];
        $date = $_POST['date'];
        $userID = $_POST['userID'];

        $sql = "INSERT INTO `RECETTE`(`id`, `montant`, `motif`, `date`, `user_id`) VALUES (null,:montant,:motif,:daty,:userID)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':montant', $montant);
        $stmt->bindParam(':motif', $motif);
        $stmt->bindParam(':daty', $date);
        $stmt->bindParam(':userID', $userID);

        if ($stmt->execute()) {
            // $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // $data['donnes'] = $results;
            $data['success'] = true;
            $data['message'] = 'Les données sont bien enregistrer';
        } else {
            # code...
            $data['success'] = false;
            $data['message'] = 'Les données ne sont pas bien enregistrer';
        }
    } 
} catch (PDOException $e) {
    $data['message'] = 'Error à l\'Exception PDO :' . $e->getMessage();
}


try {
    //code...
    if ($action == 'list') {
        $userID = $_POST['userID'];

        $sql = "SELECT * FROM `RECETTE` WHERE user_id = :userID ORDER BY id DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':userID', $userID);

        if ($stmt->execute()) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $data['donnees'] = $results;
            $data['success'] = true;
            $data['message'] = 'Les données sont bien recuperer';
        } else {
            # code...
            $data['success'] = false;
            $data['message'] = 'Les données ne sont pas bien recuperer';
        }
    } 
} catch (PDOException $e) {
    $data['message'] = 'Error à l\'Exception PDO :' . $e->getMessage();
}


$pdo = null;
echo json_encode($data);
die();
