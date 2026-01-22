<?php
    include '../connexionBD/connexion.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['register_email'];
        $password = $_POST['register_pass'];
        $confirmPassword = $_POST['Confirm_register_pass'];
        $typeDeCandidature = $_POST['TypeCandidature'];

        if ($password !== $confirmPassword) {
            echo "<div class='erreur'>Les mots de passe ne correspondent pas.</div>";
        } else {
            $verification_email_entreprise = $connexion->prepare("SELECT email FROM entreprise WHERE email = ?");
            $verification_email_entreprise->bind_param("s", $email);
            $verification_email_entreprise->execute();
            $verification_email_entreprise->store_result();

            $verification_email_candidat = $connexion->prepare("SELECT email FROM candidat WHERE email = ?");
            $verification_email_candidat->bind_param("s", $email);
            $verification_email_candidat->execute();
            $verification_email_candidat->store_result();

            if ($verification_email_entreprise->num_rows > 0 || $verification_email_candidat->num_rows > 0) {
                echo '<script>alert("email existe")</script>';
            }else{
                echo "BienVenue";
            }
        }
    }
?>