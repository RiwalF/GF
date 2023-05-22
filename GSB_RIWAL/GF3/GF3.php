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

?>

<html>

    <head lang=fr>
        <title>Fiche Frais</title>
        <meta charset="utf-8">
        <link type="text/css" rel="stylesheet" href="GF3.css"/>
    </head>

    <body>

        <table>
            <tr>
                <th><h1 class="titre">Fiche Frais</h1></th>
                <th><img src="../GF4/GSB.jpg"></th>
            </tr>
        </table>
        <br/>
        <input type="button" name="lien0" value="Retour en arriere" onclick="self.location.href='../GSB_Connexions.php'" style="background-color:#658db3" style="color:white; font-weight:bold"onclick>
        <br/><br/>
        <table class="tableau">
            <thead>
                <tr>
                    <th><strong>Fiche de frais de : <?php echo $nom_prenom_visiteur[0]; ?></strong></th>
                    <th></th>
                    <th></th>
                    <th><strong>Ajouter</strong><a href="../GF4/GF4_A.php?id=<?php echo $id?>"><img class="pictureCenter" src="https://annuaire-opticien.essilor.fr/media/Picto_plus.png" width="30px"></a></th>
                </tr>
                <tr>
                    <th title="Date">Date</th>
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
                        <?php print($fichefrais[$i][2] . "/" . $fichefrais[$i][3] . " " . $fichefrais[$i][5] . " " . $fichefrais[$i][7]); ?>
                    </th>

                    <?php                   
                        if ($idEtat==SQLgetval("SELECT libelle FROM etat WHERE id = 'CR'"))
                        {
                    ?>

                    <th title="Supprimer">
                            <a href="GF3_DELETE.php?id=<?php echo $id;?>&mois=<?php echo $mois;?>&annee=<?php echo $annee;?>">
                                <img class="pictureCenter" src="https://us.123rf.com/450wm/oliveradesign/oliveradesign1812/oliveradesign181200007/126817569-ic%C3%B4ne-ouverte-poubelle-isol%C3%A9-sur-fond-blanc-illustration-vectorielle-.jpg?ver=6" width="30px">
                            </a>
                    </th>

                    <th title="Modifier">
                            <a href="../GF4/GF4_C.php?id=<?php echo $id;?>&mois=<?php echo $mois;?>&annee=<?php echo $annee;?>">
                                <img class="pictureCenter" src="https://us.123rf.com/450wm/alekseyvanin/alekseyvanin1708/alekseyvanin170800346/83846475-document-avec-stylo-ic%C3%B4ne-de-contour-rempli-signe-de-vecteur-ligne-pictogramme-color%C3%A9-lin%C3%A9aire-isol%C3%A9.jpg" width="30px">
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
                            <img class="pictureCenter" src="https://us.123rf.com/450wm/alekseyvanin/alekseyvanin1704/alekseyvanin170401467/75473998-vecteur-d-ic%C3%B4ne-oeil-illustration-de-logo-solide-vision-pictogramme-isol%C3%A9-sur-blanc.jpg?ver=6" width="30px">
                        </a>
                    </th>

                </tr>

                <?php
                }                
                ?>

            </tbody>
        </table>

        <div class="alert" id="alert-box">
            <div class="ball"></div>
        </div>
        <script src="../script.js"></script>

    </body>
</html>

