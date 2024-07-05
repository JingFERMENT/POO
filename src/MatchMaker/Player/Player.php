<?php

declare(strict_types=1);

namespace App\MatchMaker\Player;

class Player extends User implements PlayerInterface
{
    public function getName(): string
    {
        return $this->name;
    }

    protected function probabilityAgainst(User $player): float
    {
        return 1 / (1 + (10 ** (($player->getRatio() - $this->getRatio()) / 400)));
    }

    public function updateRatioAgainst(User $player, int $result): void
    {
        $this->ratio += 32 * ($result - $this->probabilityAgainst($player));
    }

    public function getRatio(): float
    {
        return $this->ratio;
    }
}
