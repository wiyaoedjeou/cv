<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des champs du formulaire
    $nom = $_POST['nom'] ?? $_POST['name'];
    $prenom = $_POST['prenom'] ?? $_POST['first-name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];
    $lang = $_POST['lang']; // Détection de la langue

    // Détails de l'email
    $to = 'wiyaoedjeou@outlook.com';
    $subject = "New message from $prenom $nom";
    $headers = "From: $email" . "\r\n" .
               "Reply-To: $email" . "\r\n" .
               "X-Mailer: PHP/" . phpversion();

    // Contenu du message
    $email_content = "Nom: $nom\n";
    $email_content .= "Prénom: $prenom\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Téléphone: $phone\n";
    $email_content .= "Message:\n$message\n";

    // Envoi de l'email
    if (mail($to, $subject, $email_content, $headers)) {
        // Affichage du message de succès en fonction de la langue sélectionnée
        if ($lang == "fr") {
            echo "<p>Votre message a été envoyé avec succès ! Vous allez être redirigé vers la page d'accueil en français.</p>";
            header("refresh:5;url=index.html"); // Redirection vers la version française
        } else {
            echo "<p>Your message has been sent successfully! You will be redirected to the homepage in English.</p>";
            header("refresh:5;url=index_en.html"); // Redirection vers la version anglaise
        }
    } else {
        // Message d'erreur
        if ($lang == "fr") {
            echo "<p>Désolé, une erreur s'est produite lors de l'envoi de votre message. Veuillez réessayer.</p>";
            header("refresh:5;url=index.html"); // Redirection vers la version française
        } else {
            echo "<p>Sorry, an error occurred while sending your message. Please try again.</p>";
            header("refresh:5;url=index_en.html"); // Redirection vers la version anglaise
        }
    }
}
?>
