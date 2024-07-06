<?php

declare(strict_types=1);

namespace App;

use App\Player\PlayerInterface;
use App\Player\InLobbyPlayerInterface;
use App\Player\QueuingPlayer;

interface LobbyInterface
{

    public function isInLobby(PlayerInterface $player): QueuingPlayer;
    
    public function isPlaying(PlayerInterface $player): bool;

    public function removePlayer(PlayerInterface $player): void;

    public function addPlayer(PlayerInterface $player): void;

    public function createEncounterForPlayer(InLobbyPlayerInterface $player): void;

    public function createEncounters(): void;
}
