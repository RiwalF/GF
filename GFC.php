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
                <label class="titre2">Validation des Frais <input type="submit"/></label></br></br>
                <a href="GF7/GF7.php"><label class="PAIEMENT">Mettre en paiement</label>
            </fieldset>
            <?php
            if ($ExisteFicheFrais) {
            ?>
                <input id="mois" name="mois" type="hidden" value="<?php echo $mois; ?>">
                <input id="an" name="an" type="hidden" value="<?php echo $annee; ?>">
                <input id="id" name="id" type="hidden" value="<?php echo $id; ?>">
            <?php
            }
            ?>
        </form>
    </body>
</html>