<?php
ini_set("display_errors", 1); 

include '../mesFonctionsGenerales.php';
$cnxBDD = connexion();

$idVisiteur = $_GET["id"];

function SQLget($sql){
    $cnxBDD = connexion();

    $result = $cnxBDD->query($sql)
        or die ("Requete invalide : ".$sql);    
    $valeur = $result->fetch_array();
    return $valeur[0];
}

function SQLgetTAB($sql){
    $cnxBDD = connexion();

    $result = $cnxBDD->query($sql)
        or die ("Requete invalide : ".$sql);    
    $valeur = $result->fetch_array();
    return $valeur;
}

function SQL($sql){
    $cnxBDD = connexion();

    $result = $cnxBDD->query($sql)
    or die ("Requete invalide : ".$sql);
}



$Mois = $_GET["mois"];
$Annee = $_GET["Annee"];
$Repas = $_GET["Repas"];
$Nuit = $_GET["Nuit"];
$Etape = $_GET["Etape"];
$Km = $_GET["Km"];

$nbJustificatifs = 0;

if ($Repas <= 0){
    $Repas = 0;
}else{
    $nbJustificatifs += 1;
}
if ($Nuit <= 0){
    $Nuit = 0;
}else{
    $nbJustificatifs += 1;
}
if ($Etape <= 0){
    $Etape = 0;
}else{
    $nbJustificatifs += 1;
}
if ($Km <= 0){
    $Km = 0;
}else{
    $nbJustificatifs += 1;
}

$prix_repas = SQLget("SELECT montant FROM forfait WHERE id = 'REP'");
$Repas_total = $Repas * $prix_repas;

$prix_nuit = SQLget("SELECT montant FROM forfait WHERE id = 'NUI'");
$Nuit_total = $Nuit * $prix_nuit;

$prix_etape = SQLget("SELECT montant FROM forfait WHERE id = 'ETP'");
$Etape_total = $Etape * $prix_etape;

$prix_km = SQLget("SELECT montant FROM forfait WHERE id = 'KM'");
$Km_total = $Km * $prix_km;

$Total = $Repas_total+$Nuit_total+$Etape_total+$Km_total;

$date = date("y-m-j");
$idEtat = "CR";
$Annee -= 2000;

$verif = SQLgetTAB("SELECT * FROM fichefrais WHERE idVisiteur = '$idVisiteur' AND mois = '$Mois' AND annee = $Annee");
$requete = "";

if (gettype($verif) != "array"){
    SQL("INSERT INTO fichefrais(idVisiteur,mois,annee,nbJustificatifs,montantValide,dateModif,idEtat) VALUES ('$idVisiteur','$Mois','$Annee','$nbJustificatifs','$Total','$date','$idEtat');");

    $id = SQLget("SELECT MAX(id) FROM fichefrais");

    SQL("INSERT INTO lignefraisforfait(idFicheFrais, idForfait, quantite) VALUES ('$id','ETP','$Etape');");
    SQL("INSERT INTO lignefraisforfait(idFicheFrais, idForfait, quantite) VALUES ('$id','NUI','$Nuit');");
    SQL("INSERT INTO lignefraisforfait(idFicheFrais, idForfait, quantite) VALUES ('$id','REP','$Repas');");
    SQL("INSERT INTO lignefraisforfait(idFicheFrais, idForfait, quantite) VALUES ('$id','KM','$Km');");
}else{
    $requete = "ERROR impossible d'exécuter votre demande";
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>formulaire de paiement</title>
        <meta charset='utf-8'>
		<link type='text/css' rel='stylesheet' href='GF4.css' />

    </head>    
    <body>
        <form name="GF4" action="../GF3/GF3.php" method="get">
            <table>
                <tr>
                    <th><h1 class='titre'>Gestion des Frais</h1></th>
                    <th style='margin: 300px;'><img src='GSB.jpg'></th>
                </tr>
            </table>
            <fieldset>
                <h1 class='titre2'>Fiche Frais</h1><BR>
                <h3 class='hp'>Repas : <?php echo $Repas_total; ?> €</h3>
                <h3 class='hp'>Nuitées : <?php echo $Nuit_total; ?> €</h3>
                <h3 class='hp'>Etape : <?php echo $Etape_total; ?> €</h3>
                <h3 class='hp'>Km : <?php echo $Km_total; ?> €</h3>
                <h2 class='hp'>Total : <?php echo "$Total € en $Mois/$Annee" ?></h2>
                <h2 class='hp'><?php echo $requete; ?><h2>
                <div>
				    <input id="Valider" type="submit" value="Revenir à la gestion des fiches de frais" />
			    </div>
            </fieldset>
            <input id="id" name="id" type="hidden" value="<?php echo $idVisiteur; ?>">
        </form>
    </body>
</html>