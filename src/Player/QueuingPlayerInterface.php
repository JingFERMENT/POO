<?php

declare(strict_types=1);

namespace App\Player;

interface QueuingPlayerInterface
{
    public function getPlayer(): PlayerInterface;

    public function getRange(): int;

    public function upgradeRange(): void;

    public function updateRatioAgainst(PlayerInterface $player, int $result): void;
}
