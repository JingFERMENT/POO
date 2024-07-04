<?php
// Enregistre une fonction d'auto-chargement des classes
spl_autoload_register(static function(string $fqcn) {
    // $fqcn contient le nom complet de la classe, par exemple "App\MatchMaker\Lobby"

    // Remplacez le namespace 'App' par 'src' et les backslashes par des slashes
   $path = str_replace(['App','\\'], ['src','/'], $fqcn).'.php';
   
   // Chargez le fichier PHP correspondant// puis chargeons le fichier
   require_once ($path);
});

// Importation des classes avec le mot-clé use
use App\MatchMaker\Lobby;
use App\MatchMaker\Player\Player;

$greg = new Player('greg');
$jade = new Player('jade');

$lobby = new Lobby();
$lobby->addPlayers($greg, $jade);

var_dump($lobby->findOpponents($lobby->queuingPlayers[0]));

exit(0);
