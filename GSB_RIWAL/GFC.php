<?php
ini_set("display_errors", 1); 

?>

<html>
    <head>
        <title>Connexion au Formulaire de paiement</title>
        <meta charset="utf-8">
		<link type="text/css" rel="stylesheet" href="GFC.css"/>

    </head>    
    <body>  
        <fieldset>
            <h1 class="titre2">Redirection</h1>
            <br/>
            <input type="button" name="lien0" value="Retour en arriere" onclick="self.location.href='GSB_Connexions.php'" style="background-color:#658db3" style="color:white; font-weight:bold"onclick>
            <br/><br/>
            <input type="button" name="lien1" value="Remboursement des frais" onclick="self.location.href='GF6/GF6.php?submit=nothing'" style="background-color:#658db3" style="color:white; font-weight:bold"onclick>
            <br/><br/>
            <input type="button" name="lien2" value="Mettre en paiement" onclick="self.location.href='GF7/GF7.php'" style="background-color:#658db3" style="color:white; font-weight:bold"onclick>
            <br/>
        </fieldset>
    </body>
</html>