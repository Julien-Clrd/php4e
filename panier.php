<?php
/*
 * si le panier est vide : afficher un message
 * sinon afficher un tableau HTML avec pour chaque produit du panier :
 * - nom du produit
 * - prix unitaire
 * - quantite
 * - prix total pour le produit
 * Faire une fonction qui calcule le montant total du panier
 * et l'utiliser sous le tableau pour afficher le total
 * 
 * - Remplacer l'affichage de la quantité par un formulaire avec :
 * * un <input type="number"> pour la quantité
 * * un <input type="hidden"> pour avoir l'id du produit
 * dont on va modifier la quantité
 * * un bouton submit
 * - Faire une fonction modifierQuantitePanier($produitId, $quantite)
 * Qui met à jour la quantité pour le produit si la quantité n'est pas 0,
 * et qui le supprime du panier sinon
 * Appeler cette fonction quand un des formulaires est envoyé
 */

require_once __DIR__ .  '/include/init.php';

//dump($_SESSION['panier']);

if (isset($_POST['commander'])) {
    $query = <<<SQL
INSERT INTO commande(
       utilisateur_id,
       montant_total
    ) VALUES (
       :utilisateur_id,
       :montant_total
    )
SQL;
    
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        ':utilisateur_id' => $_SESSION['utilisateur']['id'],
        ':montant_total' => totalPanier()
    ]);
    // récupération de l'id de la commande que l'on vient d'insérer
    $commandeId = $pdo->lastInsertId();
    
    $query = <<<SQL
INSERT INTO detail_commande(
        commande_id,
        produit_id,
        prix,
        quantite
) VALUES (
        :commande_id,
        :produit_id,
        :prix,
        :quantite            
)
SQL;
    
    $stmt = $pdo->prepare($query);
    
    foreach ($_SESSION['panier'] as $produitId => $produit) {
        $stmt->execute([
           ':commande_id' => $commandeId,
           ':produit_id' => $produitId,
           ':prix' => $produit['prix'],
           ':quantite' => $produit['quantite']
        ]);
        
        // on vide le panier
        $_SESSION['panier'] = [];
        setFlashMessage('La commande est enregistrée');
    }
}

if (isset($_POST['modifierQuantite'])) {
    modifierQuantitePanier($_POST['produitId'], $_POST['quantite']);
}



require __DIR__ . '/layout/top.php'; 
?>

<h1>Panier</h1>

<?php
if (empty($_SESSION['panier'])) :
?>
    <div class="alert alert-info">
        Le panier est vide
    </div>
<?php
else :
?>

 <table class="table table-dark">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prix</th>
            <th>Quantité</th>
            <th>Prix total</th>
            <th width="250px"></th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($_SESSION['panier'] as $produitId => $produit) :
            $prixTotal = prixFr($produit['prix'] * $produit['quantite']);
        ?>   
        <tr>
            <td><?= $produit['nom']; ?></td>
            <td><?= prixFr($produit['prix']); ?></td>
            <td>
                <form method="post" class="form-inline">
                    <input type="number" name="quantite" value="
                <?= $produit['quantite']; ?>" class="form-control col-sm-2" min="0">
                    <input type="hidden" name="produitId" value="
                <?= $produitId; ?>">
                    <button type="submit" class="btn btn-info" name="modifierQuantite">
                        Mettre à jour la qté
                    </button>
                    
                </form>
                
            </td>      
            <td><?= $prixTotal; ?></td>       
        </tr>
       <?php
       endforeach;
       ?>
        <tr>
            <th colspan="3">Total</th>
            <td><?= prixFr(totalPanier()); ?></td>
        </tr>
    </tbody>
</table>




<?php
    if (!isUserConnected()) :
?>
<div class="alert alert-info">
    Vous devez vous connecter ou vous inscrire pour valider la commande
</div>
<?php
else:
?>
    <form method="post">
        <p class="text-right">
            <button type="submit" name="commander" class="btn btn-info">
                Valider la commande
            </button>
        </p>
            
    </form>

<?php
endif;
?>

<?php
endif;



require __DIR__ . '/layout/bottom.php';
?>

