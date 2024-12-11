<?php
require_once '../utils/connect-db.php';

// Récupérer les rendez-vous
$sql = "SELECT idPatients, dateHour, id FROM appointments";

try {
    $stmt = $pdo->query($sql);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC); 
} catch (PDOException $error) {
    echo "Erreur lors de la requête : " . $error->getMessage();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    
    $idToDelete = $_POST['id'];
    if ($idToDelete) {
        // Requête de suppression
        $sqlDelete = "DELETE FROM appointments WHERE id = :id";
        $stmtDelete = $pdo->prepare($sqlDelete);
        $stmtDelete->bindParam(':id', $idToDelete, PDO::PARAM_INT);
        $stmtDelete->execute();
        
       
        echo "Rendez-vous supprimé avec succès!";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Rendez-vous</title>
</head>

<body>
    <style>
        a {
            text-decoration: none;
            color: white;
            background-color: #007bff;
            padding: 15px 30px;
            border-radius: 5px;
            font-size: 18px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s, transform 0.3s;
        }

        a:hover {
            background-color: #0056b3;
            transform: scale(1.1);
        }

        form {
            display: inline;
        }
    </style>

    <h1>Liste des Rendez-vous :</h1>

    <?php foreach ($users as $user): ?>
        <ol>
            <li><strong>ID du rendez-vous :</strong> <?= $user['id'] ?> </li>
            
        </ol>

        <a href="../exercice7/rendezvous.php?lIdDuRdv=<?= $user['id']?>">Informations sur le rendez-vous</a>

        
        <form method="POST" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce rendez-vous ?');">
            <input type="hidden" name="id" value="<?= $user['id'] ?>">
            <input type="submit" name="delete" value="Supprimer">
        </form>
        <br><br>
    <?php endforeach; ?>

    <a href="../exercice5/ajoutez-un-rdv.php">Ajoutez un rendez-vous</a>
</body>

</html>
