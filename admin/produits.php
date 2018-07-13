<?php
// faire la page qui liste les produits dans un tableau HTML
// tous les champs sauf la description
// bonus:
// afficher le nom de la catégorie du produit au lieu de son id

require_once __DIR__ .  '/../include/init.php';
adminSecurity();

require __DIR__ . '/../layout/top.php'; 

// le requêtage içi
$stmt = $pdo->query(
        'SELECT p.id, p.nom, p.reference, p.prix, c.nom AS categorie FROM produit p
        JOIN categorie c ON p.categorie_id = c.id ORDER BY p.id'          
        );
$produits = $stmt->fetchAll();


?>

<h1>Gestion des Produits</h1>

<p><a href="produit-edit.php">Ajouter un produit</a></p>
<!-- lister les catégories dans un tableau HTML -->

<table class="table table-dark">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Reference</th>
            <th>Prix</th>
            <th>Categorie</th>
        </tr>
    </thead>
    <tbody>
        
        
        <?php
        foreach ($produits as $produit) :
        ?>
        <?php
        ?> 
            <tr>
                <td><?= $produit['id']; ?></td>
                <td><?= $produit['nom']; ?></td>
                <td><?= $produit['reference']; ?></td>
                <td><?= prixFr($produit['prix']); ?></td>
                <td><?= $produit['categorie']; ?></td>
                <td>
                    <a class="btn btn-primary"
                       href="produit-edit.php?id=<?= $produit['id']; ?>">
                        Modifier
                    </a>
                     <a class="btn btn-danger"
                        href="produit-delete.php?id=<?= $produit['id']; ?>">
                        Supprimer
                    </a>
                </td>
            </tr>

        <?php 
        endforeach;
        ?>
    </tbody>
</table>