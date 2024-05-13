<?php
session_start(); // Start session to access session variables



  
?>



<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>EasyRecrute</title>
  <link rel="stylesheet" href="../../assets/css/home.css">

  <script src="../../assets/js/home.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>



<body>
   

    <header class="header-style">
        <div class="logo-header">
        <img src="../../assets/images/home/EasyRecruit-logo.svg" alt="logo" width="200" height="90"/>
        </div>
        <div >
            <h1 class="wlcm"> <?php
    
                if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
                    echo "Welcome back, " .   $_SESSION['username'] . "!";
                    // You can also use role-based features here
                } 
                ?></h1>
           
        </div>
        <div class="links-header">


            <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
            <?php if ($_SESSION['role'] === 'job_seeker'): ?>
                <a href="../../index.php?url=Espace_perso" class="btn-recrut">Espace Personnel</a>
            <?php elseif ($_SESSION['role'] === 'employer'): ?>
                <a href="../../index.php?url=Espace_perso" class="btn-recrut">Espace Recruteur</a>
            <?php elseif ($_SESSION['role'] === 'admin'): ?>
                <a href="../../index.php?url=Espace_perso" class="btn-recrut">Espace Admin</a>
            <?php endif; ?>
        <?php endif; ?>

    

        <a href="../add_front_joboffer.php" class="btn-recrut">Ajouter une nouvelle offre</a>
            <a href="../../index.php?url=register" class="btn-inscri"> <img src="../../assets/images/home/icon-inscription.svg" alt="Inscription" width="30" height="30">Inscription</a>
            <a href="../../index.php?url=login" class="btn-compte"> <img src="../../assets/images/home/icon-compte.svg" alt="mon compte" width="30" height="30"> Login</a>
            <a href="../../index.php?url=login" class="btn-compte"> <img src="../../assets/images/home/icon-compte.svg" alt="mon compte" width="30" height="30"> Mon compte</a>
           
            <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
            <a href="../../index.php?url=logout" class="btn-logout">logout</a>

            <?php endif; ?>

         </div>
    </header>
    <div class="block-intro">
        <div class="overlay">
        
        <div class="desc-into">
                   
            <h1 class="desc-style">Forgez votre avenir, <br>
                <span> trouvez votre voie professionnelle ici !</span> </h1>
                <a href="../../index.php?url=login" class="btn-decouvrir">découvrir plus</a>

                <h1 class="desc-style">Forum <br>
                    <span> Rejoignez notre forum!</span> </h1>
                    <a href="../FrontOffice/AfficherPosts.php" class="btn-decouvrir">découvrir plus</a>
        </div>
    </div>
    </div>
    <div class="block-emploi">
        <h2 class="header-block-style">Dernières Offres d'emploi</h2>
        <div class="element-block-emploi">
            <img src="../../assets/images/home/we-are-hiring.png"  alt="we-are-hiring" width="300">
            <div class="links-emploi">
            <a href="#" class="link-emploi">
                <h3 class="titre-link-emploi">Stage PFE pré embauche webdesigner télétravail SEO UX/UI</h3>
                <p class="desc-link-emploi">Nous recherchons un stagiaire Concepteur UX/UI créatif et motivé pour rejoindre notre équipe dynamique. En tant que...</p>
            </a>
            <a href="#" class="link-emploi">
                <h3 class="titre-link-emploi">Stage PFE pré embauche webdesigner télétravail SEO UX/UI</h3>
                <p class="desc-link-emploi">Nous recherchons un stagiaire Concepteur UX/UI créatif et motivé pour rejoindre notre équipe dynamique. En tant que...</p>
            </a>
            <a href="#" class="link-emploi">
                <h3 class="titre-link-emploi">Stage PFE pré embauche webdesigner télétravail SEO UX/UI</h3>
                <p class="desc-link-emploi">Nous recherchons un stagiaire Concepteur UX/UI créatif et motivé pour rejoindre notre équipe dynamique. En tant que...</p>
            </a>
            <a href="#" class="link-emploi">
                <h3 class="titre-link-emploi">Stage PFE pré embauche webdesigner télétravail SEO UX/UI</h3>
                <p class="desc-link-emploi">Nous recherchons un stagiaire Concepteur UX/UI créatif et motivé pour rejoindre notre équipe dynamique. En tant que...</p>
            </a>
        </div>
        </div>
        <a href="#" class="btn-decouvrir-pink">découvrir plus</a>
    </div>

    <div class="block-intro-2">
        <div class="overlay">
        
        <div class="desc-into-2">
            <h2 class="desc-style-2">prêt à embaucher des cadres talentueux <br>
                en notre compagnie 
              </h2>
               <a href="#" class="btn-decouvrir">découvrir plus</a>
        </div>
    </div>
    <!-- à faire -->
    <div class="block-condidats">
        <h2 class="header-block-style">les meilleurs candidats</h2>
        <div class="element-block-condidat">
            <img src="../../assets/images/home/condidat.png"  alt="we-are-hiring" width="300">
            <div class="links-condidat">
                    <div class="link-condidat">
                        <div class="content-link-condidat">
                            <div class="condidat-element">
                                <img src="../../assets/images/home/icon-condidat.svg" alt="condidat" width="60">
                                <div class="content-condidat">
                                    <h3 class="titre-link-condidat">sofia gafsi</h3>
                                    <p class="desc-link-condidat">Développeur Full Stack</p>
                                </div>
                            </div>
                            <div class="link-condidat-block">
                                <a href="#" class="btn-info-plus"> Plus  d'info ></a>
                            </div>
                        </div>
                    </div>
                    <div class="link-condidat">
                        <div class="content-link-condidat">
                            <div class="condidat-element">
                                <img src="../../assets/images/home/icon-condidat.svg" alt="condidat" width="60">
                                <div class="content-condidat">
                                    <h3 class="titre-link-condidat">sofia gafsi</h3>
                                    <p class="desc-link-condidat">Développeur Full Stack</p>
                                </div>
                            </div>
                            <div class="link-condidat-block">
                                <a href="#" class="btn-info-plus"> Plus  d'info ></a>
                            </div>
                        </div>
                    </div>
                    <div class="link-condidat">
                        <div class="content-link-condidat">
                            <div class="condidat-element">
                                <img src="../../assets/images/home/icon-condidat.svg" alt="condidat" width="60">
                                <div class="content-condidat">
                                    <h3 class="titre-link-condidat">sofia gafsi</h3>
                                    <p class="desc-link-condidat">Développeur Full Stack</p>
                                </div>
                            </div>
                            <div class="link-condidat-block">
                                <a href="#" class="btn-info-plus"> Plus  d'info ></a>
                            </div>
                        </div>
                    </div>
                    <div class="link-condidat">
                        <div class="content-link-condidat">
                            <div class="condidat-element">
                                <img src="../../assets/images/home/icon-condidat.svg" alt="condidat" width="60">
                                <div class="content-condidat">
                                    <h3 class="titre-link-condidat">sofia gafsi</h3>
                                    <p class="desc-link-condidat">Développeur Full Stack</p>
                                </div>
                            </div>
                            <div class="link-condidat-block">
                                <a href="#" class="btn-info-plus"> Plus  d'info ></a>
                            </div>
                        </div>
                    </div>
                    <div class="link-condidat">
                        <div class="content-link-condidat">
                            <div class="condidat-element">
                                <img src="../../assets/images/home/icon-condidat.svg" alt="condidat" width="60">
                                <div class="content-condidat">
                                    <h3 class="titre-link-condidat">sofia gafsi</h3>
                                    <p class="desc-link-condidat">Développeur Full Stack</p>
                                </div>
                            </div>
                            <div class="link-condidat-block">
                                <a href="#" class="btn-info-plus"> Plus  d'info ></a>
                            </div>
                        </div>
                    </div>
                    <div class="link-condidat">
                        <div class="content-link-condidat">
                            <div class="condidat-element">
                                <img src="../../assets/images/home/icon-condidat.svg" alt="condidat" width="60">
                                <div class="content-condidat">
                                    <h3 class="titre-link-condidat">sofia gafsi</h3>
                                    <p class="desc-link-condidat">Développeur Full Stack</p>
                                </div>
                            </div>
                            <div class="link-condidat-block">
                                <a href="#" class="btn-info-plus"> Plus  d'info ></a>
                            </div>
                        </div>
                    </div>
                    <div class="link-condidat">
                        <div class="content-link-condidat">
                            <div class="condidat-element">
                                <img src="../../assets/images/home/icon-condidat.svg" alt="condidat" width="60">
                                <div class="content-condidat">
                                    <h3 class="titre-link-condidat">sofia gafsi</h3>
                                    <p class="desc-link-condidat">Développeur Full Stack</p>
                                </div>
                            </div>
                            <div class="link-condidat-block">
                                <a href="#" class="btn-info-plus"> Plus  d'info ></a>
                            </div>
                        </div>
                    </div>
                    <div class="link-condidat">
                        <div class="content-link-condidat">
                            <div class="condidat-element">
                                <img src="../../assets/images/home/icon-condidat.svg" alt="condidat" width="60">
                                <div class="content-condidat">
                                    <h3 class="titre-link-condidat">sofia gafsi</h3>
                                    <p class="desc-link-condidat">Développeur Full Stack</p>
                                </div>
                            </div>
                            <div class="link-condidat-block">
                                <a href="#" class="btn-info-plus"> Plus  d'info ></a>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        
        <a href="#" class="btn-decouvrir-pink">découvrir plus</a>
    </div>
    <!-- à faire -->
    <footer class="footer-style">
        <div class="footer-container">
        <img src="../../assets/images/home/logo-footer-blanc.svg" alt="logo footer" width="300">
        <div class="links-footer">
            <h3 class="titre-footer">liens rapide</h3>
            <div class="block-links-style">
                <a href="#" class="link-footer">Inscription</a>
                <a href="#" class="link-footer">Espace Recruteur</a>
                <a href="#" class="link-footer">Mon Compte</a>
                <a href="http://localhost/EASYRECRUIT WEB/DASHBOARD/views/Traitement.php" class="link-footer">Nous Contactez</a>
    
            </div>
     

        </div>
        <div class="links-footer-rs">
            <h3 class="titre-footer">SUIVEZ-NOUS</h3>
            <div class="block-links-style-rs">
                <a href="#" class="link-footer-rs"><img src="../../assets/images/home/fb.png" alt="facebook" width="30"></a>
                <a href="#" class="link-footer-rs"> <img src="../../assets/images/home/insta.png" alt="facebook" width="30"></a>
                <a href="#" class="link-footer-rs"><img src="../../assets/images/home/linkidin.png" alt="linkidin" width="30"></a>
                <a href="#" class="link-footer-rs"><img src="../../assets/images/home/twitter.png" alt="linkidin" width="30"></a>
             </div>

        </div>
    </div>
    <div class="copy-right">
        <p>Copyright © 2024 EasyRecruit</p>
    </div>
    </footer>
</body>
</html>