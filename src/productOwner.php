<?php
    session_start();
    include('function.php');
    include('connexion.php');
    include("navbar.php");
    include('links.php');
    checkIsPO();
?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/accueil_a.css">

        <title>Espace Product Owner</title>
    </head>
    <body>
    <?php
    if(isset($_POST['date'])){
        $_SESSION['home.datePO'] = $_POST['date'];
        $date = $_SESSION['home.datePO'];
    }
    else {
        unset($_SESSION['home.datePO']);
        $date = date('Y-m-d');
    }
    setlocale (LC_TIME, 'fr_FR.utf8','fra');
    echo "<h3 class='titre'>Trésorerie du ".strftime('%A %e %B %Y', strtotime($date))."</h3>";

    ?>

        <div id="myGrid" class="ag-theme-quartz" style="width: 1400px; margin: auto; font-size: 15px"></div>
        <script src="../js/admin/productOwner.js"></script>
    </body>
</html>

