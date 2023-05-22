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

$id=$_GET['id'];
$mois =$_GET['mois'];
$annee=$_GET['annee'];

$idFichefrais = SQLgetval("SELECT id FROM fichefrais WHERE idVisiteur='$id' AND mois='$mois' AND annee='$annee';");
$Repas = SQLgetval("SELECT quantite FROM lignefraisforfait WHERE idForfait = 'REP' AND idFicheFrais = '$idFichefrais'");
$Km = SQLgetval("SELECT quantite FROM lignefraisforfait WHERE idForfait = 'KM' AND idFicheFrais = '$idFichefrais'");
$Etape = SQLgetval("SELECT quantite FROM lignefraisforfait WHERE idForfait = 'ETP' AND idFicheFrais = '$idFichefrais'");
$Nuit = SQLgetval("SELECT quantite FROM lignefraisforfait WHERE idForfait = 'NUI' AND idFicheFrais = '$idFichefrais'");


?>

<html>
    <head>
        <title>Formulaire de paiement</title>
        <meta charset="utf-8">
		<link type="text/css" rel="stylesheet" href="../GF.css"/>

    </head>    
    <body>  
        <form name="GF4" action="GF4_D.php" method="get">

                <fieldset class="orange">
                <h1 class="titre2">Gestion des Frais</h1>
                <br/>
                <input type="button" name="lien0" value="Retour en arriere" onclick="self.location.href='../GSB_Connexions.php'" style="background-color:#658db3" style="color:white; font-weight:bold"onclick>
                <br/><br/>
                <div>
                    <pre>
<h class="titre2">PERIODE            </h><label for="mois" class="titre2"> Mois (2 chiffres) : </label><input value = "<?php echo $mois;?>" readonly = "readonly" type="number" id="mois" name="mois" /><label for="Annee" class="titre2" > Année (4 chiffres) : </label><input value = "<?php echo $annee;?>" readonly = "readonly" type="number" id="Annee" name="Annee" />
<h class="titre2">D'ENGAGEMENT :</h>
                    </pre>
                </div><BR>
                <h2 class="titre2">Frais au forfait</h2><BR>
                <div>
                    <pre>
<label for="Repas" class="titre2">Repas midi :                    </label><input type="number" id="Repas" name="Repas" min="0" value="<?php echo $Repas;?>" />
<label for="Nuit" class="titre2">Nuitées :                       </label><input type="number" id="Nuit" name="Nuit" min="0" value="<?php echo $Nuit;?>"/>
<label for="Etape" class="titre2">Etape :                         </label><input type="number" id="Etape" name="Etape" min="0" value="<?php echo $Etape;?>"/>
<label for="Km" class="titre2">Km :                            </label><input type="number" id="Km" name="Km" min="0" value="<?php echo $Km;?>"/>
                    </pre>
                </div>

                <div>
				    <input id="Valider" type="submit" value="Soumettre la requête" />
			    </div>

            </fieldset>
            <input id="id" name="id" type="hidden" value="<?php echo $id; ?>">
            <input id="idFichefrais" name="idFichefrais" type="hidden" value="<?php echo $idFichefrais; ?>">
        </form>    
        <div class="alert" id="alert-box">
            <div class="ball"></div>
        </div>
        <script src="../script.js"></script>
    </body>
</html>