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

var_dump($nom_prenom_visiteur);

$montant = SQLget("SELECT fichefrais.id FROM fichefrais,etat WHERE idVisiteur IN (SELECT id FROM visiteur WHERE nom='$nom_prenom_visiteur[0]' AND prenom='$nom_prenom_visiteur[1]')");

?>

<html>

    <head lang=fr>
        <title>Fiche Frais</title>
        <meta charset="utf-8">
        <link type="text/css" rel="stylesheet" href="GF3.css"/>

    </head>

    <body>

        <div><!--  class="fondBleu" -->

            <table >

                <tr>

                    <td class="policeTurquoise"><strong>Fiche de frais de : <?php echo strtoupper($nom_prenom_visiteur[0]); ?></strong></td>
                    <td class="policeTurquoise"></td>
                    <td class="policeTurquoise"><strong>Ajouter</strong></td>
                    <td><a href="../GF4/GF4_A.php?id=<?php echo $id?>"><img class="pictureCenter" src="https://annuaire-opticien.essilor.fr/media/Picto_plus.png"></a></td>
                
                </tr>

            </table>
        
        </div>
        
        <div><!--  class="fondBleu" -->

            <table>

                <tr class="fondBleuCiel">

                    <td title="Date">Date</td>
                    <td class="textCenter">Supprimer</td>
                    <td class="textCenter">Modifier</td>
                    <td class="textCenter">Voir</td>

                </tr>

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
                        
                        <td>

                            <?php print($fichefrais[$i][2] . "/" . $fichefrais[$i][3] . " " . $fichefrais[$i][5] . " " . $fichefrais[$i][7]); ?>

                        </td>
                        <?php                   
                            if ($idEtat==SQLgetval("SELECT libelle FROM etat WHERE id = 'CR';"))
                            {
                        ?>
                        <td title="Supprimer">
                                <a href="GF3_DELETE.php?id=<?php echo $id;?>&mois=<?php echo $mois;?>&annee=<?php echo $annee;?>">
                                    <img class="pictureCenter" src="https://us.123rf.com/450wm/oliveradesign/oliveradesign1812/oliveradesign181200007/126817569-ic%C3%B4ne-ouverte-poubelle-isol%C3%A9-sur-fond-blanc-illustration-vectorielle-.jpg?ver=6">
                                </a>
                        </td>

                        <td title="Modifier">
                                <a href="../GF4/GF4_C.php?id=<?php echo $id;?>&mois=<?php echo $mois;?>&annee=<?php echo $annee;?>">
                                    <img class="pictureCenter" src="https://us.123rf.com/450wm/alekseyvanin/alekseyvanin1708/alekseyvanin170800346/83846475-document-avec-stylo-ic%C3%B4ne-de-contour-rempli-signe-de-vecteur-ligne-pictogramme-color%C3%A9-lin%C3%A9aire-isol%C3%A9.jpg">
                                </a>
                        </td>
                        <?php
                            }else{
                        ?>
                            <td title="Supprimer">
                            </td>
                            <td title="Modifier">
                            </td>
                        <?php        
                            }
                        ?>

                        <td title="Voir">
                            
                            <a href="../GF5/GF5.php ? id=<?php echo $id; ?>& mois=<?php echo $mois; ?>& annee=<?php echo $annee; ?>">
                                <img class="pictureCenter" src="https://us.123rf.com/450wm/alekseyvanin/alekseyvanin1704/alekseyvanin170401467/75473998-vecteur-d-ic%C3%B4ne-oeil-illustration-de-logo-solide-vision-pictogramme-isol%C3%A9-sur-blanc.jpg?ver=6">
                            </a>
                        
                        </td>

                    </tr>

                <?php
                }                
                ?>

            </table>
        
        </div>

    </body>
    
</html>

