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
        <title>Formulaire de paiement</title>
        <meta charset="utf-8">
        <link type="text/css" rel="stylesheet" href="GF.css"/>
    </head>    
    <body>
        <form name="GF4" action="../GF3/GF3.php" method="get">
            <fieldset class="orange">
                <h1 class='titre2'>Gestion des Frais</h1>
                <h3>Repas : <?php echo $Repas_total; ?> €</h3>
                <h3>Nuitées : <?php echo $Nuit_total; ?> €</h3>
                <h3>Etape : <?php echo $Etape_total; ?> €</h3>
                <h3>Km : <?php echo $Km_total; ?> €</h3>
                <h2>Total : <?php echo $Total." € en ".$Mois."/".$Annee; ?></h2>
                <h2><?php echo $requete; ?><h2>
                <div>
				    <input id="Valider" type="submit" value="Revenir à la gestion des fiches de frais" />
			    </div>
            </fieldset>
            <div class="alert" id="alert-box">
                <div class="ball"></div>
            </div>
            <script src="../script.js"></script>
            <input id="id" name="id" type="hidden" value="<?php echo $idVisiteur; ?>">
        </form>
        
        
        
        
    </body>
</html>