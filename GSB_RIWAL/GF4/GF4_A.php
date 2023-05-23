<?php
ini_set("display_errors", 1); 
include '../mesFonctionsGenerales.php';
$IDENTIFIANT = $_GET["id"];

function SQLobject($sql)
{
    $cnxBDD = connexion();

    $result = $cnxBDD->query($sql)
        or die ("Requete invalide : ".$sql);    
    $valeur = $result->fetch_all();
    return $valeur;
}


// Controle // Recherche de kilométrage du véhicule associé à l'utilisateur connecté
// echo "SELECT immat,kilometrage FROM `vehicule` WHERE idVisiteur = '".$idVisiteur."';";
$kilometrage = SQLobject("SELECT kilometrage FROM `vehicule` WHERE idVisiteur = '".$IDENTIFIANT."';");


?>

<html>
    <head>
        <title>Formulaire de paiement</title>
        <meta charset="utf-8">
		<link type="text/css" rel="stylesheet" href="../GF.css"/>
    </head>    
    <body>  
        <form name="GF4" action="GF4_B.php" method="get">

                <fieldset class="orange">
                <h1 class="titre2">Gestion des Frais</h1>
                <br/>
                <input type="button" name="lien0" value="Retour en arriere" onclick="self.location.href='../GF3/GF3.php?id=<?php echo $IDENTIFIANT;?>'" style="background-color:#658db3" style="color:white; font-weight:bold"onclick>
                <br/><br/>
                <div>
                    <pre>
<label for="mois" class="titre2"> Mois (2 chiffres) : </label><input value = "<?php echo date("m") ?>" readonly = "readonly" type="number" id="mois" name="mois" /><label for="Annee" class="titre2" > Année (4 chiffres) : </label><input value = "<?php echo date("Y") ?>" readonly = "readonly" type="number" id="Annee" name="Annee" />
                    </pre>
                </div><BR>
                <h2 class="titre2">Frais au forfait</h2><BR>
                <div>
                    <pre>
<label for="Repas" class="titre2">Repas midi :                    </label><input type="number" id="Repas" name="Repas" min="0" value="0" />
<label for="Nuit" class="titre2">Nuitées :                       </label><input type="number" id="Nuit" name="Nuit" min="0" value="0"/>
<label for="Etape" class="titre2">Etape :                         </label><input type="number" id="Etape" name="Etape" min="0" value="0"/>
<!-- Controle - Changement du texte -->
<label for="Km" class="titre2">Kilométrage véhicule :                            </label><input type="number" id="Km" name="Km" min="0" placeholder="<?php echo $kilometrage[0][0];?>"/>
                    </pre>
                </div>

                <div>
				    <input id="Valider" type="submit" value="Soumettre la requête" />
			    </div>

            </fieldset>
            <input id="id" name="id" type="hidden" value="<?php echo $IDENTIFIANT; ?>">
        </form>    
        <div class="alert" id="alert-box">
            <div class="ball"></div>
        </div>
        <script src="../script.js"></script>
    </body>
</html>