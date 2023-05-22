<?php
ini_set("display_errors", 1); 

include '../mesFonctionsGenerales.php';

function SQL($sql)
{
    #Connexion à la base de données GSB_frais
    $cnxBDD = connexion();

    $result = $cnxBDD->query($sql)
        or die ("Requête invalide : " . $sql);
}
function SQLgetval($sql)
{
    $cnxBDD = connexion();

    $result = $cnxBDD->query($sql)
        or die ("Requete invalide : ".$sql);    
    $valeur = $result->fetch_array(2);
    return $valeur[0];
}
#Connexion à la base de données GSB_frais

$id=$_GET['id'];
$mois =$_GET['mois'];
$annee=$_GET['annee'];

$idFichefrais = SQLgetval("SELECT id FROM fichefrais WHERE idVisiteur='$id' AND mois='$mois' AND annee='$annee';");

#SUPPRESSION d'une ligne dans la table fichefrais
SQL("DELETE FROM lignefraisforfait WHERE idFicheFrais='$idFichefrais';");
SQL("DELETE FROM fichefrais WHERE idVisiteur='$id' AND mois='$mois' AND annee='$annee';");

?>

<html>
    <head>
        <title>Connexion au Formulaire de paiement</title>
        <meta charset='utf-8'>
        <link type='text/css' rel='stylesheet' href='../GF.css' />

    </head>    
    <body>  
        <fieldset>
            <h1 class='titre'>La fiche de frais à été supprimé avec succès</h1>
        </fieldset>
        <div class='alert' id='alert-box'>
        <div class='ball'></div>
        </div>
        <script src='../script.js'></script>
    </body>
</html>