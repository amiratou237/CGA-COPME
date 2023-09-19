<?php
// Inclure le fichier de configuration pour la connexion à la base de données
require 'config.php';

// Vérifier si l'ID de l'article est passé en paramètre
if (isset($_GET["id"])) {
    $articleId = $_GET["id"];

    // Récupérer les données de l'article depuis la base de données
    $sql = "SELECT * FROM article WHERE id = $articleId";
    $result = $conn->query($sql);

    // Vérifier si l'article existe
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id = $row["id"];
        $title = $row["title"];
        $content = $row["content"];
        $image = $row["image"];
    } else {
        echo "Aucun article trouvé";
        exit();
    }
} else {
    echo "ID de l'article non spécifié";
    exit();
}

// Fermer la connexion à la base de données
$conn->close();
?>
<?php
// Inclure le fichier de configuration pour la connexion à la base de données
require 'config.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs du formulaire
    $id = $_POST["id"];
    $title = $_POST["title"];
    $content = $_POST["content"];
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

    // Préparer la requête SQL pour mettre à jour l'article dans la base de données
    $sql = "UPDATE article SET title='$title', content='$content', image='$imageName' WHERE id=$id";

    // Exécuter la requête SQL
    if ($conn->query($sql) === TRUE) {
        // Rediriger l'utilisateur vers index.php avec un message de succès
        header("Location: index.php?success=Article modifié avec succès");
        exit();
    } else {
        echo "Erreur lors de la modification de l'article: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Modifier un article</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <h1>Modifier un article</h1>

    <form action="" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <div class="form-group">
        <label for="title">Titre:</label>
        <input type="text" class="form-control" id="title" name="title" value="<?php echo $title; ?>" required>
      </div>
      <div class="form-group">
        <label for="content">Contenu:</label>
        <textarea class="form-control" id="content" name="content" required><?php echo $content; ?></textarea>
      </div>
      <div class="form-group">
        <label for="image">Image:</label>
        <input type="file" class="form-control-file" id="image" name="image" required>
        <img src="image/<?php echo $image; ?>" width="100">
      </div>
      <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
