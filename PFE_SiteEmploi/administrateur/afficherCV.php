<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../SiteImages/administrateur/logoSiteEmploi2.jpg" type="image/jpg">

    <title>CV</title>
    <style>
        body{
            margin: 0;
        }
        div{
            width: 100%;
            height: 100vh;
            margin: 0;
        }
    </style>
</head>
<body>
    <div>
        <embed src="<?php echo $_SESSION['CVAdministrateur'] ;?>" type="application/pdf" width="100%" height="100%"/>
    </div>
</body>
</html>