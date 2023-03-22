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
        <form action="GF6/GF6.php" method="get">  
            <table>
                <tr>
                    <th><h1 class="titre">Redirection</h1></th>
                    <th><img src="GF4/GSB.jpg"></th>
                </tr>
            </table>

            <fieldset>
            <input type="button" name="lien1" value="nom du lien" onclick="self.location.href='GF6/GF6.php'" style="background-color:#3cb371" style="color:white; font-weight:bold"onclick>
            
            <label class="titre2">Validation des Frais <input type="submit"/></label></br></br>
                <a href="GF7/GF7.php"><label class="PAIEMENT">Mettre en paiement</label>
            </fieldset>
        </form>
    </body>
</html>