<?php
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>EasyRecrute</title>
  <link rel="stylesheet" href="view/css/custom.css">
  <script src="view/js/custom.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <style>
    .poppins-thin {
    font-family: "Poppins", sans-serif;
    font-weight: 100;
    font-style: normal;
  }
  
  .poppins-extralight {
    font-family: "Poppins", sans-serif;
    font-weight: 200;
    font-style: normal;
  }
  
  .poppins-light {
    font-family: "Poppins", sans-serif;
    font-weight: 300;
    font-style: normal;
  }
  
  .poppins-regular {
    font-family: "Poppins", sans-serif;
    font-weight: 400;
    font-style: normal;
  }
  
  .poppins-medium {
    font-family: "Poppins", sans-serif;
    font-weight: 500;
    font-style: normal;
  }
  
  .poppins-semibold {
    font-family: "Poppins", sans-serif;
    font-weight: 600;
    font-style: normal;
  }
  
  .poppins-bold {
    font-family: "Poppins", sans-serif;
    font-weight: 700;
    font-style: normal;
  }
  
  .poppins-extrabold {
    font-family: "Poppins", sans-serif;
    font-weight: 800;
    font-style: normal;
  }
  
  .poppins-black {
    font-family: "Poppins", sans-serif;
    font-weight: 900;
    font-style: normal;
  }
  
  .poppins-thin-italic {
    font-family: "Poppins", sans-serif;
    font-weight: 100;
    font-style: italic;
  }
  
  .poppins-extralight-italic {
    font-family: "Poppins", sans-serif;
    font-weight: 200;
    font-style: italic;
  }
  
  .poppins-light-italic {
    font-family: "Poppins", sans-serif;
    font-weight: 300;
    font-style: italic;
  }
  
  .poppins-regular-italic {
    font-family: "Poppins", sans-serif;
    font-weight: 400;
    font-style: italic;
  }
  
  .poppins-medium-italic {
    font-family: "Poppins", sans-serif;
    font-weight: 500;
    font-style: italic;
  }
  
  .poppins-semibold-italic {
    font-family: "Poppins", sans-serif;
    font-weight: 600;
    font-style: italic;
  }
  
  .poppins-bold-italic {
    font-family: "Poppins", sans-serif;
    font-weight: 700;
    font-style: italic;
  }
  
  .poppins-extrabold-italic {
    font-family: "Poppins", sans-serif;
    font-weight: 800;
    font-style: italic;
  }
  
  .poppins-black-italic {
    font-family: "Poppins", sans-serif;
    font-weight: 900;
    font-style: italic;
  }
  
.btn-recrut-listingpage{
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: #ee3a87;
  color: #ffffff;
  border-radius: 30px;
  padding: 5px 30px;
  font-size: 20px;
  font-family: "Poppins", sans-serif;
  text-decoration: none;
  width: max-content;
  margin: 0 auto;
}
.link-emploi a {
  text-decoration: unset;
}
.btn-recrut{
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #ee3a87;
    color: #ffffff;
    border-radius: 30px;
    padding: 5px 30px;
    font-size: 20px;
    font-family: "Poppins", sans-serif;
    text-decoration: none;
    border: unset;
}
.btn-inscri{
    display: flex;
    flex-direction: column;
    align-items: center;
    color: #000;
    text-decoration: none;
    font-size: 14px;
    font-family: "Poppins", sans-serif;
}
.header-style{
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 14px;
    font-family: "Poppins", sans-serif;
}
.links-header{
    display: flex;
    column-gap: 30px;
    align-items: center;
}
.btn-compte{
    display: flex;
    flex-direction: column;
    align-items: center;
    color: #000;
    text-decoration: none;
    font-size: 14px;
    font-family: "Poppins", sans-serif;
}
.block-intro{
    background-image:url("view/img/slider-home.jpg");
    display: block;
    width: 100%;
    height: 300px;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    position: relative;
    margin-bottom: 20px;
    
}
.desc-into{
    position: absolute;
    top: 30%;
    left: 10%;

}
.desc-style{
    font-family: "Poppins", sans-serif;
    font-weight: bold;
    font-size: 20px;
    color: #ffffff;
}
.desc-style span{
    font-weight: 400;
}
.overlay{
    display: block;
    width: 100%;
    height: 100%;
    background-color: #000;
    opacity: .7;
}
.btn-decouvrir{
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #FFF;
    color: #264395;
    border-radius: 30px;
    padding: 5px 30px;
    font-size: 20px;
    font-family: "Poppins", sans-serif;
    text-decoration: none;
    width: max-content;
    text-transform: uppercase;
}
.header-block-style{
    font-size: 30px;
    font-family: "Poppins", sans-serif;
    text-align: center;
    font-weight: 500;
    text-transform: uppercase;
    color: #2c4395;
}
.link-emploi, .link-condidat{
    border: 1px solid #2c4395;
    padding: 10px;
    text-decoration: none;
    width: 100%;
    height: max-content;
    border-radius: 30px;
}
.link-emploi{
  border-radius: 30px;
  display: flex;
  flex-direction: column;
  margin-top: 20px;
}
.titre-link-emploi{
    text-transform: uppercase;
    color: #2c4395;
    font-family: "Poppins", sans-serif;
    font-size: 18px;
}
.desc-link-emploi{
    color: #000;
    font-family: "Poppins", sans-serif;
    font-size: 14px;
}

