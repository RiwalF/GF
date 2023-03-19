<?php
ini_set("display_errors", 1); 

include '../mesFonctionsGenerales.php';
function SQL($sql){
    $cnxBDD = connexion();

    $result = $cnxBDD->query($sql)
        or die ("Requete invalide : ".$sql);    
}
function SQLget($sql){
    $cnxBDD = connexion();

    $result = $cnxBDD->query($sql)
        or die ("Requete invalide : ".$sql);    
    $valeur = $result->fetch_all(2);
    return $valeur;
}
function SQLgetval($sql){
    $cnxBDD = connexion();

    $result = $cnxBDD->query($sql)
        or die ("Requete invalide : ".$sql);    
    $valeur = $result->fetch_all(2);
    return $valeur[0];
}

$an = $_GET['an'];
$mois = $_GET['mois'];
$idvisit = $_GET['id'];

$idFicheFrais = SQLgetval("SELECT id FROM fichefrais WHERE mois = '$mois'AND annee = '$an' AND idVisiteur = '$idvisit'");
$Repas = SQLgetval("SELECT quantite FROM lignefraisforfait WHERE idFicheFrais = '$idFicheFrais[0]' AND idForfait = 'REP'");
$Nuit = SQLgetval("SELECT quantite FROM lignefraisforfait WHERE idFicheFrais = '$idFicheFrais[0]' AND idForfait = 'NUI'");
$Etape = SQLgetval("SELECT quantite FROM lignefraisforfait WHERE idFicheFrais = '$idFicheFrais[0]' AND idForfait = 'ETP'");
$Km = SQLgetval("SELECT quantite FROM lignefraisforfait WHERE idFicheFrais = '$idFicheFrais[0]' AND idForfait = 'KM'");
?>

<html>
    <head>
        <title>Suivi de remboursement des Frais</title>
        <meta charset="utf-8">
		<link type="text/css" rel="stylesheet" href="../GF4/GF4.css" />

    </head>    
    <body>  
        <form name="GF6.php" action="GF6.php" method="get">
            <fieldset class = "orange">
                <h1 class="titre2">Validation des Frais par visiteur</h1><br />
                
<pre><label for="choix" class="titre2" > Choisir le visiteur : </label><input style="width: 120px;" list="choix_visiteur" id="id" name="id" value="<?php echo $idvisit;?>"/><br />
<label for="mois_an" class="titre2" > Mois :                </label><input style="width: 55px;" list="mois" name="mois" value="<?php echo $mois;?>"/> <input style="width: 55px;" list="an" name="an" value="<?php echo $an;?>"/></pre>

            <h2 class="titre2">Frais au forfait</h2>

            <label><input type="submit" value="Rechercher"/></label></br></br>

            <table class="titre2" border="1px";>
                <tr>
                    <td align="center" width="90px"; height="30px">Repas midi</td>
                    <td align="center" width="90px"; height="30px">Nuitée</td>
                    <td align="center" width="90px"; height="30px">Etape</td>
                    <td align="center" width="90px"; height="30px">Km</td>
                    <td align="center" width="90px"; height="30px">Situation</td>
                </tr>
                <tr>
                    <td align="center" width="90px"; height="70px"><table class="titre2" border="1px";> <tr><td width="40px"; height="10px"><?php echo "$Repas[0]";?></td></tr> </table></td>
                    <td align="center" width="90px"; height="70px"><table class="titre2" border="1px";> <tr><td width="40px"; height="10px"><?php echo "$Nuit[0]";?></td></tr> </table></td>
                    <td align="center" width="90px"; height="70px"><table class="titre2" border="1px";> <tr><td width="40px"; height="10px"><?php echo "$Etape[0]";?></td></tr> </table></td>
                    <td align="center" width="90px"; height="70px"><table class="titre2" border="1px";> <tr><td width="40px"; height="10px"><?php echo "$Km[0]";?></td></tr> </table></td>
                    <td align="center" width="170px"; height="70px">
                        <input type="radio" value="Valide" name="choix" id = "Valide"></input><label class="boutton" for="Valide">Valide</label>
                        <input type="radio" value="Non Valide" name="choix" id = "Non Valide"></input><label class="boutton" for="Non Valide">Non Valide</label>
                </tr>
            </table>

            </fieldset class = "orange">

            <datalist id = "choix_visiteur">

                <?php 
                
                $tab_id = SQLget("SELECT DISTINCT visiteur.id,mois,annee FROM visiteur,fichefrais WHERE fichefrais.idVisiteur=visiteur.id AND idEtat='CL';");
                for ($i=0; $i < count($tab_id); $i++) { 
                    echo "<option value='".$tab_id[$i][0]."'><br />\n";
                }

                ?>
    
            </datalist>

            <datalist id = "mois">
                <?php 
                for ($i=0; $i < count($tab_id); $i++) { 
                    echo "<option value='".$tab_id[$i][1]."'><br />\n";
                }
                ?>
            </datalist>

            <datalist id = "an">
                <?php
                for ($i=0; $i < count($tab_id); $i++) { 
                    echo "<option value='".$tab_id[$i][2]."'><br />\n";
                }
                ?>
            </datalist>
        </form>    
    </body>
</html>

<?php

$choix = $_GET['choix'];

if ($choix == 'Valide') {
    SQL("UPDATE fichefrais SET idEtat = 'VA' WHERE id = '$idFicheFrais[0]';");
} elseif ($choix == 'Non Valide') {
    SQL("UPDATE fichefrais SET idEtat = 'CR' WHERE id = '$idFicheFrais[0]';");
}
?>

