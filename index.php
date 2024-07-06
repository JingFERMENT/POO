<?php

declare(strict_types=1);

// Enregistre une fonction d'auto-chargement des classes
spl_autoload_register(static function(string $fqcn):void {
    // $fqcn contient le nom complet de la classe, par exemple "App\MatchMaker\Lobby"

    // Remplacez le namespace 'App' par 'src' et les backslashes par des slashes
   $path = sprintf('%s.php',str_replace(['App','\\'], ['src','/'], $fqcn));
   
   // Chargez le fichier PHP correspondant// puis chargeons le fichier
   require_once ($path);
});

// Importation des classes avec le mot-clé use
use App\Encounter\Score;
use App\Exceptions\InsufficientPlayersException;
use App\Lobby;
use App\Player\Player;

$greg = new Player('greg');
$chuckNorris = new Player('Chuck Norris', 3000);

try {
    $lobby = new Lobby();
    $lobby->addPlayer($greg);
    $lobby->addPlayer($chuckNorris);

    while (count($lobby->queuingPlayers)) {
        $lobby->createEncounters();
    }
} catch (InsufficientPlayersException $errormsg) {
    echo 'Erreur: ' . $e->getMessage();
} catch (\Exception $e) {
    echo 'Une erreur inattendu est survenue: ' . $errormsg->getMessage();
}


$encounter = end($lobby->encounters);

// ces scores sont fictifs !
$encounter->setScores(
    new Score(score: 42, player: $greg),
    new Score(score: 1, player: $chuckNorris)
);

var_dump($encounter);

$encounter->updateRatios();

var_dump($greg);
var_dump($chuckNorris);
