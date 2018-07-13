<?php
require_once __DIR__ .  '/../include/init.php';
adminSecurity();

require __DIR__ . '/../layout/top.php'; 
// lister les catégories dans un tableau HTML


// le requêtage içi
$stmt = $pdo->query('SELECT * FROM categorie');
$categories = $stmt->fetchAll();
// var_dump($categories);
?>
<h1>Gestion de Catégories</h1>

<p><a href="categorie-edit.php">Ajouter une catégorie</a></p>

 <!-- Le tableau HTML içi  -->

 

 <table class="table table-dark">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th width="250px"></th>
        </tr>
    </thead>
    <tbody>
        <?php
        
        foreach ($categories as $categorie) :
        ?>
        <?php
        // Alternative :
        // foreach ($categories as $categorie) {
        //     echo '<tr><td>' . $categorie['id'] . '</td><td>' . $categorie['nom'] . '</td><td><a class="btn btn-primary" href="categorie-edit.php?id=' . $categorie['id'] . '"></a></td></tr>';
        // }
        ?> 
            <tr>
                <td><?= $categorie['id']; ?></td>
                <td><?= $categorie['nom']; ?></td>
                <td>
                    <a class="btn btn-primary"
                       href="categorie-edit.php?id=<?= $categorie['id']; ?>">
                        Modifier
                    </a>
                     <a class="btn btn-danger"
                        href="categorie-delete.php?id=<?= $categorie['id']; ?>">
                        Supprimer
                    </a>
                </td>
            </tr>

        <?php 
        endforeach;
        ?>
    </tbody>
</table>
 
 
 
 
<?php
require __DIR__ . '/../layout/bottom.php';
?>


