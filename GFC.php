<?php
ini_set("display_errors", 1); 
include 'mesFonctionsGenerales.php';

function SQLget($sql){
    $cnxBDD = connexion();

    $result = $cnxBDD->query($sql)
        or die ("Requete invalide : ".$sql);    
    $valeur = $result->fetch_array();
    return $valeur;
}

$ExisteFicheFrais = TRUE;
$tab_id = SQLget("SELECT DISTINCT visiteur.id,annee,mois FROM visiteur,fichefrais WHERE fichefrais.idVisiteur=visiteur.id AND idEtat='CL';");
if (existe($id = $tab_id[0];)) {
    $id = $tab_id[0];
    $annee = $tab_id[1];
    $mois = $tab_id[2];   
}   


?>

<html>
    <head>
        <title>Connexion au Formulaire de paiement</title>
        <meta charset="utf-8">
		<link type="text/css" rel="stylesheet" href="GF4/GF4.css" />

    </head>    
    <body>  
        <form action="GF6/GF6.php" method="get">  
            <table>
                <tr>
                    <th><h1 class="titre">Redirection</h1></th>
                    <th><img src="GF4/GSB.jpg"></th>
                </tr>
            </table>

            <fieldset>
                <label class="titre2">Validation des Frais <input type="submit"/></label></br></br>
                <a href="GF7/GF7.php"><label class="PAIEMENT">Mettre en paiement</label>
            </fieldset>
            <input id="mois" name="mois" type="hidden" value="<?php echo $mois; ?>">
            <input id="an" name="an" type="hidden" value="<?php echo $annee; ?>">
            <input id="id" name="id" type="hidden" value="<?php echo $id; ?>">
        </form>
    </body>
</html>