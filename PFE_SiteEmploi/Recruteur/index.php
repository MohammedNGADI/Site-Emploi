<?php
    session_start();
    if(isset($_SESSION['email'])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="../SiteImages/administrateur/logoSiteEmploi2.jpg" type="image/jpg">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <title>EMPNEXUS-Recruteur</title>
    <link rel="stylesheet" href="../CSS/Recruteur/Recruteur.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js">WD</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.0/main.min.js"></script>
    
</head>
<body>
        
        
        <?php
            include './enTete.php';
        ?>
        
        <div class="milieuCentre" id="milieuCentre">
            <div id="carrousel">
                <div id="container">

                </div>
                <img src="./bouton.png" alt="" srcset="" class="boutoncarrousel" id="d">
                <img src="./bouton.png" alt="" srcset="" class="boutoncarrousel" id="g">
            </div>
        </div>

        <?php include '../footer/footer3.php'; ?>

    

    
    
    <script src="Recruteur.js"></script>
    <?php
    }
    ?>
</body>
</html>
