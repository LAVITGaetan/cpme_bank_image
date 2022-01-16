<?php
require_once('config.php');
$query = $pdo->prepare('SELECT * from `image` WHERE id =? LIMIT 1');
$query->execute([$_GET['id']]);
$row = $query->fetch();
$title = $row['title'];
$file_name = $row['file_name'];
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une image</title>
</head>

<body>

    <img src="upload/<?php echo $file_name; ?>">
    <h1>Modifier l'image</h1>
    <form action="update-image-action.php" method="post" enctype="multipart/form-data">
        <input name="id" type="hidden" value="<?php echo $_GET['id'] ?>">

        <div>
            <label for="">Titre
                <input name="title" type="text" placeholder="Titre de l'image" value="<?php echo $title ?>">
            </label>
        </div>
        <div>
            <input type="submit" value="Modifier l'image">
        </div>
    </form>

</body>

</html>