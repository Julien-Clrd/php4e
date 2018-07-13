<?php
require_once("inc/init.inc.php");
require_once("inc/header.inc.php");

// EXO : Réaliser une fiche produit avec les informations : titre, categorie, couleur, taille, description, public...

if(isset($_GET['id_produit']));
    $resultat = $pdo->prepare("SELECT * FROM produit WHERE id_produit =  :id_produit");
    $resultat->bindValue(':id_produit', $_GET['id_produit'], PDO::PARAM_STR);
    $resultat->execute();

    if($resultat->rowCount() <= 0) // si l'internaute tape dans l'URL un id_produit inconnu, on le redirige vers la page boutique pour ne pas avoir d'erreur 'undefined' sur la page profil;
    {
        header("location:boutique.php"); // redirection;
        exit(); // on stop l'execution du script;
    }

    $produit = $resultat->fetch(PDO::FETCH_ASSOC);


?>

<div class="col-md-6 col-md-offset-3">
    <div class="panel-default border">
        <div class="panel-heading text-center"><h2><?= $produit['titre'] ?></h2></div>
        <div class="panel-body">
        <img src="<?= URL . 'photo/' . $produit['photo'] ?>" alt="" class="img-responsive">
        <p class="text-center">Catégorie : <?= $produit['categorie'] ?></p>
        <p class="text-center">Couleur : <?= $produit['couleur'] ?></p>
        <p class="text-center">Taille : <?= $produit['taille'] ?></p>
        <p class="text-center">Description : <?= $produit['description'] ?></p>
        <p class="text-center">Prix : <?= $produit['prix'] ?></p>

        
        <?php if($produit['stock'] > 0): ?>

        <em>Nombre de produit(s) disponible(s) : <?=  $produit['stock'] ?></em>
        <form method= "post" action="panier.php">
            <input type="hidden" name="id_produit" value="<?=  $produit['id_produit'] ?>">
            <label for="quantite">Quantité :</label>
            <select class="form-control" name="quantite" id="quantite">
                <?php
                for($i = 1; $i <= $produit['stock'] && $i <= 5 ; $i++)
                {
                    echo "<option>$i</option>";
                }
                ?>
            
            </select><br>
            <input type="submit" name="ajout_panier" class="btn btn-primary col-xs-12" value="Ajout au panier">

        </form>

        <?php else: ?>

        <div class="alert alert-danger text-center">Rupture de stock !</div>

<?php endif; ?>

        </div>
    </div>
</div>




<?php
require_once("inc/footer.inc.php");
?>