<?php
    session_start();
    include('function.php');
    include('connexion.php');
    include("navbar.php");
    checkIsAdmin();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../css/accueil_a.css">

        <title>Espace Admin</title>
    </head>
    <body>
        <?php
        if($_SESSION['isProductOwner']==0){
            $po=0;
        }
        else{
            $po=1;
        }
         ?>
         <h3 class="titre">Insérer un client</h3>
         <div class="client">
            <form action="insertClient.php" method="POST">
                <table class="tab">
                    <tr>
                        <th>Siren</th>
                        <td><input type="text" minlength="9" maxlength="9" name="numSiren" required></td>
                    </tr>
                    <tr>
                        <th>Raison Sociale</th>
                        <td><input type="text" name="raisonSociale" maxlength="20" required></td>
                    </tr>
                    <tr>
                        <th>Identifiant</th>
                        <td><input type="text" name="loginClient" maxlength="50" required></td>
                    </tr>
                    <tr>
                        <th>Mot de passe</th>
                        <td><input type="text" name="passwordClient" maxlength="10" required></td>
                    </tr>
                    <tr>
                        <td class="lien"><input type="reset" value="Annuler" class="interact"></td>
                        <td class="lien"><input type="submit" value="Ajouter" class="interact"></td>
                    </tr>
                    </table>
                </form>
        </div>
    </body>
</html>

<?php
  if (isset($_POST['numSiren']) && isset($_POST['raisonSociale']) && isset($_POST['loginClient']) && isset($_POST['passwordClient'])) {
    $siret = $_POST['numSiren'];
    $rs = $_POST['raisonSociale'];
    $login = $_POST['loginClient'];
    $pw = hash('sha256', $_POST['passwordClient']);


    $insert = $dbh->prepare("INSERT INTO `client` (`numClient`, `numSiren`, `loginClient`, `passwordClient`, `raisonSociale`) VALUES (:unumclient, :usiret,  :ulogin, :upw, :urs);");

    try{
      if($insert->execute(array(':unumclient' => NULL, ':usiret' => $siret, ':ulogin'=> $login, ':upw'=> $pw, ':urs'=> $rs))){
        echo "<div class='alert alert-success w-25' role='alert'>Insertion du client réussi</div>";
      }
    }
    catch(Exception $e){
      echo "<p>" . $e->getMessage() . "</p>";
    }
  }
?>