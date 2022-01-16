<?php

// Si le formulaire est envoyé
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["title"])) {

        require_once('config.php');
        $query = $pdo->prepare('UPDATE `image` SET `title`=?, updated=? WHERE id = ?')->execute([$_POST['title'], date('d-m-y h:i:s'), $_POST['id']]);
        header('location: image.php');
    }
}
