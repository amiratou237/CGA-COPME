<!DOCTYPE html>
<html lang="en">

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">   
   
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
 
     <!-- Site Metas -->
    <title>CGA-CoPME</title>  
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="style.css">  
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">

    <!-- Modernizer for Portfolio -->
    <script src="js/modernizer.js"></script>

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

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
    <header class="header header_style_01">
        <nav class="megamenu navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                      <a class="navbar-brand" href="index.html"><img src="images/logos/logo.png" alt="image"></a>
                </div>

                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="index.html" >Accueil</a></li>
                        <li><a href="about-us.html">A propos de nous</a></li>
                        <li><a href="services.html">Nos Services</a></li>
                        <li><a href="formation.html">Formation</a></li>
                        <li><a class="active" href="actualité.php">Actualités</a></li>
                        <li><a href="contact.html">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

   	<div class="banner-area banner-bg-1">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="banner">
						<h2>Actualités</h2>
						<ul class="page-title-link">
							<li><a href="#">Accueil</a></li>
							<li><a href="#">Actualités</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
  <div class="container" data-aos="fade-up">

    <div class="row">

      <div class="col-lg-8 entries">

        <?php
        // Inclure le fichier de configuration pour la connexion à la base de données
        require 'admin/config.php';

        // Récupérer les articles depuis la base de données
        $sql = "SELECT * FROM article";
        $result = $conn->query($sql);

        // Vérifier s'il y a des articles à afficher
        if ($result->num_rows > 0) {
            // Afficher chaque article
            while ($row = $result->fetch_assoc()) {
                echo "<article class='entry'>";
                echo "<div class='entry-img'>";
                echo "<img src='admin/image/" . $row["image"] . "' alt='' class='img-fluid'>";
                echo "</div>";
                echo "<h2 class='entry-title'>";
                echo "<a href=''>" . $row["title"] . "</a>";
                echo "</h2>";
                echo "<div class='entry-meta'>";
                echo "<ul>";
                echo "<li class='d-flex align-items-center'><i class='bi bi-clock'></i> <a href=''><time datetime='2020-01-01'>" . $row["created_at"] . "</time></a></li>";
                echo "</ul>";
                echo "</div>";
                echo "<div class='entry-content'>";
                echo "<p>";
                echo $row["content"];
                echo "</p>";
                echo "<div class='read-more'>";
                echo "<a href='contact.html#contact'>plus d'information</a>";
                echo "</div>";
                echo "</div>";
                echo "</article><!-- End blog entry -->";
            }
        } else {
            echo "<p>Aucun article trouvé</p>";
        }

        // Fermer la connexion à la base de données
        $conn->close();
        ?>

        <?php
        // Inclure le fichier de configuration pour la connexion à la base de données
        require 'admin/config.php';

        // Fonction de pagination
        function paginate($totalPages)
        {
            $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

            echo "<div class='blog-pagination'>";
            echo "<ul class='justify-content-center'>";

            for ($i = 1; $i <= $totalPages; $i++) {
                $activeClass = ($i == $currentPage) ? "active" : "";
                echo "<li class='$activeClass'><a href='?page=$i'>$i</a></li>";
            }

            echo "</ul>";
            echo "</div>";
        }

        // Récupérer les articles depuis la base de données
        $limit = 7; // Nombre d'articles par page
        $page = isset($_GET['page']) ? $_GET['page'] : 1; // Numéro de page courante
        $offset = ($page - 1) * $limit; // Calcul de l'offset


        $sql = "SELECT * FROM article";
        $totalArticles = $conn->query($sql)->num_rows; // Nombre total d'articles


        $sql .= " LIMIT $limit OFFSET $offset"; // Limiter les articles à afficher

        $result = $conn->query($sql);

        // Afficher la pagination
        $totalPages = ceil($totalArticles / $limit); // Calculer le nombre total de pages
        paginate($totalPages);

        // Fermer la connexion à la base de données
        $conn->close();
        ?>


      </div><!-- End blog entries list -->

      <div class="col-lg-4">

        <div class="sidebar">

        <h3 class="sidebar-title">Recherche</h3>
        <div class="sidebar-item search-form">
        <form action="" method="GET">
            <input type="text" name="search" placeholder="Rechercher...">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
        </div><!-- End sidebar search form -->
        <!-- End sidebar search form -->
            <?php
                // Inclure le fichier de configuration pour la connexion à la base de données
                require 'admin/config.php';

                // Vérifier si un terme de recherche est spécifié
                if (isset($_GET['search'])) {
                $search = $_GET['search'];
                // Récupérer les articles correspondants depuis la base de données
                $sql = "SELECT * FROM article WHERE title LIKE '%$search%'";
                } else {
                // Récupérer tous les articles depuis la base de données
                $sql = "SELECT * FROM article";
                }

                $result = $conn->query($sql);

                // Vérifier s'il y a des articles à afficher
                if ($result->num_rows > 0) {
                // Afficher chaque article
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='sidebar-item recent-posts'>";
                    echo "<div class='post-item clearfix'>";
                    echo "<img src='admin/image/" . $row["image"] . "' alt=''>";
                    echo "<h4><a href='#'>" . $row["title"] . "</a></h4>";
                    echo "<time datetime='2020-01-01'>" . $row["created_at"] . "</time>";
                    echo "</div>";
                    echo "</div>";
                }
                } else {
                echo "<p>Aucun article trouvé</p>";
                }

                // Fermer la connexion à la base de données
                $conn->close();
            ?>

        </div><!-- End sidebar -->

      </div><!-- End blog sidebar -->

    </div>

  </div>
