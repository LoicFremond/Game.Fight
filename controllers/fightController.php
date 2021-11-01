<?php

include '../models/Database.php';

session_start();


if (count($_POST) != 2) {
    header('Location: ../index.php');
    exit();
}

$_SESSION['fighters'] = [];

foreach ($_POST as $characterId) {
    $character = Database::getOneCharacter($characterId);
    array_push($_SESSION['fighters'], $character);
}
foreach ($_POST as $character2Id) {
    $character2 = Database::getOneCharacter2($character2Id);
    array_push($_SESSION['fighters'], $character2);
}

$_SESSION['fighting'] = true;
header('Location: ../fight.php');
exit();
