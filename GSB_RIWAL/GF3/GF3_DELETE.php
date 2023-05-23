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

function SQLget($sql){
    $cnxBDD = connexion();

    $result = $cnxBDD->query($sql)
        or die ("Requete invalide : ".$sql);    
    $valeur = $result->fetch_array();
    return $valeur[0];
}

$id=$_GET['id'];
$mois =$_GET['mois'];
$annee=$_GET['annee'];

$idFichefrais = SQLgetval("SELECT id FROM fichefrais WHERE idVisiteur='$id' AND mois='$mois' AND annee='$annee';");

// Controle // Suppression des kilomètre ajouté au véhicule grâce à cette fiche de frais
// Controle // Récupération des kms du vehicule ainsi que des kms enregistrées 
$KmVehicule = SQLgetval("SELECT kilometrage FROM `vehicule` WHERE idVisiteur = '".$id."';");
$KmEnregistres = SQLget("SELECT quantite FROM `lignefraisforfait` WHERE idFicheFrais = '".$idFichefrais."' AND idForfait = 'KM';");

// Controle // Soustraction de l'un vers l'autre
$KmUpdate = $KmVehicule - $KmEnregistres;

// Controle // Update du kilométrage du véhicule
SQL("UPDATE `vehicule` SET `kilometrage`='".$KmUpdate."' WHERE idVisiteur = '".$id."';");


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
            <input type="button" name="lien0" value="Retour en arriere" onclick="self.location.href='../GF3/GF3.php<?php echo '?id='.$id;?>'" style="background-color:#658db3" style="color:white; font-weight:bold"onclick>
            <br/>
            <h1 class='titre'>La fiche de frais à été supprimé avec succès</h1>
        </fieldset>
        <div class='alert' id='alert-box'>
        <div class='ball'></div>
        </div>
        <script src='../script.js'></script>
    </body>
</html>