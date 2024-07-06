<?php

declare(strict_types=1);

namespace App;

use App\Encounter\Encounter;
use App\Player\InLobbyPlayerInterface;
use App\Player\PlayerInterface;
use App\Player\QueuingPlayer;

class Lobby implements LobbyInterface
{
    public array $queuingPlayers = [];

    public array $encounters = [];

    public function findOpponents(InLobbyPlayerInterface $player): array
    {
        $minLevel = round($player->getRatio() / 100);
        $maxLevel = $minLevel + $player->getRange();

        return array_filter($this->queuingPlayers, static function (InLobbyPlayerInterface $potentialOpponent) use ($minLevel, $maxLevel, $player) {
            $playerLevel = round($potentialOpponent->getRatio() / 100);

            return $player !== $potentialOpponent && ($minLevel <= $playerLevel) && ($playerLevel <= $maxLevel);
        });
    }

    public function isInLobby(PlayerInterface $player): QueuingPlayer
    {
        foreach ($this->queuingPlayers as $queuingPlayer) {
            // since we go by the interface we might be checking the player or the queuing player.
            if ($queuingPlayer === $player || $queuingPlayer->getPlayer() === $player) {
                return $queuingPlayer;
            }
        }

        trigger_error('Ce joueur ne se trouve pas dans le lobby', E_USER_ERROR);
    }

    public function isPlaying(PlayerInterface $player): bool
    {
        foreach ($this->encounters as $encounter) {
            if (Encounter::STATUS_OVER !== $encounter->getStatus() && ($encounter->getPlayerA() === $player || $encounter->getPlayerB() === $player)) {
                return true;
            }
        }

        return false;
    }

    public function removePlayer(PlayerInterface $player): void
    {
        $queuingPlayer = $this->isInLobby($player);

        unset($this->queuingPlayers[array_search($queuingPlayer, $this->queuingPlayers, true)]);
    }

    public function addPlayer(PlayerInterface $player): void
    {
        $this->queuingPlayers[] = new QueuingPlayer($player);
    }

    public function createEncounterForPlayer(InLobbyPlayerInterface $player): void
    {
        if (!\in_array($player, $this->queuingPlayers, true)) {
            return;
        }

        $opponents = $this->findOpponents($player);

        if (empty($opponents)) {
            $player->upgradeRange();

            return;
        }

        $opponent = array_shift($opponents);

        $this->encounters[] = new Encounter(
            $player->getPlayer(),
            $opponent->getPlayer(),
        );

        $this->removePlayer($opponent);
        $this->removePlayer($player);
    }

    public function createEncounters(): void
    {
        if (2 > \count($this->queuingPlayers)) {
            trigger_error('Le nombre de joueurs est insuffisant pour créer une rencontre :(', E_USER_ERROR);
        }

        foreach ($this->queuingPlayers as $key => $player) {
            $this->createEncounterForPlayer($player);
        }
    }
}
