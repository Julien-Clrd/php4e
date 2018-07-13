<?php
require_once("inc/init.inc.php");
if(!internauteEstConnecte()) // si l'internaute n'est pas connecté, il n'a rien à faire sur la page profil, on le redirige alors vers la page connexion;
{
    header("location:connexion.php");
}









require_once("inc/header.inc.php");


?>


<div class="col-md-8 col-md-offset-2 panel-default border">
    <div class="panel-heading text-center"><h1>PROFIL</h1></div>
    <div class="col-md-12 text-center">
        
            <!-- Tentez d'afficher le pseudo de l'internaute pour lui dire bonjour -->
            <h2>Bonjour <span class="text-danger"><?= $_SESSION['membre']['pseudo']?></span><?php
            $content
            ?></h2>

        <ul class="list-unstyled">
            <li><h3>Voici les information de votre profil</h3></li>
            <li>Nom : <?= $_SESSION['membre']['nom']?></li>
            <li>Prénom : <?= $_SESSION['membre']['prenom']?></li>
            <li>Email : <?= $_SESSION['membre']['email']?></li>
            <li>Code postal : <?= $_SESSION['membre']['code_postal']?></li>
            <li>Adresse : <?= $_SESSION['membre']['adresse']?></li>
            <li>Ville: <?= $_SESSION['membre']['ville']?></li>


        </ul>
    </div>
</div>


<?php
require_once("inc/footer.inc.php");
?>