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

<html>
    <head>
        <title>Connexion au Formulaire de paiement</title>
        <meta charset='utf-8'>
        <link type='text/css' rel='stylesheet' href='GF.css' />

    </head>    
    <body>  
        <fieldset>
            <h1 class='titre'>Erreur de connexion veuillez réessayer</h1>
        </fieldset>
        <div class='alert' id='alert-box'>
            <div class='ball'></div>
        </div>
        <script src='../script.js'></script>
    </body>
</html>";

