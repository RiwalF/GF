<?php
ini_set("display_errors", 1); 
include 'mesFonctionsGenerales.php';

$id = $_GET["id"];

function SQLget($sql){
    $cnxBDD = connexion();
    $result = $cnxBDD->query($sql)
        or die ("Requete invalide : ".$sql);    
    $valeur = $result->fetch_array();
    return $valeur;
}

$statut_C = SQLget("SELECT * FROM `comptable` WHERE `Comptable_id` = '$id';");
$statut_V = SQLget("SELECT * FROM `visiteur` WHERE `id` = '$id';");

if (gettype($statut_C) == "array" ){
    header('Location: GFC.php');
}elseif (gettype($statut_V) == "array" ) {
    header('Location: GF3/GF3.php?id='.$id);
    exit();
}else{
    echo "<html>
            <head>
                <title>Connexion au Formulaire de paiement</title>
                <meta charset='utf-8'>
                <link type='text/css' rel='stylesheet' href='GF4/GF4.css' />

            </head>    
            <body>  
                <table>
                    <tr>
                        <th><h1 class='titre'>Redirection</h1></th>
                        <th><img src='GF4/GSB.jpg'></th>
                    </tr>
                </table>

                <fieldset>
                    <h1 class='titre2'>Erreur de connexion veuillez réessayer</h1>
                </fieldset>
            </body>
        </html>";
}


?>