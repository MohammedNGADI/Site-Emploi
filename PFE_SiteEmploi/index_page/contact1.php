<?php session_start(); ?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
    <link rel="icon" href="../SiteImages/administrateur/logoSiteEmploi2.jpg" type="image/jpg">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/index_css/index.css">
    <link rel="stylesheet" href="../CSS/index_css/CSSfooter.css">
    <link rel="stylesheet" href="../CSS/index_css/contact.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>EMPNEXUS-Contactez-nous</title>
    <style>
        section{
            margin-top: 50px;
            margin-bottom: 50px;
        }
        .address-list{
            margin-top : 70px;
            padding-right : 10px ;
        }
        #formulaire{
            margin-top : 40px;
        }

        .messagesuccess {
             
            color: green;
            margin-left :10px;
            font-weight : bold ;
            margin-left: 30px;

           }
           
           #lien{
            margin-left : 140px ;
           }
           #propos{
            margin-left : -90px ;
           }
          
          

        
    </style>

	
</head>


<body class="not-transparent-header">

	<div class="container-wrapper">
V
<header>
        <div class="logo">
            <a href="../INDEX.php">
                <img src="../SiteImages/indeximage/logo1.jpg"   class="logo-image" style="width: 70px; height: auto;">
            </a>
        </div>
        <ul class="menu">
            <li><a href="../INDEX.php#home">Acceuil</a></li>
            <li><a href="listeOffres2.php">Offres</a></li>           
            <li><a href="index2.php">Espace recruteur</a></li>
            <li><a href="contact1.php">Contactez-nous </a></li>
             <li><a href="../INDEX.php#about_us">À propos</a></li>

            
        </ul>
        <a href="../Login/index.php" class="btn-connexion">Connexion</a>

        <div class="responsive-menu"></div>
    </header>



    <section>
    <div class="section sm">
        <div class="container">
            <div class="row">
                <div class="col-sm-5 col-md-4 mb-30">
                   
                    <ul class="address-list">
                        <li>
                            <h5>Adresse</h5>
                            <address> OUJDA,EL MAKDES RUE EL NASSRE NO 10 . </address>
                        </li>
                        <li>
                            <h5>Email</h5><a href="mailto:ngadi6093@gmail.com">ngadi6093@gmail.com</a>
                        </li>
                        <li>
                            <h5>Numéro Téléphone </h5><a href="tel:+233 546 607 474">+233 546 607 474</a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-7 col-md-6 col-md-offset-1 mb-30" id="formulaire">
                     
                     <?php if(isset($_SESSION['success_message']) && !empty($_SESSION['success_message'])): ?>
                    <div class="messagesuccess" role="alert">
                        <?php echo $_SESSION['success_message']; ?>
                    </div>
                    <?php unset($_SESSION['success_message']);  ?>
                    <?php endif; ?>
               
                   

                    <form class="contact-form-wrapper" data-toggle="validator" action="envoyerMessage.php" method="POST" autocomplete="off" >
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="inputName">Nom <span class="font10 text-danger">*</span></label>
                                    <input id="inputName" name="fullname" type="text" class="form-control" data-error="Your name is required" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="inputEmail">Email <span class="font10 text-danger">*</span></label>
                                    <input id="inputEmail" name="email" type="email" class="form-control" data-error="Your email is required and must be a valid email address" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="inputObject">Objet <span class="font10 text-danger">*</span></label>
                                    <input id="inputObject" name="object" type="text" class="form-control" data-error="Subject is required" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="inputMessage">Message <span class="font10 text-danger">*</span></label>
                                    <textarea id="inputMessage" name="message" class="form-control" rows="8" data-minlength="50" data-error="Your message is required and must not less than 50 characters" required></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-sm-12 text-right">
                                <button type="submit" class="btn btn-primary mt-5">Envoyer Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
    include '../footer/footer2.php';
?>

 

<div id="back-to-top">
   <a href="#"><i class="ion-ios-arrow-up"></i></a>
</div>
<script>
    window.addEventListener('scroll', function() {
        var footer = document.querySelector('.footer-wrapper');
        var scrollPosition = window.innerHeight + window.scrollY;

        if (scrollPosition >= document.body.offsetHeight) {
            footer.classList.remove('hidden');
        } else {
            footer.classList.add('hidden');
        }
    });
</script>



</body>

</html>