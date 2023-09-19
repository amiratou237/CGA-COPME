<!DOCTYPE html>
<html lang="en">

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">   
   
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
 
     <!-- Site Metas -->
     <title>Page d'administration</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> 
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Site Icons -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

    <!-- Site CSS -->
    <link rel="stylesheet" href="../style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="../css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/custom.css">
 


</head>
<body>

    
	<div class="top-bar">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-6 col-sm-6">
					<div class="left-top">
						<div class="email-box">
							<a href="mailto:centredegestionagreecopme@gmail.com"><i class="fa fa-envelope-o" aria-hidden="true"></i> centredegestionagreecopme@gmail.com</a>
						</div>
						<div class="phone-box">
							<a href="tel:237690514301"><i class="fa fa-phone" aria-hidden="true"></i>+237 690 514 301 / 679 539 393</a>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-sm-6">
					<div class="right-top">
						<div class="social-box">
							<ul>
								<li><a href="https://www.facebook.com/profile.php?id=100064189081070"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>
								<li><a href="https://www.linkedin.com/company/cga-copme/"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>
							<ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<body>
    <br>
    <div class="container">
        <div class="row align-items-center">
        <h1 class="col-4">Liste des articles</h1>
            <div class="gap-3">
                <a href="add.php" class="btn btn-success" >Ajouter un nouvel article</a> 
                <a href="../actualité.php" class="btn btn-primary" >Revenir à l'actualités</a>
            </div>

        </div>
        
        <br>
        
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Contenu</th>
                    <th>Image</th>
                    <th>Date de publication</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Inclure le fichier de configuration pour la connexion à la base de données
                require 'config.php';

                // Récupérer les articles depuis la base de données
                $sql = "SELECT * FROM article";
                $result = $conn->query($sql);

                // Vérifier s'il y a des articles à afficher
                if ($result->num_rows > 0) {
                    // Afficher chaque article dans une ligne du tableau
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["title"] . "</td>";
                        echo "<td>" . $row["content"] . "</td>";
                        echo "<td><img src='image/" . $row["image"] . "' width='100'></td>";
                        echo "<td>" . $row["created_at"] . "</td>";
                        echo "<td>";
                        echo "<a href='modify.php?id=" . $row["id"] . "' class='btn btn-primary'>Modifier</a>";
                        echo "<a href='delete.php?id=" . $row["id"] . "' class='btn btn-danger'>Supprimer</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Aucun article trouvé</td></tr>";
                }

                // Fermer la connexion à la base de données
                $conn->close();
                ?>
            </tbody>
        </table>

        
    </div>



    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
