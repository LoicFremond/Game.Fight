<?php

///////////////////////////////////////////////////
////              Page de combat               ////
//////////////////////////////////////////////////


use classes\Character;

require './classes/autoload.php';
require './models/Database.php';

session_start();

$characters = Database::getAllCharacters();
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
    <title>Arène</title>
</head>
<header>
    <h2><img class="imgVS" src="<?= "{$player1->picture}" ?>" /> <?= "{$player1->name}" ?> <span class="VS"> VS </span> <?= "{$player2->name}" ?><img class="imgVS" src="<?= "{$player2->picture}" ?>" /></h2>
    <div>
        <form action="controllers/fightReset.php" method="POST">
            <input class="reset" type="submit" value="" title="Retour choix personnages">
        </form>
    </div>
    <input class="rafraichir" type="button" onclick='window.location.reload(false)' value="" title="Revanche" />
</header>

<body class="combats">
    <main class="flex">
        <div class="fight">
            <?php if (isset($_SESSION['fighting'])) : ?>
                <?php $i = 1 ?>
                <?php while ($player1->getLifePoints() > 0 && $player2->getLifePoints() > 0) : ?>
                    <p class="VS"></p>
                    <div class="flex row">
                        <div class="atk1">
                            <?php if ($player1->getLifePoints() > 0) : ?>
                                <img class="imgplayer" src="<?= "{$player1->picture}" ?>" />
                                <div class="progress">
                                    <progress class="bar" max="<?= Character::MAX_LIFE ?>" value="<?= $player1->getLifePoints() ?>"></progress><span class="PV1">PV : <?= $player1->getLifePoints() ?></span>
                                    <progress class="bar" max="<?= Character::MAX_MANA ?>" value="<?= $player1->mana ?>"></progress><span class="MANA1">Energie : <?= $player1->mana ?></span>
                                </div>
                                <p class="player1"><?= $player1->attack($player2) ?></p>
                            <?php elseif ($player1->getLifePoints() == 0) : ?>
                                <img class="imgplayer" src="<?= "{$player1->picture}" ?>" />
                                <div class="progress">
                                    <progress class="bar" max="<?= Character::MAX_LIFE ?>" value="<?= $player1->getLifePoints() ?>"></progress><span class="PV2">PV : <?= $player1->getLifePoints() ?></span>
                                    <progress class="bar" max="<?= Character::MAX_MANA ?>" value="<?= $player1->mana ?>"></progress><span class="MANA2">Energie : <?= $player1->mana ?></span>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="count flex border">
                            <span>Tour</span>
                            <span><?= $i ?></span>
                        </div>
                        <div class="atk2">
                            <?php if ($player2->getLifePoints() > 0) : ?>
                                <img class="imgplayer" src="<?= "{$player2->picture}" ?>" />
                                <div class="progress">
                                    <progress class="bar" max="<?= Character::MAX_LIFE ?>" value="<?= $player2->getLifePoints() ?>"></progress><span class="PV2">PV : <?= $player2->getLifePoints() ?></span>
                                    <progress class="bar" max="<?= Character::MAX_MANA ?>" value="<?= $player2->mana ?>"></progress><span class="MANA2">Energie : <?= $player2->mana ?></span>
                                </div>
                                <p class="player2"><?= $player2->attack($player1) ?></p>
                            <?php elseif ($player2->getLifePoints() == 0) : ?>
                                <img class="imgplayer" src="<?= "{$player2->picture}" ?>" />
                                <div class="progress">
                                    <progress class="bar" max="<?= Character::MAX_LIFE ?>" value="<?= $player2->getLifePoints() ?>"></progress><span class="PV2">PV : <?= $player2->getLifePoints() ?></span>
                                    <progress class="bar" max="<?= Character::MAX_MANA ?>" value="<?= $player2->mana ?>"></progress><span class="MANA2">Energie : <?= $player2->mana ?></span>
                                </div>
                            <?php endif ?>
                        </div>
                        <?php $i++ ?>
                    </div>
                <?php endwhile ?>
            <?php endif ?>
            <div>
                <?php
                if (!$player1->isAlive()) {
                    $winner = $player2;
                    $loser = $player1; ?>

                    <div class="final">
                        <section class="lose">
                            <p> <img class="imgwin" src="<?= $loser->getImg() ?>" /> Perd </p>
                        </section>
                        <section class="win">
                            <p><img class="imgwin" src="<?= $winner->getImg() ?>" /> Gagne </p>
                        </section>
                    </div>
            </div>

        <?php } else {
                    $winner = $player1;
                    $loser = $player2;
        ?>
            <div class="final">
                <section class="lose">
                    <p> <img class="imgwin" src="<?= $winner->getImg() ?>" /> Gagne </p>
                </section>
                <section class="win">
                    <p><img class="imgwin" src="<?= $loser->getImg() ?>" /> Perd </p>
                </section>
            </div>
        </div>
        </div>
    <?php } ?>
    </main>
</body>
<footer>
<h4> © Copyright 2021 L. Fremond</h4>
</footer>

</html>