<?php
    try {
        $user = "root";
        $pass = "";
        $pdo = new PDO('mysql:host=127.0.0.1;dbname=cpme-tools', $user, $pass);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
?>
