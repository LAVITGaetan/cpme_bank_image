<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galerie d'images</title>
    <link rel="stylesheet" href="style.css">
</head>


<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .bank-flex-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-evenly;
    }

    #imageUrlInput {
        width: 1px;
        height: 1px;
        color: #fff;
        background: #fff;
        outline: none;
        border: none;
    }

    /**/
</style>

<body>

    
    <input type="text" id="imageUrlInput">
    <a href="create-image.php">Ajouter une image</a>

    <div>
        <input type="search" name="searchBox" placeholder="Votre recherche.." id="searchBox" onkeyup="searchImage()">

    </div>

    <div class="bank-flex-container">
        <?php
        require_once('config.php');
        $sql = $pdo->prepare('SELECT * FROM image WHERE `status` =1');
        if (isset($_SESSION['searchQuery'])) {
            echo 'test';
        }
        $sql->execute();
        $images = $sql->fetchAll();
        foreach ($images as $image) {
            $confirm = "Voulez vous vraiment supprimer " . $image['title'] . " ?";

            echo '<div class="galery-card">
            <div style="background-image: url(upload/'. $image["file_name"] .'" class="galery-image">
                <div class="galery-card-settings">
                    <img src="assets/iphone.png" alt="composant" class="galery-card-action">
                    <img src="assets/download.png" alt="télécharger" class="galery-card-action">
                    <a href="delete-image-action.php?id=' . $image['id'] . '" onclick="checkDelete()" class="remove-container">
                    <img src="assets/remove.png" alt="supprimer" class="galery-card-action">
                    </a>
                </div>
                <div class="galery-card-title">
                '.$image['title'].'
                </div>
            </div>
            <div onclick=\'getImageUrl("' . $image['file_name'] . '")\' class="galery-card-button">
                Copier
            </div>
        </div>';
        }
        ?>
    </div>
    <script>
        function checkDelete() {
            return confirm('Voulez vous vraiment supprimer cette image ?');
        }

        function searchImage() {
            console.log('initialisation...');
            let searchQuery = document.getElementById('searchBox');
            let filter = searchQuery.value.toUpperCase();
            let title = document.getElementsByClassName('galery-card-title');
            let container = document.getElementsByClassName('galery-card');
            for (let i = 0; i < title.length; i++) {
                if (title[i].innerText.toUpperCase().includes(searchQuery.value.toUpperCase())) {
                    container[i].style.display = "";
                    console.log(true);
                } else {
                    console.log(false);
                    container[i].style.display = "none";
                }
            }
            console.log('fin d\'execution...');
        }

        function getImageUrl(current) {
            let path = 'https://cpmereunion-tools.link/upload/' + current;
            let input = document.getElementById('imageUrlInput');
            input.value = path;
            input.select();
            input.setSelectionRange(0, 99999); /* Mobile */
            navigator.clipboard.writeText(input.value);
            alert("Copié dans le presse-papier: " + path);
        }
    </script>
</body>

</html>