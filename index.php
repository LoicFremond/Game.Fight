<?php

///////////////////////////////////////////////////
////              Page de combat               ////
//////////////////////////////////////////////////


use classes\Character;

require './classes/autoload.php';
require './models/Database.php';

session_start();

$players = Database::getAllPlayers();
$characters = Database::getAllCharacters();
$players2 = Database::getAllPlayers2();
$characters2 = Database::getAllCharacters2();

///////////////////////////////////////////////////
////          Chargement J1 et J2              ////
//////////////////////////////////////////////////


if (isset($_SESSION['fighting'])) {
    $class1 = '\classes\\' . $_SESSION['fighters'][0]['type'];
    $player1 = new $class1($_SESSION['fighters'][0]['name'], ['picture']);
    $class2 = '\classes\\' . $_SESSION['fighters'][1]['type'];
    $player2 = new $class2($_SESSION['fighters'][1]['name'], ['picture']);
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="public/css/style.css">
    <title>Choix du Personnage</title>
</head>
<header>
    <h1 class="titre">Jeu de Combat</h1>
    <p>Ceci est un jeu basé sur l'univers de World of Warcraft.</p>
</header>

<body class="accueil">
    <form class="select" method="POST" action="controllers/fightController.php">
        <section>
            <h3>Joueur 1</h3>
            <div class="players">
                <?php foreach ($characters as $character) : ?>
                    <div class="players__card">
                        <h4><?= $character['name']  ?> </h4>
                        <label for="<?= $character['id'] ?>"><img class="img_card" title="<?= $character['type']  ?> " width="200px" height="200px" class="section__img" src="<?= $character['picture'] ?>" />
                    </div>
                    <input class="go" type="radio" id="<?= $character['id'] ?>" name="<?= $character['id'] ?>" value="<?= $character['id'] ?>">
                    </label>
                <?php endforeach; ?>
            </div>
        </section>
        <div>
            <input class="start" type="submit" value="" title="Baston!!!!!">
        </div>
        <section>
            <h3>Joueur 2</h3>
            <div class="players">
                <?php foreach ($characters2 as $character2) : ?>
                    <div class="players__card">
                        <h4 class="perso" ><?= $character2['name']  ?> </h4>
                        <label for="<?= $character2['id'] ?>"><img class="img_card" title="<?= $character2['type']  ?> " width="200px" height="200px" class="section__img" src="<?= $character2['picture'] ?>" />
                    </div>
                    <input class="go" type="radio" id="<?= $character2['id'] ?>" name="<?= $character2['id'] ?>" value="<?= $character2['id'] ?>">
                    </label>
                <?php endforeach; ?>
            </div>
        </section>
    </form>
</body>
    <footer>
        <h4> © Copyright 2021 L. Fremond</h4>
    </footer>