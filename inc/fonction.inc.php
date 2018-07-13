<?php
function debug($var, $mode = 1)
{
    echo '<div style="background: orange; padding: 5px; ">';
    $trace = debug_backtrace(); // Fonction prédéfinie retournant un tableau ARRAY contenant des informations telles que la ligne et le fichier où est executé la fonction;
    // echo '<pre>'; print_r($trace); echo '</pre>';
    $trace = array_shift($trace); 
    // echo '<pre>'; print_r($trace); echo '</pre>';
    echo "Debug demandé dans le fichier : $trace[file] à la ligne $trace[line] . <hr>";
    if($mode === 1)
    {
        echo '<pre>'; print_r($var); echo '</pre>';
    }
    else
    {
        echo '<pre>'; var_dump($var); echo '</pre>';
    }
    echo '</div>';
}

// debug();

//_______________________________________________

function internauteEstConnecte() // fonction indiquant si le membre est connecté
{
    if(!isset($_SESSION['membre'])) // si l'indice membre dans le fichier session n'est pas défini, c'est que l'internaute n'est pas passé par la page connexion;
        {
            return false;
        }
    else
    {
        return true;
    }
    
}

//_______________________________________________

function internauteEstConnecteEtEstAdmin()
{
    if(internauteEstConnecte() && $_SESSION['membre']['statut'] == 1) // si la session du membre est définie et que son statut est à 1, cela veut dire qu'il est admin ; alors on retourne true;
    {
        return true;
    } 
    else
    {
        return false;
    }
}

//_____________PANIER___________________________
function creationDuPanier()
{
    if(!isset($_SESSION['panier'])) // si l'indice panier dans la session n'est pas défini, c'est que l'internaute n'a pas ajouté de produit dans le panier, donc créé le panier dans la session;
    {
        $_SESSION['panier'] = array();
        $_SESSION['panier']['titre'] = array(); // un tableau pour chaque indice, car on peut avoir plusieurs produits dans le panier;
        $_SESSION['panier']['id_produit'] = array();
        $_SESSION['panier']['quantite'] = array();
        $_SESSION['panier']['prix'] = array();
    }
}

//-------------------------------

function ajouterProduitPanier($titre, $id_produit, $quantite, $prix) // fonction utilisiateur recevant 4 arguments qui seront conservé dans la session panier
{
    creationDuPanier(); // on controle si le panier existe ou non dans la session

    $position_produit = array_search($id_produit, $_SESSION['panier']['id_produit']);
    
    if($position_produit !== false)
    {
        $_SESSION['panier']['quantite'][$position_produit] += $quantite;
    }
    else
    {

        $_SESSION['panier']['titre'][] = $titre;; 
        $_SESSION['panier']['id_produit'][] = $id_produit;
        $_SESSION['panier']['quantite'][] = $quantite;
        $_SESSION['panier']['prix'][] = $prix;
    }

}

//___________________________________________

function montantTotal()
{
    $total = 0;
    for($i = 0; $i < count($_SESSION['panier']['id_produit']);$i++)
    {
        $total += $_SESSION['panier']['quantite'][$i]*$_SESSION['panier']['prix'][$i]; // on calcule le montant total de tout les produits
    }
    return round($total,2);
}

//___________________________________________
function retirerProduitDuPanier($id_produit_a_supprimer)
{
    $position_produit = array_search($id_produit_a_supprimer, $_SESSION['panier']['id_produit']); // grace à la fonction search prédéfinie array_search(), on va chercher à quel indice se trouve le produit à supprimer dans la session panier;

    if($position_produit !== false) // si la variable $position_produit retourne une valeur différente de false, cela veut dire qu'un indice a bin été trouvé dans la session 'panier';
    {
        // la fonction array_splice() permet de supprimer une ligne dans le tableau session, et elle remonte les indices inférieur du tableau aux indices supérieurs du tableau, si je supprime un produit à l'indice 4, tous les produits après l'indice 4 vont remonter d'un indice;
        // cela permet de réorganiser le tableau panier dans la session et de ne pas avoir d'indice vide;
        array_splice($_SESSION['panier']['titre'], $position_produit, 1);
        array_splice($_SESSION['panier']['id_produit'], $position_produit, 1);
        array_splice($_SESSION['panier']['quantite'], $position_produit, 1);
        array_splice($_SESSION['panier']['prix'], $position_produit, 1);
    }
}





?>