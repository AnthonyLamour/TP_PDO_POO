<?php
    
    //début de session
    session_start();
    
    //si l'utilisateur n'est pas connecté 
    if(!isset($_POST["Login"])){
        //définition d'une équipe par défaut
        $_SESSION["Acount"]="none";
    }
    //sinon
    else
    {
        //connexion à la base de données
        define('USER',"root");
        define('PASSWD',"");
        define('SERVER',"localhost");
        define('BASE',"cli_com");
        
        function connect_bd(){
        
            $dsn="mysql:dbname=".BASE.";host=".SERVER;
            
            try{
                $connexion=new PDO($dsn,USER,PASSWD);
            }catch(PDOException $e){
                printf("echec de la connexion : %s\n", $e->getMessage());
                exit();
            }
            return $connexion;
        
        }
        
        $connexion=connect_bd();
        
        $sql="SELECT * FROM CUISINIER";
        
        if(!$connexion->query($sql)){
            echo("Problème d'accès au clients.");
        }else{
            $Trouver=False;
            foreach($connexion->query($sql) as $row)
                if($_POST["Login"]==$row['NOM']){
                    if($_POST["Password"]==$row['MDP']){
                        $_SESSION["ID"]=$row['ID'];
                        $_SESSION["Acount"]=$_POST['Login'];
                        $_SESSION["MDP"]=$_POST['Password'];
                        $_SESSION["STATUE"]=$row['STATUE'];
                        $Trouver=True;
                    }else{
                        echo("Mauvais mot de passe.");
                    }
                }
            if(!$Trouver){
                echo("echec de la connexion.");
            }
        }
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
            <!--Label de Password-->
            <label for="Password">Password	:</label><br/>
            <!--input de Password-->
            <input type="password" id="IDPASSWORD" name="Password" size="20" placeholder="Votre password" required /><br/>
            <input type="submit" value="Valider" id="BOUTONLOG" name="boutonlog" /><br/>
        </form>

        <!--titre de la page-->
        <h1>Bienvenue cuisinier !</h1>
        
	</body>

<!--footer-->
	<footer id="FOOTER" name="footer">
        <p>Anthony Lamour</p>
	</footer>

</html>