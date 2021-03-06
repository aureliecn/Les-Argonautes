<?php
// Connexion à la base de données
$db = new PDO("mysql:host=localhost;dbname=argonaute", "root", "root");
// Requête pour récupérer tous les membres
$query = $db->query("
SELECT name from members
");
$members = $query->fetchAll(PDO::FETCH_ASSOC);

if (!empty($_POST)) {
    $name = trim(strip_tags($_POST["name"]));

    // Initialisation d'un tableau d'erreurs
    $errors = [];

    if (empty($name)) {
        $errors["name"] = "Le champ est obligatoire !";
    }

    if (empty($errors)) {
        // Connexion à la base de données
        $db = new PDO("mysql:host=localhost;dbname=argonaute", "root", "root");

        // Requête pour insertion en base
        $query = $db->prepare("
            INSERT INTO members
            (name)
            VALUES
            (:name)
        ");
        // J'associe la variable au paramètre
        $query->bindParam(":name", $name);

        if ($query->execute()) {
            header("Location: ./");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Argonautes</title>

    <!-- Import de la feuille de style font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Import de la police Bree Serif -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bree+Serif&family=GFS+Didot&family=Roboto:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <div class="logo">
            <img src="https://www.wildcodeschool.com/assets/logo_main-e4f3f744c8e717f1b7df3858dce55a86c63d4766d5d9a7f454250145f097c2fe.png" alt="Logo Wild Code School">
        </div>
        <h1>Les Argonautes</h1>
    </header>
    <main>
        <div class="add-member">
            <h2>Ajouter un(e) Argonaute</h2>
            <form action="" method="post">
                <div class="form-group">
                    <label for="inputName">Nom de l'Argonaute <i class="fa-solid fa-anchor"></i></label>
                    <div class="input-and-submit-wrapper">
                        <input type="text" name="name" id="inputName" class="input">
                        <input type="submit" value="Embarquer !" class="button">
                    </div>
                </div>
            </form>
        </div>

        <div class="all-members">
            <h2>Membres de la team Argonaute <i class="fa-solid fa-skull-crossbones"></i></i></h2>
            <div class="members">
                <?php
                foreach ($members as $member) {
                ?>
                    <p><?= $member["name"] ?></p>
                <?php
                }
                ?>
            </div>
        </div>
    </main>

    <footer>
        <p>Réalisé par Jason en Anthestérion de l'an 515 avant JC</p>
    </footer>
</body>

</html>