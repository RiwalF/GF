<?php
ini_set("display_errors", 1); 

include '../mesFonctionsGenerales.php';

$id = $_GET["id"];
$mois = $_GET["mois"];
$annee = $_GET["annee"];

function SQLget($sql){
    $cnxBDD = connexion();

    $result = $cnxBDD->query($sql)
        or die ("Requete invalide : ".$sql);    
    $valeur = $result->fetch_array(2);
    return $valeur;
}

$tab = SQLget("SELECT * FROM fichefrais WHERE mois = '$mois' AND annee = '$annee' AND idVisiteur = '$id';");
$ID_ETAT = SQLget("SELECT libelle FROM etat WHERE id = '$tab[7]';");
$ETP = SQLget("SELECT quantite FROM lignefraisforfait WHERE idFicheFrais = '$tab[0]' AND idForfait = 'ETP'")[0];
$NUI = SQLget("SELECT quantite FROM lignefraisforfait WHERE idFicheFrais = '$tab[0]' AND idForfait = 'NUI'")[0];
$REP = SQLget("SELECT quantite FROM lignefraisforfait WHERE idFicheFrais = '$tab[0]' AND idForfait = 'REP'")[0];
$KM = SQLget("SELECT quantite FROM lignefraisforfait WHERE idFicheFrais = '$tab[0]' AND idForfait = 'KM'")[0];
$nom_prenom = SQLget("SELECT nom,prenom FROM visiteur WHERE id = '$id';");

?>

<html>
    <head>
        <title>Suivi de remboursement des Frais</title>
        <meta charset="utf-8">
		<link type="text/css" rel="stylesheet" href="../GF.css" />

    </head>    
    <body>  
        <form name="GF4" action="../GF3/GF3.php" method="get">

        <h1 class="titre2">Suivi de remboursement des Frais</h1>
                <label><strong>Fiche de frais de : <?php echo strtoupper($nom_prenom[0]).strtoupper($nom_prenom[1]) ?></strong></label>

                <table>
                    <tr>
                        <th><p class="classp1">Période</p></th>
                        <th>
                            <label for="Mois" class="titre2" > Mois/Année : </label>
                            <input value = "<?php echo $mois ?>" style="width: 60px;" type="number" id="Mois" name="Mois" readonly = "readonly"/>
                            <input value = "<?php echo $annee ?>" style="width: 60px;" type="number" id="Annee" name="Annee" readonly = "readonly"/>
                        </th>   
                    </tr>
                </table>
                                
                <table class="titre2" border="1px";>
                    <tr>
                        <th align="center" width="90px"; height="70px">Repas</th>
                        <th align="center" width="90px"; height="70px">Nuitée</th>
                        <th align="center" width="90px"; height="70px">Etape</th>   
                        <th align="center" width="90px"; height="70px">Km</th>    
                        <th align="center" width="90px"; height="70px">Situation</th>    
                        <th align="center" width="90px"; height="70px">Date opération</th>   
                        <th align="center" width="90px"; height="70px">Remboursement</th>     
                    </tr>
                    <tr>
                    <td align="center" width="90px"; height="70px"><?php echo $REP; ?></td>
                    <td align="center" width="90px"; height="70px"><?php echo $NUI; ?></td>
                    <td align="center" width="90px"; height="70px"><?php echo $ETP; ?></td>   
                    <td align="center" width="90px"; height="70px"><?php echo $KM; ?></td>    
                    <td align="center" width="90px"; height="70px"><?php echo $ID_ETAT[0]; ?></td>  
                    <td align="right" width="90px"; height="70px"><?php echo $tab[6] ?></td>   
                    <td align="right" width="90px"; height="70px"><?php echo $tab[5]."€"; ?></td>   
                    </tr>
                </table>

                <div>
				    <input id="Valider" type="submit" value="Revenir à la gestion des fiches de frais" />
			    </div></br>
                <input id="id" name="id" type="hidden" value="<?php echo $id; ?>">
            </ul>
        </form>    
        <div class="alert" id="alert-box">
            <div class="ball"></div>
        </div>
        <script src="../script.js"></script>
    </body>
</html>
