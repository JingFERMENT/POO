<?php

declare(strict_types=1);

namespace App\MatchMaker\Encounter;

use App\MatchMaker\Player\PlayerInterface;

class Score
{
    public function __construct(public PlayerInterface $player, public int $score)
    {
    }
}