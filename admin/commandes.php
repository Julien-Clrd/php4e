<?php
/*
 * Lister les commandes dans un tableau HTML :
 * * id de la commande
 * * nom prénom de l'utilisateur qui a passé la commande
 * * montant formaté
 * * date de la commande
 * * statut
 * * date du statut
 * Passer le statut en liste déroulante avec un bouton Modifier
 * pour changer le statut et sa date de la commande en bdd (nécessite un champ caché
 * pour l'id de la commande)
 */
require_once __DIR__ .  '/../include/init.php';
adminSecurity();

if (isset($_POST['modifierStatut'])) {
    $query = <<<SQL
UPDATE commande SET
     statut = :statut,
     date_statut = now()
WHERE id  = :id
SQL;
    $stmt = $pdo->prepare($query);
    $stmt->execute([
       ':statut' => $_POST['statut'],
       ':id' => $_POST['commandeId'] 
    ]);
    
    setFlashMessage('Le statut est modifié');
}

$query = 'SELECT c.*, concat_ws(" ",u.nom, u.prenom) AS utilisateur'
        . ' FROM commande c JOIN utilisateur u ON c.utilisateur_id = u.id;';
$stmt = $pdo->query($query);
$commandes = $stmt->fetchAll();

$statuts = [
    'en cours',
    'envoyé',
    'livré',
    'annulé'
];

require __DIR__ . '/../layout/top.php'; 
?>

<h1>Commandes</h1>

<table class="table table-dark">
    <thead>
        <tr>
            <th>ID</th>
            <th>Utilisateur</th>
            <th>Montant</th>
            <th>Date commande</th>
            <th>Statut</th>
            <th>Date MAJ statut</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($commandes as $commande) :
        ?>
        <tr>
            <td><?= $commande['id']; ?></td>
            <td><?= $commande['utilisateur'];?></td>
            <td><?= prixFr($commande['montant_total']); ?></td>
            <td><?= datetimeFr($commande['date_commande']); ?></td>
            <td><?= $commande['statut']; ?></td>
            <td><?= datetimeFr($commande['date_statut']); ?></td>  
            <td>
                <form method="post" class="form-inline">
                    <select name="statut" class="form-control">
                        <?php
                        foreach ($statuts as $statut) :
                            $selected = ($statut == $commande['statut'])
                                ? 'selected'
                                : ''
                            ;
                        ?>
                        <option value="<?= $statut; ?>" <?= $selected; ?>>
                            <?= $statut; ?>
                        </option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                    <input type="hidden"
                           name="commandeId"
                           value="<?= $commande['id']; ?>">
                    <button type="submit"
                            name="modifierStatut"
                            class="btn btn-primary">
                        Modifier
                    </button>
                </form>
            </td>
        </tr>
        <?php
        endforeach;
        ?>



<?php
require __DIR__ . '/../layout/bottom.php';
?>


