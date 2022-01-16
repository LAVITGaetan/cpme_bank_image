<?php

// Si le formulaire est envoyé
if($_SERVER["REQUEST_METHOD"] == "POST"){
if(isset($_FILES["image"]) && $_FILES["image"]["error"] == 0){  

    //Stockage des données de l'image
    $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
    $filename = $_FILES["image"]["name"];
    $filetype = $_FILES["image"]["type"];
    $filesize = $_FILES["image"]["size"];

    // Vérifie l'extension du fichier
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if(!array_key_exists($ext, $allowed)) die("Erreur: Veuillez sélectionner un format autorisé.");

    // Vérifie la taille du fichier - 5MB 
    $maxsize = 5 * 1024 * 1024;
    if($filesize > $maxsize) die("Erreur: La taille du fichier dépasse la limite de 5MB.");


    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if(in_array($filetype, $allowed)){
        // Vérifie si le fichier existe déjà
        if(file_exists("upload/" . $filename)){
            $filename = generateRandomString();
        }
            move_uploaded_file($_FILES["image"]["tmp_name"], "upload/" . $filename);
            echo "Le fichier à été ajouté avec succés.";
            require_once('config.php');
            $query = $pdo->prepare('INSERT into `image` (`file_name`, `title`, `created`) VALUES(?,?,?)')->execute([$filename, $_POST['title'], date('d-m-y h:i:s')]);
            header('location: image.php');
        } 
        else{
            echo "Erreur: Une erreur est survenue."; 
        }
        } else{
            echo "Erreur: " . $_FILES["image"]["error"];
        }
}


function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}