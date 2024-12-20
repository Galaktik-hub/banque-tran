<!DOCTYPE html>
<html lang="fr" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 38rem;
            margin: auto;
            padding: 1.25rem;
            border: 1px solid #ddd;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #3e79e5;
            padding: 0.7rem;
            text-align: center;
            color: #ffffff;
        }
        .header h1 {
            margin: 0;
            font-size: 1.6rem;
        }
        .content {
            padding: 1.5rem;
        }
        .content h2 {
            color: #3e79e5;
            font-size: 1.3rem;
        }
        .content p {
            margin: 0.7rem 0;
            font-size: 1rem;
        }
        .content a {
            font-size: 1rem;
        }
        .button {
            display: inline-block;
            padding: 0.7rem 1rem;
            margin-top: 1rem;
            color: #ffffff !important;
            background-color: #3e79e5;
            text-decoration: none;
            border-radius: 0.25rem;
            font-weight: bold;
            font-size: 1rem;
        }
        .guide-utilisateur {
            margin-top: 2rem;
            margin-bottom: 2rem;
        }
        .guide-utilisateur a:not(.button) {
            color: #15c !important;
        }
        .footer {
            margin-top: 1.5rem;
            font-size: 0.8rem;
            text-align: center;
            color: #777;
        }
        @media only screen and (max-width: 600px) {
            .email-container {
                width: 100%;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Bienvenue chez B.I.L.L.S.</h1>
    </div>
    <div class="content">
        <h2>Votre compte a été créé avec succès !</h2>
        <p>Bonjour,</p>
        <p>Nous avons le plaisir de vous informer qu'un compte a été créé pour vous sur notre plateforme <strong>B.I.L.L.S</strong> (Bilan des Impayés et Lettres de Licences avec Statistiques)</p>
        <p>Votre <strong>identifiant</strong> client est le suivant : <?= $username ?></p>
        <p>Veuillez bien le noter, il vous servira lors de la connexion à votre compte.</p>
        <p>Afin d'accéder à votre compte, nous vous invitons à <strong>changer votre mot de passe</strong> en utilisant le lien ci-dessous :</p>
        <p>
            <a class="button" href="https://bills.julien-synaeve.fr/src/changePassword.php?pw=<?= $password ?>">Changer mon mot de passe</a>
        </p>
        <p>Nous vous recommandons de choisir un mot de passe <strong>sécurisé</strong> et de le garder <strong>confidentiel</strong>.</p>
        <div class="guide-utilisateur">
            <h2>Guide Utilisateur</h2>
            <p>Visionnez notre guide pour découvrir comment utiliser la plateforme :</p>
            <p>
                <a class="button" href="https://www.youtube.com/watch?v=WZsEtAbGReo">Guide Utilisateur</a>
            </p>
            <a href="https://www.youtube.com/watch?v=WZsEtAbGReo" alt="Guide utilisateur">https://www.youtube.com/watch?v=WZsEtAbGReo</a>
        </div>
        <p>Nous restons à votre disposition pour toute question ou assistance.</p>
        <p>Cordialement,</p>
        <p>L'équipe B.I.L.L.S</p>
    </div>
    <div class="note">
        <p>Si le bouton ne fonctionne pas, vous pouvez copier et coller ce lien suivant dans votre navigateur :</p>
        <p><a href="https://bills.julien-synaeve.fr/src/changePassword.php?pw=<?= $password ?>">https://julien-synaeve.fr/bills/src/changePassword.php?pw=<?= $password ?></a></p>
    </div>
    <div class="footer">
        <p>&copy; B.I.L.L.S - Bilan des Impayés et Lettres de Licences avec Statistiques</p>
        <p>Ce message a été envoyé automatiquement, merci de ne pas y répondre.</p>
    </div>
</div>
</body>
</html>