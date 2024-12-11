<?php
require_once '../utils/connect-db.php';

// On détermine sur quelle page on se trouve
$currentPage = isset($_GET['page']) && !empty($_GET['page']) ? (int) $_GET['page'] : 1;

// On détermine le nombre total d'articles
$sql = 'SELECT COUNT(*) AS nb_articles FROM `patients`;';
$query = $pdo->prepare($sql);
$query->execute();
$result = $query->fetch();
$nbArticles = (int) $result['nb_articles'];

// On détermine le nombre d'articles par page
$parPage = 2;

// On calcule le nombre de pages total
$pages = ceil($nbArticles / $parPage);

// Calcul du 1er article de la page
$premier = ($currentPage * $parPage) - $parPage;






// Si un terme de recherche est présent, on modifie la requête pour rechercher par nom ou prénom
$searchTerm = isset($_GET['search']) ? "%" . $_GET['search'] . "%" : '';

// Requête de pagination avec recherche si nécessaire
$sql = 'SELECT * FROM `patients` WHERE `lastName` LIKE :searchTerm OR `firstName` LIKE :searchTerm ORDER BY `lastName` DESC LIMIT :premier, :parpage;';
$query = $pdo->prepare($sql);

// Lier les paramètres de la requête
$query->bindValue(':searchTerm', $searchTerm, PDO::PARAM_STR);
$query->bindValue(':premier', $premier, PDO::PARAM_INT);
$query->bindValue(':parpage', $parPage, PDO::PARAM_INT);

// Exécution de la requête
$query->execute();
$patients = $query->fetchAll(PDO::FETCH_ASSOC);

// Traitement de la suppression
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    $idToDelete = $_POST['id'];
    if ($idToDelete) {
        try {
            // Suppression des rendez-vous associés
            $sqlDeleteAppointments = "DELETE FROM appointments WHERE idPatients = :id";
            $stmtDeleteAppointments = $pdo->prepare($sqlDeleteAppointments);
            $stmtDeleteAppointments->bindParam(':id', $idToDelete, PDO::PARAM_INT);
            $stmtDeleteAppointments->execute();

            // Suppression du patient
            $sqlDeletePatient = "DELETE FROM patients WHERE id = :id";
            $stmtDeletePatient = $pdo->prepare($sqlDeletePatient);
            $stmtDeletePatient->bindParam(':id', $idToDelete, PDO::PARAM_INT);
            $stmtDeletePatient->execute();

            echo "Patient et ses rendez-vous supprimés avec succès!";
            header('Location: liste-patients.php');  // Redirection après la suppression
            exit;
        } catch (PDOException $error) {
            echo "Erreur lors de la suppression : " . $error->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Patients</title>
    <style>
        /* Styles similaires à ceux déjà fournis dans ton code */
    </style>
</head>

<body>
    <h1>Liste des Patients</h1>

    <div class="search-container">
        <form method="GET" action="liste-patients.php">
            <input type="text" name="search" placeholder="Rechercher par nom ou prénom" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>" />
            <input type="submit" value="Rechercher">
        </form>
    </div>

    <?php if (empty($patients)): ?>
        <p>Aucun patient trouvé.</p>
    <?php else: ?>
        <?php foreach ($patients as $patient): ?>
            <ol>
                <li><strong>Nom du patient :</strong> <?= htmlspecialchars($patient['lastname']) ?></li>
                <li><strong>Prénom du patient :</strong> <?= htmlspecialchars($patient['firstname']) ?></li>
                <a href="../exercice3/profil-patients.php?lIdDuPatient=<?= $patient['id'] ?>">Voir le profil du patient</a>
            </ol>

            <!-- Formulaire de suppression -->
            <form method="POST" class="form-delete" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce patient et ses rendez-vous ?');">
                <input type="hidden" name="id" value="<?= $patient['id'] ?>">
                <input type="submit" name="delete" value="Supprimer">
            </form>
            <br><br>
        <?php endforeach; ?>
    <?php endif; ?>

    <!-- Pagination -->
    <div class="pagination">
        <?php if ($currentPage > 1): ?>
            <a href="liste-patients.php?page=<?= $currentPage - 1 ?>&search=<?= htmlspecialchars($_GET['search'] ?? '') ?>">Précédent</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $pages; $i++): ?>
            <a href="liste-patients.php?page=<?= $i ?>&search=<?= htmlspecialchars($_GET['search'] ?? '') ?>" <?= $i == $currentPage ? 'style="font-weight: bold;"' : '' ?>>
                <?= $i ?>
            </a>
        <?php endfor; ?>

        <?php if ($currentPage < $pages): ?>
            <a href="liste-patients.php?page=<?= $currentPage + 1 ?>&search=<?= htmlspecialchars($_GET['search'] ?? '') ?>">Suivant</a>
        <?php endif; ?>
    </div>

</body>

</html>
