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
$Repas = SQLgetval("SELECT quantite FROM lignefraisforfait WHERE idForfait = 'REP' AND idFicheFrais = '$idFichefrais'");
$Km = SQLgetval("SELECT quantite FROM lignefraisforfait WHERE idForfait = 'KM' AND idFicheFrais = '$idFichefrais'");
$Etape = SQLgetval("SELECT quantite FROM lignefraisforfait WHERE idForfait = 'ETP' AND idFicheFrais = '$idFichefrais'");
$Nuit = SQLgetval("SELECT quantite FROM lignefraisforfait WHERE idForfait = 'NUI' AND idFicheFrais = '$idFichefrais'");

#SUPPRESSION d'une ligne dans la table fichefrais
SQL("DELETE FROM lignefraisforfait WHERE idFicheFrais='$idFichefrais';");
SQL("DELETE FROM fichefrais WHERE idVisiteur='$id' AND mois='$mois' AND annee='$annee';");

?>

<!DOCTYPE html>

<html style = "background-color: rgb(101, 141, 179)">

    <head lang=fr>

        <meta charset="utf-8">
		<link type="text/css" rel="stylesheet" href="../GF4/GF4.css" />
        <title>Action réalisée avec succès</title>

    </head>

    <body>

        <p style = "text-align: center ; text-align: middle ; font-size: 50px ; font-family: Calibri ; color: white ;"><br><br><br><strong>La suppression de votre ligne de frais a bien été effectuer</br>
        Cette fiche de frais contenait : </strong></p>

        <form name="GF4" action="../GF3/GF3.php" method="get">

            <input id="id" name="id" type="hidden" value="<?php echo $id; ?>">

            <h3 class='hp'>Repas : <?php echo $Repas; ?></h3>
            <h3 class='hp'>Nuitées : <?php echo $Nuit ?></h3>
            <h3 class='hp'>Etape : <?php echo $Etape ?></h3>
            <h3 class='hp'>Km : <?php echo $Km ?></h3>
            <h2 class='hp'><?php echo "$mois/$annee" ?></h2>

            <div>

                <input id="Valider" type="submit" value="Revenir à la gestion des fiches de frais" />

            </div>

        </form>
        <div class="alert" id="alert-box">
            <div class="ball"></div>
        </div>
        <script src="../script.js"></script>

    </body>

</html>