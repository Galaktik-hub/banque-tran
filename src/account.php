<?php
    session_start();
    include('../include/function.php');
    include('../include/connexion.php');
    include('../include/navbar.php');
    checkIsUser();
    include('../data/fetchAccount.php');

    $is_disabled = "";
    if (isset($_SESSION['PO_VIEW_CLIENT'])) {
        $is_disabled = " disabled";
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/account.css">
    <title>Espace Client</title>
</head>
    <body>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const mailField = document.getElementById("mail");
                const newMdpField = document.getElementById("new_mdp");
                const repeatMdpField = document.getElementById("repeatmdp");
                const updateButton = document.querySelector(".btn-submit");
                const initialMail = "<?php echo $mail ?>";
                const errorMsg = document.querySelector('.error');

                function checkForChanges() {
                    const mailChanged = mailField.value !== initialMail;
                    const passwordEntered =
                        newMdpField.value === repeatMdpField.value &&
                        newMdpField.value !== "" &&
                        newMdpField.value !== "";

                    if (mailChanged || passwordEntered) {
                        updateButton.disabled = false;
                    } else {
                        updateButton.disabled = true;
                    }
                }

                function checkPasswordsMatch() {
                    if (newMdpField.value !== "" && newMdpField.value === repeatMdpField.value) {
                        repeatMdpField.style.borderColor = "green";
                        errorMsg.hidden = true;
                    } else if (repeatMdpField.value !== "") {
                        repeatMdpField.style.borderColor = "red";
                        errorMsg.hidden = false;
                    } else {
                        repeatMdpField.style.borderColor = "";
                        errorMsg.hidden = true;
                    }
                }

                mailField.addEventListener("input", checkForChanges);
                newMdpField.addEventListener("input", () => {
                    checkForChanges();
                    checkPasswordsMatch();
                });
                repeatMdpField.addEventListener("input", () => {
                    checkForChanges();
                    checkPasswordsMatch();
                });

                updateButton.disabled = true;
            });
        </script>

        <div class="form-container">
            <h1>Compte Client</h1>
            <?php
            if (isset($_SESSION['PO_VIEW_CLIENT'])) {
                echo "<h4>Vous ne pouvez pas modifier les informations du client en mode visualisation.</h4>";
            }
            ?>

            <form method="POST" action="">
                <div class="form-group">
                    <label for="siren">Siren</label>
                    <input type="text" id="siren" name="siren" value="<?php echo $siren ?>" placeholder="Entrer le Siren" disabled>
                </div>

                <div class="form-group">
                    <label for="raisonSociale">Raison Sociale</label>
                    <input type="text" id="raisonSociale" name="raisonSociale" value="<?php echo $raisonSociale ?>" placeholder="Entrer la Raison Sociale" disabled>
                </div>

                <div class="form-group">
                    <label for="identifiant">Identifiant</label>
                    <input type="text" id="identifiant" name="identifiant" value="<?php echo $loginClient ?>" placeholder="Entrer l'Identifiant" disabled>
                </div>

                <div class="form-group">
                    <label for="mail">Adresse mail</label>
                    <input type="email" id="mail" name="mail" value="<?php echo $mail ?>" placeholder="Entrer votre adresse mail" <?php echo $is_disabled; ?>>
                </div>

                <div class="form-group">
                    <label for="mdp">Mot de passe</label>
                    <input type="password" id="new_mdp" name="new_mdp" placeholder="Entrer le mot de passe" <?php echo $is_disabled; ?>>
                </div>

                <div class="form-group">
                    <label for="repeatmdp">Confirmer le mot de passe</label>
                    <input type="password" id="repeatmdp" name="repeatmdp" placeholder="Répéter le mot de passe" <?php echo $is_disabled; ?>>
                </div>

                <p class='error' hidden>Les mots de passe ne correspondent pas.</p>
                <?php
                    if (!empty($errorMsg)) {
                        echo $errorMsg;
                    }

                    if (!empty($successMsg)) {
                        echo $successMsg;
                    }
                ?>
                <button type="submit" class="btn-submit">Mettre à jour</button>

            </form>
        </div>
    </body>
</html>
