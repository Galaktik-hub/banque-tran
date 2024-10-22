<?php
    session_start();
    include('function.php');
    include('connexion.php');
    include("navbar.php");
    include('links.php');
    checkIsAdmin();

    $query = "
        SELECT 
            numClient as 'N° Client', 
            numSiren as 'N° Siren', 
            raisonSociale as 'Raison Sociale', 
            loginClient as 'Identifiant' 
        FROM client";

    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $columns = array_keys($clients[0]);

    $clients_json = json_encode($clients);
    $columns_json = json_encode($columns);
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

        <div id="myGrid" class="ag-theme-quartz" style="width: 1200px; margin: auto; max-width: 100%; font-size: 15px"></div>

        <script>
            const data = <?php echo $clients_json; ?>;
            const columnNames = <?php echo $columns_json; ?>;
        </script>
        <script src="../js/constructor_agGrid.js"></script>
    </body>
</html>