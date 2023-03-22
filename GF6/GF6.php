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

$idFicheFraisSelec = $_GET['idFicheFrais'];

$tab_id = SQLget("SELECT DISTINCT visiteur.id,annee,mois FROM visiteur,fichefrais WHERE fichefrais.idVisiteur=visiteur.id AND idEtat='CL';");

?>

<html>
    <head>
        <title>Suivi de remboursement des Frais</title>
        <meta charset="utf-8">
		<link type="text/css" rel="stylesheet" href="../GF4/GF4.css" />

    </head>    
    <body>
        <form name="GF6.php" action="GF6.php" method="get">
            <fieldset class="orange">
                <h1 class="titre2">Validation des Frais par visiteur</h1>
                <br />
                    <label for="ficheFraisList">Choisir la fiche de frais :</label>
                    <select id="ficheFraisList" name="idFicheFrais">
                        <option selected disabled></option>
                        <?php
                            for ($i = 0; $i < count($tab_id); $i++) {
                            $idFicheFrais = SQLgetval("SELECT id FROM fichefrais WHERE mois = '".$tab_id[$i][2]."'AND annee = '".$tab_id[$i][1]."' AND idVisiteur = '".$tab_id[$i][0]."'");
                            echo '<option value="' . $idFicheFrais[0] . '">' . $tab_id[$i][0] . ' - ' . $tab_id[$i][2] . '/' . $tab_id[$i][1] . '</option>';
                            }
                        ?>
                    </select>
                    <br/>
                    <h2 class="titre2">Frais au forfait</h2>
                    <br />
                <input type="submit" name="submit" value="Valider" />





            <?php
            if ($idFicheFraisSelec != NULL) {
                $Repas = SQLgetval("SELECT quantite FROM lignefraisforfait WHERE idFicheFrais = '$idFicheFraisSelec' AND idForfait = 'REP'");
                $Nuit = SQLgetval("SELECT quantite FROM lignefraisforfait WHERE idFicheFrais = '$idFicheFraisSelec' AND idForfait = 'NUI'");
                $Etape = SQLgetval("SELECT quantite FROM lignefraisforfait WHERE idFicheFrais = '$idFicheFraisSelec' AND idForfait = 'ETP'");
                $Km = SQLgetval("SELECT quantite FROM lignefraisforfait WHERE idFicheFrais = '$idFicheFraisSelec' AND idForfait = 'KM'");
                $ExisteFichefrais = TRUE;
            }
            ?>
            <table class="titre2" border="1px";>
                <tr>
                    <td align="center" width="90px"; height="30px">Repas midi</td>
                    <td align="center" width="90px"; height="30px">Nuitée</td>
                    <td align="center" width="90px"; height="30px">Etape</td>
                    <td align="center" width="90px"; height="30px">Km</td>
                    <td align="center" width="90px"; height="30px">Situation</td>
                </tr>
                <tr>
                    <td align="center" width="90px"; height="70px"><table class="titre2" border="1px";> <tr><td width="40px"; height="10px"><?php if ($ExisteFichefrais){echo "$Repas[0]";}else{echo "Pas de valeur";}?></td></tr> </table></td>
                    <td align="center" width="90px"; height="70px"><table class="titre2" border="1px";> <tr><td width="40px"; height="10px"><?php if ($ExisteFichefrais){echo "$Nuit[0]";}else{echo "Pas de valeur";}?></td></tr> </table></td>
                    <td align="center" width="90px"; height="70px"><table class="titre2" border="1px";> <tr><td width="40px"; height="10px"><?php if ($ExisteFichefrais){echo "$Etape[0]";}else{echo "Pas de valeur";}?></td></tr> </table></td>
                    <td align="center" width="90px"; height="70px"><table class="titre2" border="1px";> <tr><td width="40px"; height="10px"><?php if ($ExisteFichefrais){echo "$Km[0]";}else{echo "Pas de valeur";}?></td></tr> </table></td>
                    <td align="center" width="170px"; height="70px">
                        <input type="radio" value="Valide" name="choix" id = "Valide"></input><label class="boutton" for="Valide">Valide</label>
                        <input type="radio" value="NonValide" name="choix" id = "NonValide"></input><label class="boutton" for="NonValide">Non Valide</label>
                </tr>
            </table>

            </fieldset class = "orange">
        </form>    
    </body>
</html>

<?php

$choix = $_GET['choix'];

if ($choix == 'Valide') {
    SQL("UPDATE fichefrais SET idEtat = 'VA' WHERE id = '$idFicheFrais[0]';");
} elseif ($choix == 'NonValide') {
    SQL("UPDATE fichefrais SET idEtat = 'CR' WHERE id = '$idFicheFrais[0]';");
}
?>

