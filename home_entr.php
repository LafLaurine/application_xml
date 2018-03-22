<!doctype html>

<?php 
session_start();
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
        <div class="flex">
            <div class="logo">
            </div>
            <div class="hamburger">
            </div>
            <div class="nav">
            <?php     if (!isset($_SESSION['email_entr'])) {?>
           
                <div>
                <button type="text" class="button buttonBlue openb">Connexion
                    <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
                </button>
                </div>

                <div class="login-modal-overlay">
                
                <div class="login-modal">
                    <h1>Connexion</h1>
                   
                    <form  action="./login/login_entr.php" method="post">
                    <div class="group">
                        <input type="text" name="email_entr" required></span><span class="bar"></span>
                        <label>E-mail</label>
                    </div>
                    <div class="group">
                        <input type="password" name="mdp_entr" required></span><span class="bar"></span>
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
                <a href="./login/logout_entr.php" class="menu-item">Déconnexion</a>
                <a href="./form_appelOffre.php" class="menu-item">Poster une offre</a>
            <?php }?>
            </div>
        </div>
    </div>
    <!--        FIN HEADER-->

    <!--        DEBUT BANIERE-->
    <?php     if (!isset($_SESSION['email_entr'])) {?>
    <section class="home">
        <div class="creer-compte">
      
            <div class="creer-espace-recruteur">
                <h1>Créez votre espace afin de pouvoir publier une offre</h1>
                <div>
                    <button id="btn-inscription-entreprise">Je crée mon espace recruteur</button>
                </div>
            </div>
        </div>

     

        <!-- DEBUT FORMULAIRE 2 -->
        <div class="form-entreprise form">
        <div class='close'></div>
            <form action="./inscription/inscription_entr.php" class="formulaire" method="post">
                <label for="nom">Nom de l'entreprise</label></td>
                <input id="nom" type="text" name="nom_entr" placeholder="Nom">
                <label for="passwd">Mot de passe*</label></td>
                <input id="passwd" name="mdp_entr" pattern=".{6,}" required="" title="Au moins 6 caractères" type="password">
                <label for="passwdconf">Confirmation du mot de passe*</label>
                <input id="passwdconf" name="passwordconf" required="" type="password">
                <label for="mail">Adresse mail*</label>
                <input id="mail" name="email_entr" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required="" type="email">
                <label for="telephone">telephone</label>
                <input id="telephone" name="telephone_entr" required="" type="text">
                <input name="submit" type="submit" value="S'inscrire" class="sub">
            </form>
        </div>
        <!-- FIN FORMULAIRE 2 -->


                
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
              <div class="derniere-offre">
              <div class="offre"></div>
              <div class="offre"></div>
              <div class="offre"></div>
              <div class="offre"></div>
              <div class="offre"></div>
              <div class="offre"></div>

            <?php }?>
            
    </section>

    <!--        FIN BANIERE-->

    <!-- DEBUT HOME -->

    <!-- DEBUT FORMULAIRE -->

    <!-- FIN HOME -->

    <footer></footer>
    <!--        FIN FOOTER-->



</body>

</html>