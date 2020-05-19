<?php
    
    //début de session
    session_start();
    
    //si l'utilisateur ne tante pas de se connecter 
    if(!isset($_POST["Login"])){
        //si l'utilisateur n'est pas connecté
        if(!isset($_SESSION["Acount"])){
            //définition de l'utilisateur par défaut
            $_SESSION["Acount"]="none";
        }
    }
    //sinon
    else
    {
        //connexion à la base de données
        define('USER',"root");
        define('PASSWORD',"");
        define('SERVER',"localhost");
        define('BASE',"cli_com");
        
        function connect_bd(){
        
            $dsn="mysql:dbname=".BASE.";host=".SERVER;
            
            try{
                $connexion=new PDO($dsn,USER,PASSWORD);
            }catch(PDOException $e){
                printf("echec de la connexion : %s\n", $e->getMessage());
                exit();
            }
            return $connexion;
        
        }
        
        $connexion=connect_bd();
        
        //récupération de la liste des utilisateurs
        $sql="SELECT * FROM CUISINIER";
        
        //si il y a une érreur
        if(!$connexion->query($sql)){
            //affichage d'érreur à l'utilisateur
            echo("Problème d'accès au clients.");
        }
        //sinon
        else
        {
            //initialisation du boolean Trouver à faux
            $Trouver=False;
            //pour chaque résultat de la requète
            foreach($connexion->query($sql) as $row)
                //si le nom correspond au login
                if($_POST["Login"]==$row['NOM']){
                    //si le mot de passe est correct
                    if($_POST["Password"]==$row['MDP']){
                        //sauvegarde des données dans des variables de session
                        $_SESSION["ID"]=$row['ID'];
                        $_SESSION["Acount"]=$_POST['Login'];
                        $_SESSION["MDP"]=$_POST['Password'];
                        $_SESSION["STATUE"]=$row['STATUE'];
                        //set de Trouver à vrai
                        $Trouver=True;
                    }
                    //sinon
                    else
                    {
                        //affichage d'érreur à l'utilisateur
                        echo("Mauvais mot de passe.");
                    }
                }
            //si l'utilisateur n'est pas trouvé
            if(!$Trouver){
                //affichage d'érreur à l'utilisateur
                echo("echec de la connexion.");
            }
        }
    }
    
    //si l'utilisateur veut ajouté un plat
    if(isset($_POST["NomPlat"])){
        //connexion à la base de données
        define('USER',"root");
        define('PASSWORD',"");
        define('SERVER',"localhost");
        define('BASE',"cli_com");
        
        function connect_bd(){
        
            $dsn="mysql:dbname=".BASE.";host=".SERVER;
            
            try{
                $connexion=new PDO($dsn,USER,PASSWORD);
            }catch(PDOException $e){
                printf("echec de la connexion : %s\n", $e->getMessage());
                exit();
            }
            return $connexion;
        
        }
        
        $connexion=connect_bd();
        
        //préparation de l'instruction
        $sql="insert into PLAT(NOMPLAT,ID)
              values ('".$_POST["NomPlat"]."',:id)";
        $stmt=$connexion->prepare($sql);
        //ajout du paramètre id
        $stmt->bindParam(':id',$_SESSION["ID"]);
        //exécution de l'instruction
        $stmt->execute();
        //set de Message
        $Message="Votre plat a été ajouté avec succès.";  
        //fermeture de la base
        $stmt->closeCursor();
    }
    
    //si l'utilisateur veut ajouté un repas
    if(isset($_POST["PlatChoisi"])){
        //connexion à la base de données
        define('USER',"root");
        define('PASSWORD',"");
        define('SERVER',"localhost");
        define('BASE',"cli_com");
        
        function connect_bd(){
        
            $dsn="mysql:dbname=".BASE.";host=".SERVER;
            
            try{
                $connexion=new PDO($dsn,USER,PASSWORD);
            }catch(PDOException $e){
                printf("echec de la connexion : %s\n", $e->getMessage());
                exit();
            }
            return $connexion;
        
        }
        
        $connexion=connect_bd();
        //préparation de l'instruction
        $sql="insert into REPAS(IDPLAT,ID,DATEREPAS)
              values (".$_POST["PlatChoisi"].",".$_SESSION["ID"].",STR_TO_DATE(\"".str_replace("-"," ",$_POST["DateRepas"])."\",\"%Y %m %d\"));";
        $stmt=$connexion->prepare($sql);
        //exécution de l'instruction
        $stmt->execute();
        //set de Message
        $Message="Votre Repas a été ajouté avec succès.";  
        //fermeture de la base
        $stmt->closeCursor();
    }
    
    //si l'utilisateur veut supprimer un repas
    if(isset($_POST["RepasChoisi"])){
        //connexion à la base de données
        define('USER',"root");
        define('PASSWORD',"");
        define('SERVER',"localhost");
        define('BASE',"cli_com");
        
        function connect_bd(){
        
            $dsn="mysql:dbname=".BASE.";host=".SERVER;
            
            try{
                $connexion=new PDO($dsn,USER,PASSWORD);
            }catch(PDOException $e){
                printf("echec de la connexion : %s\n", $e->getMessage());
                exit();
            }
            return $connexion;
        
        }
        
        $connexion=connect_bd();
        //préparation de l'instruction
        $sql="DELETE FROM REPAS
              WHERE IDREPAS=:id";
        $stmt=$connexion->prepare($sql);
        //ajout du paramètre id
        $stmt->bindParam(':id',$_POST["RepasChoisi"]);
        //exécution de l'instruction
        $stmt->execute();
        //set de Message
        $Message="Votre Repas a été supprimé avec succès.";  
        //fermeture de la base
        $stmt->closeCursor();
    }
    
    //si l'utilisateur veut supprimer une recette
    if(isset($_POST["RecetteChoisi"])){
        //connexion à la base de données
        define('USER',"root");
        define('PASSWORD',"");
        define('SERVER',"localhost");
        define('BASE',"cli_com");
        
        function connect_bd(){
        
            $dsn="mysql:dbname=".BASE.";host=".SERVER;
            
            try{
                $connexion=new PDO($dsn,USER,PASSWORD);
            }catch(PDOException $e){
                printf("echec de la connexion : %s\n", $e->getMessage());
                exit();
            }
            return $connexion;
        
        }
        
        $connexion=connect_bd();
        //préparation de l'instruction
        $sql="DELETE FROM PLAT
              WHERE IDPLAT=:id";
        $stmt=$connexion->prepare($sql);
        //ajout du paramètre id
        $stmt->bindParam(':id',$_POST["RecetteChoisi"]);
        //exécution de l'instruction
        $stmt->execute();
        //set de Message
        $Message="Votre recette a été supprimé avec succès.";  
        //fermeture de la base
        $stmt->closeCursor();
    }
    
?>

<!DOCTYPE HTML5>
<!--ceci est une page web visant à répondre à un TP sur le PDO et le POO-->
<html>

<!--head-->
	<head>
		<!--titre de la page web-->
		<title>TP PDO POO</title>
		<!--encodage de la page-->
		<meta charset="UTF-8"/>
        <!--icone de la page-->
        <link rel="icon" href="image/icone.png">
		<!--lien au css (cascading styel sheet)-->
        <link rel=StyleSheet href="CSS/style.css" type="text/css">
        <!--Lien au javascript-->
		<script type="text/javascript" src="JS/Fichier_Script.js"></script>
		
	</head>

<!--body-->
    <?php
        //changement de l'id du body en fonction du compte pour le CSS
        switch($_SESSION["Acount"]){
            case "none":
                echo("<body id=\"BODYDEFAULT\"");
                break;
            case "admin":
                echo("<body id=\"BODYADMIN\"");
                break;
            case "Velvet":
                echo("<body id=\"BODYVELVET\"");
                break;
            case "Laphicet":
                echo("<body id=\"BODYLAPHICET\"");
                break;
            case "Eizen":
                echo("<body id=\"BODYEIZEN\"");
                break;
            case "Rokurou":
                echo("<body id=\"BODYROKUROU\"");
                break;
            case "Eleanor":
                echo("<body id=\"BODYELEANOR\"");
                break;
            case "Magilou":
                echo("<body id=\"BODYMAGILOU\"");
                break;
        }
    ?>

        <!--formulaire de connection-->
        <form action="#" method="post" id="LOG" name="Log">
            <!--Label de Login-->
            <label for="Login">Login	:</label><br/>
            <!--input de Login-->
            <input type="text" id="IDLOGIN" name="Login" size="20" placeholder="Votre login" required /><br/>
            <!--Place des érreurs lié à Login-->
            <span id="SpanErreurLogin"></span><br/>
            <!--Label de Password-->
            <label for="Password">Password	:</label><br/>
            <!--input de Password-->
            <input type="password" id="IDPASSWORD" name="Password" size="20" placeholder="Votre password" required /><br/>
            <!--Place des érreurs lié à Password-->
            <span id="SpanErreurPassword"></span><br/>
            <input type="button" value="Valider" id="BOUTONLOG" name="boutonlog" onclick="ValideLogin()" /><br/>
        </form>

        <?php
            //si un utilisateur est connecté
            if($_SESSION["Acount"]!="none"){
               //ajout du formulaire d'action
               echo("<!--formulaire de choix d'action-->
                        <form action=\"#\" method=\"post\" id=\"CHOIXACTION\" name=\"ChoixAction\">
                            <!--Label de SELECTACTION-->
                            <p>Veuillez choisir une action	:</p>
                            <select name=\"SELECTACTION\">
                                <option value=\"AfficherRecettes\">Afficher vos recettes</option>
                                <option value=\"AfficherRepas\">Afficher vos repas</option>
                                <option value=\"AfficherDetails\">Afficher les détails du compte</option>
                                <option value=\"AjoutRecettes\">Ajouter une recette</option>
                                <option value=\"AjoutRepas\">Ajouter un repas</option>
                                <option value=\"SupRecettes\">Supprimer une recette</option>
                                <option value=\"SupRepas\">Supprimer un repas</option>
                                <option value=\"Deconnexion\">Déconnexion</option>
                            </select><br/>
                            <input type=\"submit\" value=\"Valider\" id=\"BOUTONACTION\" name=\"boutonaction\" /><br/>
                        </form>");
            }
        ?>
        
        <!--titre de la page-->
        <h1>Bienvenue cuisinier !</h1>
        
        <fieldset id="CONTENUPRINCIPALE">
            <legend>
                <?php
                    //ajout de la légende en fonction du formulaire sélectionné
                    if(!isset($_POST["SELECTACTION"])){
                        echo("aucun formulaire sélectionné");
                    }else{
                        switch($_POST["SELECTACTION"]){
                            case "AfficherRecettes":
                                echo("Affichage de vos recettes");
                                break;
                            case "AfficherRepas":
                                echo("Affichage de vos repas");
                                break;
                            case "AfficherDetails":
                                echo("Affichage des détails de votre compte");
                                break;
                            case "AjoutRecettes":
                                echo("Ajouter une recette");
                                break;
                            case "AjoutRepas":
                                echo("Ajouter un repas");
                                break;
                            case "SupRecettes":
                                echo("Supprimer une recette");
                                break;
                            case "SupRepas":
                                echo("Supprimer un repas");
                                break;
                            case "Deconnexion":
                                echo("Déconnexion du compte");
                                break;
                        }
                    }
                ?>
            </legend>
            
            <p>
                <?php
                    //si un utilisateur est connecté
                    if($_SESSION["Acount"]!="none"){
                        //affichage de la connexion
                        echo("<h2> Vous êtes connecté en temps que ".$_SESSION["Acount"].". </h2>");
                    }
                    //sinon
                    else
                    {
                        //précision qu'aucun utilisateur n'est connecté
                        echo("<h2> Vous n'êtes pas connecté. </h2>");
                    }
                    
                    //si il y a un message
                    if(isset($Message)){
                        //affichage du message
                        echo($Message);
                    }
                    
                    //si une action a été sélectionné
                    if(isset($_POST["SELECTACTION"])){
                        //création du contenu de la page en fonction de l'action
                        switch($_POST["SELECTACTION"]){
                            case "AfficherRecettes":
                                //connexion à la base de données
                                define('USER',"root");
                                define('PASSWORD',"");
                                define('SERVER',"localhost");
                                define('BASE',"cli_com");
                                
                                function connect_bd(){
                                
                                    $dsn="mysql:dbname=".BASE.";host=".SERVER;
                                    
                                    try{
                                        $connexion=new PDO($dsn,USER,PASSWORD);
                                    }catch(PDOException $e){
                                        printf("echec de la connexion : %s\n", $e->getMessage());
                                        exit();
                                    }
                                    return $connexion;
                                
                                }
                                
                                $connexion=connect_bd();
                                //préparation de l'instruction
                                $sql="SELECT * FROM PLAT WHERE ID=:id";
                                $stmt=$connexion->prepare($sql);
                                //ajout du paramètre id
                                $stmt->bindParam(':id',$_SESSION["ID"]);
                                //exécution de l'instruction
                                $stmt->execute();
                                //affichage du tableau de résultat
                                echo("<table>
                                        <thead>
                                            <tr>
                                                <th colspan=\"2\">Liste de vos recettes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Numéro du Plat</td>
                                                <td>Nom du Plat</td>
                                            </tr>");
                                while($res=$stmt->fetch(PDO::FETCH_ASSOC)){
                                    echo("<tr>
                                            <td>".$res["IDPLAT"]."</td>
                                            <td>".$res["NOMPLAT"]."</td>
                                         </tr>");
                                }
                                echo("</tbody>
                                    </table>");  
                                //fermeture de la base
                                $stmt->closeCursor();
                                break;
                            case "AfficherRepas":
                                //connexion à la base de données
                                define('USER',"root");
                                define('PASSWORD',"");
                                define('SERVER',"localhost");
                                define('BASE',"cli_com");
                                
                                function connect_bd(){
                                
                                    $dsn="mysql:dbname=".BASE.";host=".SERVER;
                                    
                                    try{
                                        $connexion=new PDO($dsn,USER,PASSWORD);
                                    }catch(PDOException $e){
                                        printf("echec de la connexion : %s\n", $e->getMessage());
                                        exit();
                                    }
                                    return $connexion;
                                
                                }
                                
                                $connexion=connect_bd();
                                //préparation de l'instruction
                                $sql="SELECT REPAS.IDREPAS as NUM, PLAT.NOMPLAT as PLATC, REPAS.DATEREPAS as DATER, PLAT.ID as SPE
                                      FROM REPAS
                                      INNER JOIN PLAT ON REPAS.IDPLAT = PLAT.IDPLAT
                                      WHERE REPAS.ID=:id";
                                $stmt=$connexion->prepare($sql);
                                //ajout du paramètre id
                                $stmt->bindParam(':id',$_SESSION["ID"]);
                                //exécution de l'instruction
                                $stmt->execute();
                                //affichage du tableau de résultat
                                echo("<table>
                                        <thead>
                                            <tr>
                                                <th colspan=\"4\">Liste de vos repas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Numéro du repas</td>
                                                <td>Nom du Plat</td>
                                                <td>Date du repas</td>
                                                <td>Votre spécialité</td>
                                            </tr>");
                                while($res=$stmt->fetch(PDO::FETCH_ASSOC)){
                                    echo("<tr>
                                            <td>".$res["NUM"]."</td>
                                            <td>".$res["PLATC"]."</td>
                                            <td>".$res["DATER"]."</td>");
                                    if($res["SPE"]==$_SESSION["ID"]){
                                        echo("<td> oui </td>");
                                    }else{
                                        echo("<td> non </td>");
                                    }
                                    echo("</tr>");
                                }
                                echo("</tbody>
                                    </table>");  
                                //fermeture de la base
                                $stmt->closeCursor();
                                break;
                            case "AfficherDetails":
                                //connexion à la base de données
                                define('USER',"root");
                                define('PASSWORD',"");
                                define('SERVER',"localhost");
                                define('BASE',"cli_com");
                                
                                function connect_bd(){
                                
                                    $dsn="mysql:dbname=".BASE.";host=".SERVER;
                                    
                                    try{
                                        $connexion=new PDO($dsn,USER,PASSWORD);
                                    }catch(PDOException $e){
                                        printf("echec de la connexion : %s\n", $e->getMessage());
                                        exit();
                                    }
                                    return $connexion;
                                
                                }
                                
                                $connexion=connect_bd();
                                //préparation de l'instruction
                                $sql="SELECT *
                                      FROM CUISINIER
                                      WHERE ID=:id";
                                $stmt=$connexion->prepare($sql);
                                //ajout du paramètre id
                                $stmt->bindParam(':id',$_SESSION["ID"]);
                                //exécution de l'instruction
                                $stmt->execute();
                                //affichage du tableau de résultat
                                echo("<table>
                                        <thead>
                                            <tr>
                                                <th colspan=\"4\">Détails de votre compte</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>ID</td>
                                                <td>Nom</td>
                                                <td>Mot de passe</td>
                                                <td>Statue</td>
                                            </tr>");
                                while($res=$stmt->fetch(PDO::FETCH_ASSOC)){
                                    echo("<tr>
                                            <td>".$res["ID"]."</td>
                                            <td>".$res["NOM"]."</td>
                                            <td>".$res["MDP"]."</td>
                                            <td>".$res["STATUE"]."</td>
                                         </tr>");
                                }
                                echo("</tbody>
                                    </table>");  
                                //fermeture de la base
                                $stmt->closeCursor();
                                break;
                            case "AjoutRecettes":
                                //création du formulaire d'ajout de recette
                                echo("<!--formulaire d'ajout de plat-->
                                        <form action=\"#\" method=\"post\" id=\"AJPLAT\" name=\"AjPlat\">
                                            <!--Label de NomPlat-->
                                            <label for=\"NomPlat\">Nom du plat	:</label><br/>
                                            <!--input de NomPlat-->
                                            <input type=\"text\" id=\"IDNOMPLAT\" name=\"NomPlat\" size=\"40\" placeholder=\"Nom de votre plat en 40 lettres max\" required /><br/>
                                            <!--Place des érreurs lié à NomPlat-->
                                            <span id=\"SpanErreurNomPlat\"></span><br/>
                                            <input type=\"button\" value=\"Valider\" id=\"BOUTONAJPLAT\" name=\"boutonajplat\" onclick=\"ValideInserPlat()\" /><br/>
                                        </form>");
                                break;
                            case "AjoutRepas":
                                //connexion à la base de données
                                define('USER',"root");
                                define('PASSWORD',"");
                                define('SERVER',"localhost");
                                define('BASE',"cli_com");
                                
                                function connect_bd(){
                                
                                    $dsn="mysql:dbname=".BASE.";host=".SERVER;
                                    
                                    try{
                                        $connexion=new PDO($dsn,USER,PASSWORD);
                                    }catch(PDOException $e){
                                        printf("echec de la connexion : %s\n", $e->getMessage());
                                        exit();
                                    }
                                    return $connexion;
                                
                                }
                                
                                $connexion=connect_bd();
                                //préparation de l'instruction
                                $sql="SELECT IDPLAT, NOMPLAT
                                      FROM PLAT";
                                $stmt=$connexion->prepare($sql);
                                //ajout du paramètre id
                                $stmt->bindParam(':id',$_SESSION["ID"]);
                                //exécution de l'instruction
                                $stmt->execute();
                                //création du formulaire d'ajout de repas
                                echo("<!--formulaire d'ajout de repas-->
                                        <form action=\"#\" method=\"post\" id=\"AJREPAS\" name=\"AjRepas\">
                                            <!--Label de PlatChoisi-->
                                            <p>Veuillez choisir un plat	:</p>
                                            <select name=\"PlatChoisi\">");
                                while($res=$stmt->fetch(PDO::FETCH_ASSOC)){
                                    echo("<option value=".$res["IDPLAT"].">".$res["NOMPLAT"]."</option>");
                                }
                                echo(" </select><br/>
                                      <label for=\"DateRepas\">Date du repas:</label><br/>
                                      <input type=\"date\" id=\"IDDATEREPAS\" name=\"DateRepas\" value=".date("Y-m-d")."><br/>
                                      <input type=\"submit\" value=\"Valider\" id=\"BOUTONAJREPAS\" name=\"boutonajrepas\" /><br/>
                                    </form>");
                                //fermeture de la base
                                $stmt->closeCursor();
                                break;
                            case "SupRecettes":
                                //connexion à la base de données
                                define('USER',"root");
                                define('PASSWORD',"");
                                define('SERVER',"localhost");
                                define('BASE',"cli_com");
                                
                                function connect_bd(){
                                
                                    $dsn="mysql:dbname=".BASE.";host=".SERVER;
                                    
                                    try{
                                        $connexion=new PDO($dsn,USER,PASSWORD);
                                    }catch(PDOException $e){
                                        printf("echec de la connexion : %s\n", $e->getMessage());
                                        exit();
                                    }
                                    return $connexion;
                                
                                }
                                
                                $connexion=connect_bd();
                                //préparation de l'instruction
                                $sql="SELECT * FROM PLAT WHERE ID=:id";
                                $stmt=$connexion->prepare($sql);
                                //ajout du paramètre id
                                $stmt->bindParam(':id',$_SESSION["ID"]);
                                //exécution de l'instruction
                                $stmt->execute();
                                //création du formulaire de suppresion de recette
                                echo("<!--formulaire de suppresion de recette-->
                                        <form action=\"#\" method=\"post\" id=\"SUPRECETTE\" name=\"SupRecette\">
                                            <!--Label de RecetteChoisi-->
                                            <p>Veuillez choisir un repas	:</p>
                                            <select name=\"RecetteChoisi\">");
                                while($res=$stmt->fetch(PDO::FETCH_ASSOC)){
                                    echo("<option value=".$res["IDPLAT"].">".$res["IDPLAT"]." ".$res["NOMPLAT"]."</option>");
                                }
                                echo(" </select><br/>
                                      <input type=\"submit\" value=\"Valider\" id=\"BOUTONSUPRECETTE\" name=\"boutonsuprecette\" /><br/>
                                    </form>");
                                //fermeture de la base
                                $stmt->closeCursor();
                                break;
                            case "SupRepas":
                                //connexion à la base de données
                                define('USER',"root");
                                define('PASSWORD',"");
                                define('SERVER',"localhost");
                                define('BASE',"cli_com");
                                
                                function connect_bd(){
                                
                                    $dsn="mysql:dbname=".BASE.";host=".SERVER;
                                    
                                    try{
                                        $connexion=new PDO($dsn,USER,PASSWORD);
                                    }catch(PDOException $e){
                                        printf("echec de la connexion : %s\n", $e->getMessage());
                                        exit();
                                    }
                                    return $connexion;
                                
                                }
                                
                                $connexion=connect_bd();
                                //préparation de l'instruction
                                $sql="SELECT REPAS.IDREPAS as NUM, PLAT.NOMPLAT as PLATC, REPAS.DATEREPAS as DATER
                                      FROM REPAS
                                      INNER JOIN PLAT ON REPAS.IDPLAT = PLAT.IDPLAT
                                      WHERE REPAS.ID=:id";
                                $stmt=$connexion->prepare($sql);
                                //ajout du paramètre id
                                $stmt->bindParam(':id',$_SESSION["ID"]);
                                //exécution de l'instruction
                                $stmt->execute();
                                //création du formulaire de supression de repas
                                echo("<!--formulaire de suppresion de repas-->
                                        <form action=\"#\" method=\"post\" id=\"SUPREPAS\" name=\"SupRepas\">
                                            <!--Label de RepasChoisi-->
                                            <p>Veuillez choisir un repas	:</p>
                                            <select name=\"RepasChoisi\">");
                                while($res=$stmt->fetch(PDO::FETCH_ASSOC)){
                                    echo("<option value=".$res["NUM"].">".$res["NUM"]." ".$res["PLATC"]." ".$res["DATER"]."</option>");
                                }
                                echo(" </select><br/>
                                      <input type=\"submit\" value=\"Valider\" id=\"BOUTONSUPREPAS\" name=\"boutonsuprepas\" /><br/>
                                    </form>");
                                //fermeture de la base
                                $stmt->closeCursor();
                                break;
                            case "Deconnexion":
                                //affichage du message de déconnexion
                                echo("Vous vous êtes déconnecté");
                                //déconnexion de la session
                                session_destroy();
                                //reload de la page
                                header("Refresh:0");
                                break;
                        }
                    }
                    
                ?>
            </p>
        </fieldset>
        
	</body>

<!--footer-->
	<footer id="FOOTER" name="footer">
        <!--créateur de la page-->
        <p>Anthony Lamour</p>
        <!--jeu ayant servit d'inspiration pour ce site-->
        <p>Jeu de référence Tales Of Berseria</p>
	</footer>

</html>