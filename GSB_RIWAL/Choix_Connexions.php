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
}


?>