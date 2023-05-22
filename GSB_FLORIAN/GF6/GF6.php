<?php
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

$idFicheFraisSelec = 0;
if ($_GET['submit'] == "Rechercher") {
    $idFicheFraisSelec = $_GET['idFicheFrais'];
}


$ExisteFichefrais = FALSE;
$tab_id = SQLget("SELECT DISTINCT visiteur.id,annee,mois FROM visiteur,fichefrais WHERE fichefrais.idVisiteur=visiteur.id AND idEtat='CL';");

?>

<html>
    <head>
        <title>Suivi de remboursement des Frais</title>
        <meta charset="utf-8">
		<link type="text/css" rel="stylesheet" href="../GF.css" />

    </head>    
    <body>
        <form name="GF6.php" action="GF6.php" method="get">
            <fieldset class="orange">
                <h1 class="titre2">Validation des Frais des visiteur</h1>
                    <br/>
                    <input class="back-button" type="button" name="lien0" value="Retour en arriere" onclick="self.location.href='../GFC.php'" style="background-color:#658db3" style="color:white; font-weight:bold"onclick>
                    <br/>
                <br />
                    <select id="ficheFraisList" name="idFicheFrais">
                        <option selected disabled>Choisir la fiche de frais :</option>
                        <?php
                            for ($i = 0; $i < count($tab_id); $i++) {
                            $idFicheFrais = SQLgetval("SELECT id FROM fichefrais WHERE mois = '".$tab_id[$i][2]."'AND annee = '".$tab_id[$i][1]."' AND idVisiteur = '".$tab_id[$i][0]."'");
                            echo '<option value="' . $idFicheFrais[0] . '">' . $tab_id[$i][0] . ' - ' . $tab_id[$i][2] . '/' . $tab_id[$i][1] . '</option>';
                            }
                        ?>
                    </select>
                    <br />
                <input type="submit" name="submit" value="Rechercher"/> <br/><br/><br/>

            <?php
            if ($idFicheFraisSelec != 0) {
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
            <input type="submit" name="submit" value="Soumettre"/>

            </fieldset class = "orange">
        </form> 
        <div class="alert" id="alert-box">
            <div class="ball"></div>
        </div>
        <script src="../script.js"></script>   
    </body>
</html>

<?php
$choix = "";
if ($_GET['submit'] == 'Valider') {
    $choix = $_GET['choix'];
} 


if ($choix == 'Valide') {
    SQL("UPDATE fichefrais SET idEtat = 'VA' WHERE id = '$idFicheFrais[0]';");
} elseif ($choix == 'NonValide') {
    SQL("UPDATE fichefrais SET idEtat = 'NV' WHERE id = '$idFicheFrais[0]';");
}
?>

