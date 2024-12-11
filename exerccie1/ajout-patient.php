<?php

require_once '../utils/connect-db.php';


// INSERER ICI validation du formulaire




if (
    isset(
        $_POST['lastName'],
        $_POST['firstName'],
        $_POST['birthdate'],
        $_POST['phone'],
        $_POST['mail']
    )
) {
    if (
        !empty($_POST['lastName']) &&
        !empty($_POST['firstName']) &&
        !empty($_POST['birthdate']) &&
        !empty($_POST['phone'])&&
        !empty($_POST['mail'])
    ) {

        // input sanitization
        $nom = htmlspecialchars(trim($_POST['lastName']));
        $prenom = htmlspecialchars(trim($_POST['firstName']));
        $age = htmlspecialchars(trim($_POST['birthdate']));
        $adresse = htmlspecialchars(trim($_POST['phone']));
        $mail = htmlspecialchars(trim($_POST['mail']));

        // if (
        //     strlen($nom) > 50 ||
        //     strlen($prenom) > 50 ||
        //     $age > 120 ||
        //     $age < 0
        // ) {
        //     // redirection si c'est pas bon
        // }


        $sql = "INSERT INTO patients (lastName, firstName,birthdate,phone,mail)
 VALUES (:lastName, :firstName, :birthdate, :phone,:mail)";

        try {
            $stmt = $pdo->prepare($sql);
            $users = $stmt->execute([
                'lastName' => $_POST["lastName"],
                ':firstName' => $_POST["firstName"],
                ':birthdate' => $_POST["birthdate"],
                ':phone' => $_POST["phone"],
                ':mail' => $_POST["mail"]
            ]); // ou fetch si vous savez que vous n'allez avoir qu'un seul résultat




        } catch (PDOException $error) {
            echo "Erreur lors de la requete : " . $error->getMessage();
        }
    }
}





// a remplir en fonction de vos prerequis



// mon code une fois que toute les données sont bonnes


// header('location: ../compte_creer.php?firstName=' . $firstName . '&lastName=' . $lastName);







// header("Location: ./index.php");
// exit;
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Patient</title>
    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 50%;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-size: 16px;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="text"],
        input[type="number"],
        input[type="email"],
        input[type="tel"],
        input[type="date"],
        textarea {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
            min-height: 80px;
        }

        button.submit-btn {
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #4CAF50;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button.submit-btn:hover {
            background-color: #45a049;
        }

        a.back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #007BFF;
            text-decoration: none;
        }

        a.back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Ajouter un Patient</h1>

        <form action="" method="POST">
            <div class="form-group">
                <label for="lastName">Nom :</label>
                <input type="text" id="lastName" name="lastName" required>
            </div>

            <div class="form-group">
                <label for="firstName">Prénom :</label>
                <input type="text" id="firstName" name="firstName" required>
            </div>

            <div class="form-group">
                <label for="birthdate">Date de naissance :</label>
                <input type="date" id="birthdate" name="birthdate" required>
            </div>

            <div class="form-group">
                <label for="phone">Numéro de téléphone :</label>
                <input type="tel" id="phone" name="phone" required>
            </div>

            <div class="form-group">
                <label for="mail">Adresse e-mail :</label>
                <input type="email" id="mail" name="mail" required>
            </div>

            <button type="submit" class="submit-btn">Ajouter le patient</button>
        </form>

        <br>
        <a href="index.php" class="back-link">Retour à l'accueil</a>
    </div>

</body>

</html>
