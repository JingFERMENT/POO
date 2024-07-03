<?php

declare(strict_types=1);

class Lobby
{
    public array $queuingPlayers = [];

    public function findOpponents(QueuingPlayer $player): array
    {
        $minLevel = round($player->getRatio() / 100);
        $maxLevel = $minLevel + $player->getRange();

        return array_filter($this->queuingPlayers, static function (QueuingPlayer $potentialOpponent) use ($minLevel, $maxLevel, $player) {
            $playerLevel = round($potentialOpponent->getRatio() / 100);

            return $player!== $potentialOpponent && ($minLevel <= $playerLevel) && ($playerLevel <= $maxLevel);
        });
    }

    public function addPlayer(Player $player): void
    {
        $this->queuingPlayers[] = new QueuingPlayer($player);
    }

    public function addPlayers(Player ...$players): void
    {
        foreach ($players as $player) {
            $this->addPlayer($player);
        }
    }
}

abstract class User
{
    public function __construct(public string $name = 'anonymous', public float $ratio = 400.0)
    {
    }

    abstract public function getName(): string;

    abstract public function getRatio(): float;

    abstract protected function probabilityAgainst(self $player): float;

    abstract public function updateRatioAgainst(self $player, int $result): void;
}

class Player extends User
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

final class QueuingPlayer extends Player
{

    public function __construct(User $player, protected int $range = 1)
    {

        parent::__construct($player->getName(), $player->getRatio());
    }


    public function getRange(): int
    {
        return $this->range;
    }

    public function upgradeRange()
    {
        $this->range = min($this->range + 1, 40);
    }
}


final class BlitzPlayer  extends Player {
    public function __construct(public string $name = 'anonymous', public float $ratio = 1200.0)
    {
        parent::__construct($name, $ratio);
    }

    public function updateRatioAgainst(User $player, int $result): void
    {
        $this->ratio += 128 * ($result - $this->probabilityAgainst($player));
    }


}

$greg = new Player('greg');
$jade = new Player('jade');


$lobby = new Lobby();


$lobby->addPlayers($greg, $jade);

var_dump($lobby->findOpponents($lobby->queuingPlayers[0]));

exit(0);
