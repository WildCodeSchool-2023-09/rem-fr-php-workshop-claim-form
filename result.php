<?php
// Nettoyable avec trim

$data = array_map('trim', $_POST);

// Protection faille XSS 

$data = array_map('htmlentities', $data);

$errors = [];

if (!isset($data['companyName']) || empty($data['companyName'])){
    $errors[] = 'Le nom de l\'entreprise est obligatoire';
}
if (!isset($data['userName']) || empty($data['userName'])){
    $errors[] = 'Le nom est obligatoire';
}
if (!isset($data['email']) || empty($data['email'])){
    $errors[] = 'L\'email est obligatoire';
}
if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'L\'email n\'est pas au bon format';
}

if (!isset($data['contactMessage']) || empty($data['contactMessage'])){
    $errors[] = 'Le message est obligatoire';
}

if (mb_strlen($data['contactMessage']) < 30 ) {
    $errors[] = 'Le message doit contenir plus de 30 caractères';
}

if (!isset($data['contact']) || empty($data['contact'])){
    $errors[] = 'Le champ contact est obligatoire';
}

$team = [
    "andy",
    "dwight",
    "jim",
    "phyllis",
    "stanley"
];

if (!in_array($data['contact'], $team)) {
    $errors[] = 'Vous n\'avez pas sélectionné le bon contact';
}


// TODO 3 - Get the data from the form and check for errors


if (!empty($errors)) {
    require 'error.php';
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Récapitulatif - Réclamation</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <header>
        <h1>Nous traitons votre retour.</h1>
        <img src="images/<?php echo $data['contact'] ?>.webp" alt="Logo Dunder Mifflin">
    </header>

    <main>
        <div class="summary">
            <!-- BONUS -->
            <p>
                <img src="<?php echo $data['contact'] ?>.webp" alt="">
                <span>Votre vendeur</span>
            </p>
            

            <!-- TODO 2 - Replace those placeholders by the values sent from the form -->
            <ul>
                <li>Votre entreprise : <span><?= $data['companyName'] ?></span></li>
                <li>Votre nom : <span><?= $data['userName'] ?></span></li>
                <li>Votre email : <span><?= $data['email'] ?></span></li>
                <li>Votre message :
                    <p><?= $data['contactMessage'] ?>
                    </p>
                </li>
            </ul>
        </div>
    </main>
</body>

</html>