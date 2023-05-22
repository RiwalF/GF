<?php

include '../mesFonctionsGenerales.php';

function SQL($sql)
{
    #Connexion à la base de données GSB_frais
    $cnxBDD = connexion();

    $result = $cnxBDD->query($sql)
        or die ("Requête invalide : " . $sql);
}
function SQLgetval($sql)
{
    $cnxBDD = connexion();

    $result = $cnxBDD->query($sql)
        or die ("Requete invalide : ".$sql);    
    $valeur = $result->fetch_array(2);
    return $valeur[0];
}

#REMBOURSEMENT des fichefrais
SQL("UPDATE `fichefrais` SET `idEtat` = 'RB' WHERE `idEtat` = 'VA';");

?>

<!DOCTYPE html>

<html style = "background-color: rgb(101, 141, 179)">

    <head lang=fr>

        <meta charset="utf-8">
		<link type="text/css" rel="stylesheet" href="../GF4/GF4.css" />
        <title>Action réalisée avec succès</title>

    </head>

    <body>

        <p style = "text-align: center ; text-align: middle ; font-size: 50px ; font-family: Calibri ; color: white ;"><br><br><br><strong>Toutes les fiches de frais à l’état "Validée" ont été mises en</br>
        paiement et sont passées à l’état "Remboursée"</strong></p>

        <form name="GF4" action="../GFC.php" method="get">

            <div>

                <input id="Valider" type="submit" value="Revenir à la redirection" />
                
            </div>

        </form>
        <div class="alert" id="alert-box">
            <div class="ball"></div>
        </div>
        <script src="../script.js"></script>

    </body>

</html>