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
            <ul class="ul1">
                <h2 style="color:rgb(101, 141, 179);"><strong>Fiche de frais de : <?php echo strtoupper($nom_prenom[0]).strtoupper($nom_prenom[1]) ?></strong></h2>
            <ul class="ul2">

                <table>
                    <tr>
                        <th><p class="classp1">Période</p></th>
                        <th><pre>     </pre></th>
                        <th>
                            <label for="Mois" class="titre2" > Mois/Année : </label>
                            <input value = "<?php echo $mois ?>" style="width: 60px;" type="number" id="Mois" name="Mois" readonly = "readonly"/>
                            <input value = "<?php echo $annee ?>" style="width: 60px;" type="number" id="Annee" name="Annee" readonly = "readonly"/>
                        </th>   
                    </tr>
                </table>
                
                <h2 class="titre2">Frais au forfait</h2><BR>
                
                <table class="titre2" border="1px";>
                    <tr>
                        <td align="center" width="90px"; height="70px">Repas</td>
                        <td align="center" width="90px"; height="70px">Nuitée</td>
                        <td align="center" width="90px"; height="70px">Etape</td>   
                        <td align="center" width="90px"; height="70px">Km</td>    
                        <td align="center" width="90px"; height="70px">Situation</td>    
                        <td align="center" width="90px"; height="70px">Date opération</td>   
                        <td align="center" width="90px"; height="70px">Remboursement</td>     
                    </tr>
                </table>
                <table class="titre2">
                    <tr>
                        <td align="center" width="90px"; height="70px"><?php echo $REP; ?></td>
                        <td align="center" width="90px"; height="70px"><?php echo $NUI; ?></td>
                        <td align="center" width="90px"; height="70px"><?php echo $ETP; ?></td>   
                        <td align="center" width="90px"; height="70px"><?php echo $KM; ?></td>    
                        <td align="center" width="90px"; height="70px"><?php echo $ID_ETAT[0]; ?></td>    
                        <td align="right" width="90px"; height="70px"><?php echo $tab[6] ?></td>   
                        <td align="right" width="90px"; height="70px"><?php echo $tab[5]."€"; ?></td>     
                    </tr>
                </table></br>

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
