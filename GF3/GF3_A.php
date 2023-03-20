<?php
ini_set("display_errors", 1); 
include '../mesFonctionsGenerales.php';

function SQL($sql)
{
    $cnxBDD = connexion();

    $result = $cnxBDD->query($sql)
        or die ("Requete invalide : ".$sql);
}
function SQLget($sql)
{
    $cnxBDD = connexion();

    $result = $cnxBDD->query($sql)
        or die ("Requete invalide : ".$sql);    
    $valeur = $result->fetch_array(2);
    return $valeur;
}
function SQLgetval($sql)
{
    $cnxBDD = connexion();

    $result = $cnxBDD->query($sql)
        or die ("Requete invalide : ".$sql);    
    $valeur = $result->fetch_array(2);
    return $valeur[0];
}
function SQLobject($sql)
{
    $cnxBDD = connexion();

    $result = $cnxBDD->query($sql)
        or die ("Requete invalide : ".$sql);    
    $valeur = $result->fetch_all();
    return $valeur;
}

$id = $_GET['id'];

$nom_prenom_visiteur = SQLget("SELECT nom,prenom FROM visiteur WHERE id = '$id';");

$montant = SQLget("SELECT fichefrais.id FROM fichefrais WHERE idVisiteur IN (SELECT id FROM visiteur WHERE nom='$nom_prenom_visiteur[0]' AND prenom='$nom_prenom_visiteur[1]')");

?>

<html>
    <head lang=fr>
        <title>Fiche Frais</title>
        <meta charset="utf-8">
        <link type="text/css" rel="stylesheet" href="GF3_A.css"/>
    </head>

    <body>
        <table>
            <tr>
                <th><strong>Fiche de frais de : <?php echo $nom_prenom_visiteur[0]; ?></strong></th>
                <th></th>
                <th><strong>Ajouter</strong></th>
                <th><a href="../GF4/GF4_A.php?id=<?php echo $id?>"><img class="pictureCenter" src="https://annuaire-opticien.essilor.fr/media/Picto_plus.png"></a></th>
            </tr>
        </table>
    </body>
</html>