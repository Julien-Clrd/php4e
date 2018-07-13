<?php
require_once("inc/init.inc.php");
require_once("inc/header.inc.php");
?>

<div class="row row-offcanvas row-offcanvas-right">

<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
    <div class="list-group">
        <p class="list-group-item active text-center">Catégories</p>
        <?php

        // EXERCICE : faites en sort d'afficher les catégories distinctes de la table produit à l'aide d'une boucle;

        

        $resultat = $pdo->query("SELECT DISTINCT categorie FROM produit");
        while($categorie = $resultat->fetch(PDO::FETCH_ASSOC))
        {
            echo '<a href="?categorie='. $categorie['categorie'] .'" class="list-group-item">'. $categorie['categorie'] .'</a>';  
        }


        ?>

    </div>
</div><!--/.sidebar-offcanvas-->

        <div class="col-xs-12 col-sm-9">
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
          <div class="jumbotron">
            <h1>Welcome !</h1>
            <p>You can find wathever you want in here !</p>
          </div>

        <?php 
        if(isset($_GET['categorie'])): 
            $donnees = $pdo->prepare("SELECT * FROM produit WHERE categorie = :categorie");
            $donnees->bindValue(':categorie', $_GET['categorie'], PDO::PARAM_INT);
            $donnees->execute();

            while($produit = $donnees->fetch(PDO::FETCH_ASSOC)):
        
        ?>


          <!--<div class="row"> -->
        <div class="col-xs-6 col-lg-4">
            <div class="panel-default border">

              <div class="panel-heading text-center"><h2><?= $produit['titre'] ?></h2></div>
              <p><a href="fiche_produit.php?id_produit=<?= $produit['id_produit'] ?>"><img src="<?= URL . 'photo/' . $produit['photo'] ?>" alt="" class="img-responsive"></a></p>
              <p class="text-center"><?= $produit['prix'] ?>€</p>
              <p class="text-center"><a class="btn btn-primary" href="fiche_produit.php?id_produit=<?= $produit['id_produit'] ?>" role="button">Voir le détail &raquo;</a></p>
            </div>
        </div><!--/.col-xs-6.col-lg-4-->
            
            <!-- </div><!-->
          <!-- /row-->


<?php
    endwhile;
endif;

?>


        </div><!--/.col-xs-12.col-sm-9-->

      </div><!--/row-->

<?php
require_once("inc/footer.inc.php");
?>







