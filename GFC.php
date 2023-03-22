<?php
ini_set("display_errors", 1); 

?>

<html>
    <head>
        <title>Connexion au Formulaire de paiement</title>
        <meta charset="utf-8">
		<link type="text/css" rel="stylesheet" href="GF4/GF4.css" />

    </head>    
    <body>  
        <table>
            <tr>
                <th><h1 class="titre">Redirection</h1></th>
                <th><img src="GF4/GSB.jpg"></th>
            </tr>
        </table>

        <fieldset>
            <br/>
            <input type="button" name="lien1" value="Remboursement des frais" onclick="self.location.href='GF6/GF6.php?idFicheFrais=NULL'" style="background-color:#3cb371" style="color:white; font-weight:bold"onclick>
            <br/><br/>
            <input type="button" name="lien2" value="Mettre en paiement" onclick="self.location.href='GF7/GF7.php'" style="background-color:#3cb371" style="color:white; font-weight:bold"onclick>
        </fieldset>
    </body>
</html>