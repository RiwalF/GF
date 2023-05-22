<?php
ini_set("display_errors", 1); 
include '../mesFonctionsGenerales.php';

function SQL($sql)
{
    $cnxBDD = connexion();

    $result = $cnxBDD->query($sql)
        or die ("Requete invalide : ".$sql);
}
function SQLget($sql)
{
    $cnxBDD = connexion();

    $result = $cnxBDD->query($sql)
        or die ("Requete invalide : ".$sql);    
    $valeur = $result->fetch_array(2);
    return $valeur;
}
function SQLgetval($sql)
{
    $cnxBDD = connexion();

    $result = $cnxBDD->query($sql)
        or die ("Requete invalide : ".$sql);    
    $valeur = $result->fetch_array(2);
    return $valeur[0];
}
function SQLobject($sql)
{
    $cnxBDD = connexion();

    $result = $cnxBDD->query($sql)
        or die ("Requete invalide : ".$sql);    
    $valeur = $result->fetch_all();
    return $valeur;
}

$id = $_GET['id'];

$nom_prenom_visiteur = SQLget("SELECT nom,prenom FROM visiteur WHERE id = '$id';");

$montant = SQLget("SELECT fichefrais.id FROM fichefrais,etat WHERE idVisiteur IN (SELECT id FROM visiteur WHERE nom='$nom_prenom_visiteur[0]' AND prenom='$nom_prenom_visiteur[1]')");

$annee_du_jour = date("Y");
$mois_du_jour = date("m");
echo $annee_du_jour." / ".$mois_du_jour;
// test
$fiche_cloture = SQLobject("SELECT `id`, `idEtat`, `mois`, `annee` FROM `fichefrais` WHERE idEtat = 'CR';");
var_dump($fiche_cloture);
foreach ($fichesfrais as $key => $fiche) {
    if ($fiche[3] = "") {
        # code...
    }
}



?>

<html>

    <head lang=fr>
        <title>Fiche Frais</title>
        <meta charset="utf-8">
        <link type="text/css" rel="stylesheet" href="../GF.css"/>
    </head>

    <body>
        <fieldset class="orange">
        <table>
            <tr>
                <th><h1 class="titre">Fiche Frais</h1></th>
            </tr>
        </table>
        <br/>
        <input type="button" name="lien0" value="Retour en arriere" onclick="self.location.href='../GSB_Connexions.php'" style="background-color:#658db3" style="color:white; font-weight:bold"onclick>
        <br/><br/>
        <table class="tableau">
            <thead>
                <tr>
                    <th><strong>Fiche de frais de : <?php echo $nom_prenom_visiteur[0]." - ".$nom_prenom_visiteur[1]; ?></strong></th>
                    <th></th>
                    <th></th>
                    <th><a href="../GF4/GF4_A.php?id=<?php echo $id?>"><img class="pictureCenter" src="https://annuaire-opticien.essilor.fr/media/Picto_plus.png" width="30px"></a></th>
                </tr>
                <tr>
                    <th title="Date">Date - Montant - État</th>
                    <th title="Supprimer">Supprimer</th>
                    <th title="Modifier">Modifier</th>
                    <th title="Voir">Voir</th>
                </tr>
            </thead>
            <tbody>


            <?php                
            $fichefrais = SQLobject("SELECT * FROM `fichefrais` WHERE `idVisiteur`= '$id';");

            for ($i=0; $i < count($fichefrais); $i++) 
            {   
                $mois = $fichefrais[$i][2];
                $annee = $fichefrais[$i][3];
                $montant = $fichefrais[$i][5];
                $idEtat = $fichefrais[$i][7];
                $idEtat = SQLgetval("SELECT libelle FROM etat WHERE id = '$idEtat';")
            ?>

                <tr class="fondBlanc">
                    <th>
                        <?php print($fichefrais[$i][2] . "/" . $fichefrais[$i][3] . " - " . $fichefrais[$i][5] . "€ - " . $fichefrais[$i][7]); ?>
                    </th>

                    <?php                   
                        if ($idEtat==SQLgetval("SELECT libelle FROM etat WHERE id = 'CR'"))
                        {
                    ?>

                    <th title="Supprimer">
                            <a href="GF3_DELETE.php?id=<?php echo $id;?>&mois=<?php echo $mois;?>&annee=<?php echo $annee;?>">
                                <img class="pictureCenter" src="../images/poubelle.png" width="30px">
                            </a>
                    </th>

                    <th title="Modifier">
                            <a href="../GF4/GF4_C.php?id=<?php echo $id;?>&mois=<?php echo $mois;?>&annee=<?php echo $annee;?>">
                                <img class="pictureCenter" src="../images/crayon.png" width="30px">
                            </a>
                    </th>

                    <?php
                        }else{
                    ?>

                    <th title="Supprimer"></th>
                    <th title="Modifier"></th>

                    <?php        
                        }
                    ?>

                    <th title="Voir">
                        <a href="../GF5/GF5.php?id=<?php echo $id;?>&mois=<?php echo $mois;?>&annee=<?php echo $annee;?>">
                            <img class="pictureCenter" src="../images/oeil.png" width="30px">
                        </a>
                    </th>

                </tr>

                <?php
                }                
                ?>

            </tbody>
        </table>
        </fieldset>
        <div class="alert" id="alert-box">
            <div class="ball"></div>
        </div>
        <script src="../script.js"></script>

    </body>
</html>

