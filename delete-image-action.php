<?php
session_start();

        require_once('config.php');
        $query = $pdo->prepare('UPDATE `image` SET `status`=? WHERE id = ?')->execute([0, $_GET['id']]);
        header('location: image.php');
