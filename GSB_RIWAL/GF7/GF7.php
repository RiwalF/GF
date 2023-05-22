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

        <html>
            <head>
                <title>Connexion au Formulaire de paiement</title>
                <meta charset='utf-8'>
                <link type='text/css' rel='stylesheet' href='../GF.css' />

            </head>    
            <body>  
                <fieldset class = "orange">
                    <h1 class='titre2'>Toutes les fiches de frais à l’état "Validée" ont été mises en
        paiement et sont passées à l’état "Remboursée</h1>
                </fieldset>
                <div class="alert" id="alert-box">
                    <div class="ball"></div>
                </div>
                <script src="../script.js"></script>
            </body>
        </html>

