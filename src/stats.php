<?php
global $dbh;
session_start();
include('../include/function.php');
include('../include/connexion.php');
include('../include/navbar.php');
checkIsUser();
include('../data/fetchStats.php');
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link href="../css/statistiques.css" rel="stylesheet">
        <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
        <title>Espace Client</title>
    </head>
    <body>
        <div class="container">
            <?php
            if (isset($_SESSION['numClient'])){
                $raison_display = "Statistiques de votre compte";
            }

            // Si le PO veut voir la page du point de vue d'un client
            if (isset($_SESSION['PO_VIEW_CLIENT'])){
                $stmt = $dbh->prepare("SELECT raisonSociale FROM client WHERE numClient = :numClient");
                $stmt->bindParam(':numClient', $_SESSION['PO_VIEW_CLIENT'], PDO::PARAM_INT);
                $stmt->execute();

                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($result) {
                    $raison_display = htmlspecialchars("Statistiques du compte de ". $result['raisonSociale']);
                    } else {
                    // si jamais la requête échoue on garde le numéro
                    $raison_display = htmlspecialchars("Statistiques du client n°".$_SESSION['PO_VIEW_CLIENT']);
                }
            }
            ?>
            <h1 class="title"><?php echo $raison_display;?></h1>

            <!-- Formulaire de sélection d'année et de type de graphique -->
            <form method='get' action='stats.php'>
                <div class="choice">
                    <label>Choix de l'année :
                        <div class="select-wrapper">
                            <select class="select-list" name="date">
                                <?php for ($i = date('Y'); $i >= 1980; $i--) : ?>
                                    <option value="<?= $i ?>" <?= $i == $date ? 'selected' : '' ?>><?= $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </label>
                </div>
                <p class="separator">|</p>
                <div class="choice">
                    <label>Type de graphique :
                        <div class="select-wrapper">
                            <select class="select-list" name="graph">
                                <option value="bar" <?= $graph === "bar" ? 'selected' : '' ?>>Histogramme</option>
                                <option value="line" <?= $graph === "line" ? 'selected' : '' ?>>Courbe</option>
                            </select>
                        </div>
                    </label>
                </div>

                <input type="submit" value="Valider" class="button">
            </form>

            <!-- Conteneurs pour les graphiques -->
            <div class="container-graph">
                <div id="graphTresorerie"></div>

                <!-- Vérification de motifs d'impayés -->
                <?php
                    if (!empty($motifsData)) {
                        echo "<div id=\"graphMotifs\"></div>";
                    } else {
                        echo "<p id=\"noDataMessage\"> Aucun impayé n'a été trouvé pour l'année $date.</p>";
                    }
                ?>
            </div>

            <!-- Exportation en PDF -->
            <button id="exportPdf" class="button">Exporter en PDF</button>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>

        <script>
            // Données pour la trésorerie mensuelle
            var traceTresorerie = {
                x: [<?= implode(',', array_map(fn($m) => "'".date('F', mktime(0, 0, 0, $m))."'", $months)) ?>],
                y: [<?= implode(',', $totals) ?>],
                type: '<?= $graph ?>',
                name: 'Trésorerie'
            };

            // Affichage du graphique de trésorerie
            Plotly.newPlot('graphTresorerie', [traceTresorerie], {title: 'Trésorerie Mensuelle'});

            // Données pour les motifs d'impayés (camembert)
            var traceMotifs = {
                labels: [<?= implode(',', array_map(fn($m) => "'".$m['motif']."'", $motifsData)) ?>],
                values: [<?= implode(',', array_map(fn($m) => $m['count'], $motifsData)) ?>],
                type: 'pie',
                name: 'Motifs d\'Impayés'
            };
            Plotly.newPlot('graphMotifs', [traceMotifs], {title: 'Motifs d’Impayés'});

            // Fonction d'exportation en PDF
            document.getElementById("exportPdf").onclick = function() {
                html2canvas(document.querySelector(".container-graph")).then(canvas => {
                    const imgData = canvas.toDataURL("image/png");
                    const pdf = new jspdf.jsPDF("landscape", "mm", "a4");
                    pdf.addImage(imgData, "SVG", 0, 0, 300, 190);
                    const fileName = `Statistiques_${'<?= $raisonSociale ?>'}_${'<?= $date ?>'}.pdf`;
                    pdf.save(fileName);
                });
            };
        </script>
    </body>
</html>
