<?php 
        include('enTete.php') ; 
        include ('bareDeNavigationGauche.html'); 
    ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .message{
            position: relative;
            top: 70px;
            width: 100%;
        }
    </style>
</head>
<body>
    
    <div class="message">
        <?php include('testBoiteDesMessages.php') ; ?>
    </div>
    <?php
    include('../footer/footer.php') ;
    ?>
</body>

</html>
