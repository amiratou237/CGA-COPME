<?php
// Inclure le fichier de configuration pour la connexion à la base de données
require 'config.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs du formulaire
    $title = mysqli_real_escape_string($conn, $_POST["title"]);
    $content = mysqli_real_escape_string($conn, $_POST["content"]);
    $image = $_FILES["image"];

    // Vérifier si une image a été sélectionnée
    if ($image["name"]) {
        // Créer un nom unique pour l'image en ajoutant un timestamp
        $imageName = time() . '_' . $image["name"];

        // Déplacer l'image vers le dossier image
        move_uploaded_file($image["tmp_name"], "image/" . $imageName);
    } else {
        // Définir un nom d'image par défaut si aucune image n'a été sélectionnée
        $imageName = "default.jpg";
    }

    // Préparer la requête SQL pour insérer l'article dans la base de données
    $sql = "INSERT INTO article (title, content, image, created_at) VALUES ('$title', '$content', '$imageName', NOW())";

    // Exécuter la requête SQL
    if ($conn->query($sql) === TRUE) {
        // Rediriger l'utilisateur vers index.php avec un message de succès
        header("Location: index.php?success=Article ajouté avec succès");
        exit();
    } else {
        echo "Erreur lors de l'ajout de l'article: " . $conn->error;
    }
}

// Fermer la connexion à la base de données
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un article</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Ajouter un article</h2>
        <form action="add.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Titre:</label>
                <input type="text" class="form-control" id="title" name="title" required placeholder="un titre pour votre article">
            </div>
            <div class="form-group">
                <label for="content">Contenu:</label>
                <textarea class="form-control" id="content" name="content" required placeholder="une bref description de l'article ?"></textarea>
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" class="form-control-file" id="image" name="image" required placeholder="une image pour illustrer">
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
