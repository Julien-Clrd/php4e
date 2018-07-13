<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Ma boutique</title>

    <!-- Bootstrap core CSS -->
    <link href="<?= URL ?>inc/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= URL ?>inc/css/style.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse ma-nav">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Ma boutique</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            
            <?php
          if(internauteEstConnecteEtEstAdmin())
          { // Accès admin
            echo '<li><a href=" ' . URL .'admin/gestion_membre.php">Gestion des membres</a></li>';
            echo '<li><a href=" ' . URL .'admin/gestion_commande.php">Gestion des commandes</a></li>';
            echo '<li><a href=" '. URL .'admin/gestion_boutique.php">Gestion boutique</a></li>';
          }
          if(internauteEstConnecte())
          { // Accès membre
            echo '<li><a href=" '. URL .'profil.php">Profil</a></li>';
            echo '<li><a href=" '. URL .'boutique.php">Boutique</a></li>';
            if(isset($_SESSION['panier']))
            {
              echo '<li><a href="'.URL.'panier.php"> Mon Panier <span class="badge">'.array_sum($_SESSION['panier']['quantite']).'</span></a></li>';
            }
            else
            {
              echo '<li><a href="'.URL.'panier.php"> Mon Panier</a></li>';
            }
            echo '<li><a href=" '. URL . 'connexion.php?action=deconnexion">Déconnexion</a></li>';
          }
          else 
          { // accès visiteur
            echo '<li><a href=" '. URL .'inscription.php">Inscription</a></li>';
            echo '<li><a href=" '. URL .'connexion.php">Connexion</a></li>';
            echo '<li><a href=" '. URL .'boutique.php">Boutique</a></li>';
            if(isset($_SESSION['panier']))
              {
                echo '<li><a href="'.URL.'panier.php"> Mon Panier <span class="badge">'.array_sum($_SESSION['panier']['quantite']).'</span></a></li>';
              }
              else
              {
                echo '<li><a href="'.URL.'panier.php"> Mon Panier</a></li>';
              }
          }







          ?>



          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container mon-conteneur">