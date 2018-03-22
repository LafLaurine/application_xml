<!doctype html>

<?php
if (session_status() == PHP_SESSION_NONE) {
session_start();
}
?>

<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>CVTEC</title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/connexion.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <!-- <link rel="stylesheet" href="../dist/css/swiper.min.css"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="script/app.js"></script>
    <script src="script/connexion.js"></script>
</head>
<body>
    <!--        DEBUT HEADER-->
    <div class="header">
        <div class="connexion">
            <div class="mon-compte">
                <span>Mon compte</span>
            </div>
    
        </div>
        <div class="flex">
            <div class="logo">
            </div>
            <div class="hamburger">
            </div>
            <div class="nav">
                <a href="#banniere" class="menu-item">STAGE</a>
                <a href="#apropos" class="menu-item">ALTERNANCE</a>
                <a href="#skills" class="menu-item">EMPLOI</a>
                <?php     
            if (!isset($_SESSION['email_etu'])) {?>
           
                <div>
                <button type="text" class="button buttonBlue openb">CONNEXION
                    <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
                </button>
                </div>

                <div class="login-modal-overlay">
                
                <div class="login-modal">
                    <h1>Connexion</h1>
                   
                    <form  action="./login/login_etu.php" method="post">
                    <div class="group">
                        <input type="text" name="email_etu" required></span><span class="bar"></span>
                        <label>E-mail</label>
                    </div>
                    <div class="group">
                        <input type="password" name="mdp_etu" required></span><span class="bar"></span>
                        <label>Mot de passe</label>
                    </div>
                    <button type="submit" class="button buttonBlue">Connexion
                        <div class="ripples buttonRipples">
                        <span class="ripplesCircle"></span>
                        </div>
                    </button>
                </form>
                </div>

                </div>
            <?php } 
            
            else {?>
                <a href="./login/logout_etu.php" class="menu-item">DÉCONNEXION</a>
                <a href="./form_cv.php" class="menu-item">CV</a>
            <?php }?>
            </div>
        </div>
    </div>


    <!--        FIN HEADER-->

    <!--        DEBUT BANIERE-->
    <?php     if (!isset($_SESSION['email_etu'])) {?>
    <section class="home">
        <div class="creer-compte">
            <div class="creer-mon-compte">
                <h1>Créez votre profil et ajoutez votre CV</h1>

                <div>
                    <button id="btn-inscription-candidat">Je crée mon compte</button>
                </div>
            </div>
           
        <div class="form-candidat form">
        <div class='close'></div>
            <form action="inscription/inscription_etu.php" class="formulaire" method="post">
                <input id="nom" type="text" name="nom_etu" placeholder="Nom">    
                <input id="prenom" type="text" name="prenom_etu" placeholder="Prénom">  
                <input id="passwd" name="mdp_etu" placeholder="Mot de passe" pattern=".{6,}" required="" title="Au moins 6 caractères" type="password">
                <input id="passwdconf" name="passwordconf" placeholder="Confirmer votre mot de passe" required="" type="password">
                <input id="mail" name="email_etu" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required="" type="email">  
                <input id="telephone" name="telephone_etu" placeholder="Numéro de téléphone" required="" type="text">  
                <input name="submit" type="submit" value="S 'inscrire" class="sub" style="float:right;">
            </form>
        </div>
                
        <?php if(@$_GET['action'] == 'success' ) {
                echo "<h3> Votre compte a bien été enregistré, vous pouvez vous connecter </h3>";
               }

               if(@$_GET['action'] == 'fail' ) {
                echo "<h3> Mauvais mot de passe </h3>";
               }

               if(@$_GET['action'] == 'wrongMDP' ) {
                echo "<h3> Les mots de passe ne correspondent pas </h3>";
               }

               if(@$_GET['action'] == 'user' ) {
                echo "<h3> Utilisateur non inscrit </h3";
               }

               if(@$_GET['action'] == 'empty' ) {
                echo "<h3> Champs vides </h3>";
               }
            }
            
            else {?>
              <section class="banniere" id="banniere">
            <div class="recherche">
                <h1>Trouvez votre Stage, Alternance ou Emploi</h1>
                <div class="input-recherche">
                    <input type="text" placeholder="Quoi ?">
                    <input type="text" placeholder="Où ?">
                    <input style="width:20%;" type="submit" value="Rechercher">
                </div>
            </div>
            </section>

            <?php }?>
            
       
        
    </div>
    </section>
    

    <!--        FIN BANIERE-->

    <!-- DEBUT HOME -->

    <!-- DEBUT FORMULAIRE -->

    <!-- FIN HOME -->

    <footer></footer>
    <!--        FIN FOOTER-->



</body>

</html>