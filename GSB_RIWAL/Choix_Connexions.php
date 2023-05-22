<?php
ini_set("display_errors", 1); 
include 'mesFonctionsGenerales.php';

$id = $_GET["id"];
$mdp = $_GET["mdp"];

function SQL($sql)
{
    $cnxBDD = connexion();

    $result = $cnxBDD->query($sql)
        or die ("Requete invalide : ".$sql);
}
function SQLget($sql){
    $cnxBDD = connexion();
    $result = $cnxBDD->query($sql)
        or die ("Requete invalide : ".$sql);    
    $valeur = $result->fetch_array();
    return $valeur;
}
function SQLobject($sql)
{
    $cnxBDD = connexion();

    $result = $cnxBDD->query($sql)
        or die ("Requete invalide : ".$sql);    
    $valeur = $result->fetch_all();
    return $valeur;
}

$annee_du_jour = date("Y")-2000;
$mois_du_jour = date("m");
$fiche_cloture = SQLobject("SELECT `id`, `idEtat`, `mois`, `annee` FROM `fichefrais` WHERE idEtat = 'CR';");
foreach ($fiche_cloture as $key => $fiche) {
    if ($fiche[3] < $annee_du_jour) {
        SQL("UPDATE `fichefrais`
            SET `idEtat` = 'CL'
            WHERE `id` = ".$fiche[0].";");
    }elseif ($fiche[3] == $annee_du_jour) {
        if ($fiche[2] < $mois_du_jour) {
            SQL("UPDATE `fichefrais`
            SET `idEtat` = 'CL'
            WHERE `id` = '".$fiche[0]."';");
        }
    }
}


$statut_C = SQLget("SELECT * FROM `comptable` WHERE `Comptable_id` = '$id' AND `MDP` = '$mdp';");
$statut_V = SQLget("SELECT * FROM `visiteur` WHERE `id` = '$id' AND `MDP` = '$mdp';");

if (gettype($statut_C) == "array" ){
    header('Location: GFC.php');
}elseif (gettype($statut_V) == "array" ) {
    header('Location: GF3/GF3.php?id='.$id);
    exit();
}else{
    echo "<html>
            <head>
                <title>Connexion au Formulaire de paiement</title>
                <meta charset='utf-8'>
                <link type='text/css' rel='stylesheet' href='GF.css' />

            </head>    
            <body>  
                <fieldset>
                    <h1 class='titre'>Erreur de connexion veuillez réessayer</h1>
                </fieldset>
                <div class='alert' id='alert-box'>
                <div class='ball'></div>
                </div>
                <script src='../script.js'></script>
            </body>
          </html>";
}


?>