.links-emploi{
  display: flex;
    flex-direction: row;
    row-gap: 20px;
    flex-wrap: wrap;
}
.btn-decouvrir-pink{
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #ee3a87;
    color: #ffffff;
    border-radius: 30px;
    padding: 5px 30px;
    font-size: 20px;
    font-family: "Poppins", sans-serif;
    text-decoration: none;
    width: max-content;
    text-transform: uppercase;
    margin-left: auto;
    margin-top: 30px;
    margin-bottom: 30px;
    border: unset;

}
.block-intro-2{
    background-image:url("../img/recrute-slide.jpg");
    display: block;
    width: 100%;
    height: 300px;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    position: relative;
}
.desc-into-2{
    position: absolute;
    top: 50%; 
    left: 50%; 
    transform: translate(-50%, -50%);
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
}
.desc-style-2{
    font-family: "Poppins", sans-serif;
    font-weight: 500;
    font-size: 27px;
    color: #ffffff;
    text-transform: uppercase;
}
.footer-style {
    background: #264395;
  
}
.titre-footer {
    text-transform: uppercase;
    color: #fff;
    font-family: "Poppins", sans-serif;
    font-weight: 500;
    font-size: 18px;
}
.block-links-style {
    display: flex;
    flex-direction: column;
    row-gap: 30px;
}
.link-footer{
    color: #fff;
    font-family: "Poppins", sans-serif;
    text-decoration: none;
    font-size: 12px;
}
.footer-container {
    max-width: 82%;
    display: flex;
    width: 100%;
    justify-content: space-between;
    margin: 30px auto;
}
.block-links-style-rs{
    display: flex;
    column-gap: 10px;
}
.copy-right{
    background-color: #fff;
    text-align: center;
}
.copy-right p{
    text-transform: uppercase;
    color: #264395;
    font-family: "Poppins", sans-serif;
    font-size: 14px;
    padding: 20px;

}
.link-condidat {
  display: block;
  min-width: 320px;
  max-width: 320px;
  width: 100%;
}

.titre-link-condidat {
  margin: 0;
  font-family: "Poppins", sans-serif;
  text-transform: uppercase;
  font-size: 14px;
  color: #000;
}
.desc-link-condidat{
  font-family: "Poppins", sans-serif;
  font-size: 11px;
  color: #000;
}
.links-condidat{
  display: flex;
  flex-wrap: wrap;
  column-gap: 10px;
  row-gap: 30px;

}
.condidat-element {
  display: flex;
  align-items: center;
  column-gap: 30px;
}
.btn-info-plus {
  font-size: 11px;
  margin-left: auto;
  display: block;
  width: max-content;
  color: #000;
  text-decoration: none;
  margin-right: 15px;
}
.block-listing-offres{
  flex-direction: column;
  max-width: 700px;
  width: 100%;
  justify-content: center;
  margin: 0 auto;
}
.formulaire-recruter form {
  display: flex;
  flex-direction: column;
  max-width: 700px;
  width: 100%;
  justify-content: center;
  margin: 0 auto;
}
.formulaire-recruter form input, .formulaire-recruter form textarea {
  border-radius: 15px;
  height: 45px;
  border: 1px solid #264395;
  margin-bottom: 15px;
}
.formulaire-recruter .btn-recrut{
  border: unset;
  max-width: 300px;
  margin: 15px auto;
}
.formulaire-recruter form input::placeholder, .formulaire-recruter form textarea::placeholder{
  text-transform: uppercase;
  color: #264395;
  font-family: "Poppins", sans-serif;
  font-size: 14px;
  padding-left: 15px;
} 
.custom-select select {
 
  font-family: "Poppins", sans-serif;
  border-radius: 15px;
  height: 45px;
  width: 100%;
  text-transform: uppercase;
  color: #264395;
  font-family: "Poppins", sans-serif;
  font-size: 14px;
  padding: 0 15px;
}
p.desc-link-emploi {
  margin: 5px;
}
.title-joboffer{
  text-align: center;
  color: #ee3a87;
}
.style-form-input {
  display: flex;
    align-items: center;
    column-gap: 50px;
    margin-bottom: 30px;
    justify-content: space-between;
}
.style-form-input select {
    border-radius: 15px;
    text-align: center;
    border: 1px solid #264395;
    max-width: 250px;
    width: 100%;
    height: 37px;
}
.style-form-input input {
    border-radius: 15px;
    text-align: center;
    border: 1px solid #264395;
    max-width: 250px;
    width: 100%;
    height: 37px;
}
.joboffer-form {
    max-width: 400px;
    width: 100%;
    margin: 10px auto;
}
  </style>
</head>
<body>
    <div class="header-style">
        <div class="logo-header">
          <a href="index.php">
        <img src="view/img/EasyRecruit-logo.svg" alt="logo" width="200" height="90"/>
        <a>
        </div>
        <div class="links-header">
            <a href="index.php?controller=recruiter&action=add" class="btn-recrut">Espace Recruteur</a>
            <div>
                <a href="index.php?controller=joboffer&action=add" class="btn-recrut-listingpage">Ajouter une nouvelle offre</a>
            </div>

            <a href="#" class="btn-inscri"> <img src="view/img/icon-inscription.svg" alt="Inscription" width="30" height="30">Inscription</a>
            <a href="index.php?controller=Jobseeker&action=mes_condidatures" class="btn-compte"> 
              <img src="view/img/icon-compte.svg" alt="mon compte" width="30" height="30"> Mon compte
            </a>
         </div>
</div>