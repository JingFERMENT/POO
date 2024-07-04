<?php

declare(strict_types=1);

namespace App\MatchMaker\Player;

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

// A trait is a mechanism for code reuse in single inheritance languages like PHP. 
// Traits allow you to group methods and properties that you can then include in multiple classes.

 trait UserAware {
    protected User $author;
   
    public function getAuthor() {
        return $this->author;
    }   
   
    public function setAuthor(User $author) {
        $this->author = $author;
    }
}

