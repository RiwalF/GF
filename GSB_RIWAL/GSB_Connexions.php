<html>
    <head>
        <title>Connexion au Formulaire de paiement</title>
        <meta charset="utf-8">
		<link type="text/css" rel="stylesheet" href="GF.css" />

    </head>    
    <body>  
    <form name="GF4/GF4.php" action="Choix_Connexions.php" method="get">
        <fieldset class="orange">
            <h1 class="titre2">Connexion</h1>
            <label for="id" class="titre2">Identifiant :</label>
            <input type="text" id="id" name="id" placeholder="AAAA" class="my-text-input" />
            <label for="mdp" class="titre2">Mot de passe :</label>
            <input type="password" id="mdp" name="mdp" placeholder="**********" class="my-text-input" />
            <input type="submit" value="Submit" style="background-color:#658db3" style="color:white; font-weight:bold"onclick/>
        </fieldset>
    </form>


        <div class="alert" id="alert-box">
            <div class="ball"></div>
        </div>
        <script src="script.js"></script>

    </body>
</html>