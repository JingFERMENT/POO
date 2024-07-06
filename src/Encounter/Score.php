<?php

declare(strict_types=1);

namespace App\Encounter;

use App\Player\PlayerInterface;

class Score
{
    public function __construct(public PlayerInterface $player, public int $score)
    {
    }
}