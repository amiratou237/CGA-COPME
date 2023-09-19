<?php
// Inclure le fichier de configuration pour la connexion à la base de données
require 'config.php';

// Vérifier si l'ID de l'article est passé en paramètre
if (isset($_GET["id"])) {
    $articleId = $_GET["id"];

    // Supprimer l'article de la base de données
    $sql = "DELETE FROM article WHERE id = $articleId";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Erreur lors de la suppression de l'article: " . $conn->error;
    }
} else {
    echo "ID de l'article non spécifié";
    exit();
}

// Fermer la connexion à la base de données
$conn->close();
?>
