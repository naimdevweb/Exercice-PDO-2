
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout Patient et Rendez-vous</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        fieldset {
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        legend {
            font-weight: bold;
            font-size: 18px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
        }

        input[type="text"],
        input[type="date"],
        input[type="email"],
        input[type="tel"],
        textarea,
        input[type="datetime-local"] {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        textarea {
            resize: vertical;
            height: 100px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

       
    </style>
</head>

<body>
    <div class="container">
        <h1>Ajouter un patient et un rendez-vous</h1>

        <form action="traitement.php" method="POST">
            <!-- Informations patient -->
            <fieldset>
                <legend><strong>Informations sur le patient</strong></legend>
                <label for="lastName">Nom :</label>
                <input type="text" id="lastName" name="lastName" placeholder="Nom du patient" required><br>

                <label for="firstName">Prénom :</label>
                <input type="text" id="firstName" name="firstName" placeholder="Prénom du patient" required><br>

                <label for="birthdate">Date de naissance :</label>
                <input type="date" id="birthdate" name="birthdate" required><br>

                <label for="phone">Numéro de téléphone :</label>
                <input type="tel" id="phone" name="phone" placeholder="Numéro de téléphone" required><br>

                <label for="mail">Email :</label>
                <input type="email" id="mail" name="mail" placeholder="Email du patient" required><br>
            </fieldset>

            <!-- Informations rendez-vous -->
            <fieldset>
                <legend><strong>Informations sur le rendez-vous</strong></legend>
                <label for="appointmentDate">Date du rendez-vous :</label>
                <input type="datetime-local" id="dateHour" name="dateHour" required><br>

                <label for="appointmentReason">Raison du rendez-vous :</label>
                <textarea id="appointmentReason" name="appointmentReason" placeholder="Raison du rendez-vous" required></textarea><br>
            </fieldset>

            <!-- Bouton de soumission -->
            <button type="submit">Ajouter le patient et le rendez-vous</button>
        </form>
    </div>
</body>

</html>
