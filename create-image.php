<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une image</title>
</head>
<body>
    
<form action="create-image-action.php" method="post" enctype="multipart/form-data">
<div>
    <label for="">Titre
        <input name="title" type="text" placeholder="Titre de l'image">
    </label>
</div>
<div>
    <label for="">Selectionnez une image
        <input name="image" type="file">
    </label>
</div>
<div>
        <input type="submit" value="Ajouter une image">
</div>
<p><strong>Formats autorisés:</strong> .jpg, .jpeg, et .png</p>
</form>

</body>
</html>