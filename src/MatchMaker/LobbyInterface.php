<?php

declare(strict_types=1);

namespace App\MatchMaker;

use App\MatchMaker\Player\PlayerInterface;
use App\MatchMaker\Player\InLobbyPlayerInterface;
use App\MatchMaker\Player\QueuingPlayer;

interface LobbyInterface
{

    public function isInLobby(PlayerInterface $player): QueuingPlayer;
    
    public function isPlaying(PlayerInterface $player): bool;

    public function removePlayer(PlayerInterface $player): void;

    public function addPlayer(PlayerInterface $player): void;

    public function createEncounterForPlayer(InLobbyPlayerInterface $player): void;

    public function createEncounters(): void;
}