</section><!-- End Blog Section -->



    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="widget clearfix">
                        <div class="widget-title">
                           <img src="images/logos/logo.png" alt="" />
                        </div>
                        <p>Un CGA (Centre de Gestion Agrée), est une association agréée par le Ministre en chargé des Finances dont le but est d'apporter une assistance en matière de gestion, d'encadrement et d'exécution des obligations fiscales et comptables aux petites entreprises adhérentes, réalisant un chiffre d'affaires annuel compris entre 0 et 100 millions de FCFA</p>
                        
                    </div><!-- end clearfix -->
                </div><!-- end col -->

				<div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="widget clearfix">
                        <div class="widget-title">
                            <h3>Pages</h3>
                        </div>

                        <ul class="footer-links hov">
                          <li><a href="index.html">Accueil</a></li>
                          <li><a href="about-us.html">A propos de nous</a></li>
                          <li><a href="services.html">Nos Services</a></li>
                          <li><a href="formation.html">Formation</a></li>
                          <li><a href="contact.html">Contact</a></li>
                        </ul><!-- end links -->
                    </div><!-- end clearfix -->
                </div><!-- end col -->
				
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="footer-distributed widget clearfix">
                        <div class="widget-title">
                            <h3>Vous êtes prêts à adhérer ?</h3>
                        </div>
						
                        <div class="footer-right">
                          <div class="lien">
                                            <a href="uploads/Présentation CGA CoPME (2).pdf" download="Présentation">Télecharger la brochure
                                              <img src="images/icon/icone.svg">  </a>
                                            </div>
                        </div>                        
                    </div><!-- end clearfix -->
                </div><!-- end col -->
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div class="footer-distributed widget clearfix">
                      <div class="widget-title"> <br>
                          <h3>Démander votre bulletin d'adhésion aux contacts ci-dessous:</h3>
                      </div>
          
                      <div class="footer-right">
                        <div class="lien">
                            Antenne de Yaoundé : +237 2 22 23 10 73 - 690 51 43 01 - 679 539 393 <br>
                            Antenne de Douala : +237 6 99 17 17 52 - 6 52 45 77 04 - 6 94 02 04 96 <br>
                            Antenne de Limbé : +237 6 95 20 03 77 <br>
                            Antenne de Garoua : +237 6 71 14 78 53 <br>
                            Fax: +237 2 22 23 10 73-B.P: 35538 Yaoundé-Cameroun <br>
                            E-mail: centredegestionagreecopme@gmail.com <br>
                            Site Web : www.cga-copme.org <br>
                            Agrément N°00000368 / MINFI / DGI / du 08 Sept.2015 <br>
                            recipissé de déclaration d'Association N°0000774 / RDA / j06 / BAPP <br>
                        </div>
                      </div>                        
                  </div><!-- end clearfix -->
              </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </footer><!-- end footer -->

    <div class="copyrights">
      <div class="container">
          <div class="footer-distributed">
              <div class="footer-left">                   
                  <p class="footer-company-name">All Rights Reserved. &copy; 2023 <a href="#">CGA-CoPME</a> Design By : 
        <a href="https://www.ictbusinesscenter.com/">ICT Business center 2.0</a></p>
              </div>

              
          </div>
      </div><!-- end container -->
  </div><!-- end copyrights -->

    <a href="#" id="scroll-to-top" class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>

</body>
</html>

