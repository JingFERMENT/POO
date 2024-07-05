<?php 

declare(strict_types=1);

namespace App\MatchMaker\Player;
    
class QueuingPlayer
    {  
        protected int $range = 1;

        // Constructeur de la classe acceptant un objet implémentant l'interface PlayerInterface
        public function __construct(protected PlayerInterface $player )
        {
        }

        // Méthode pour obtenir l'objet joueur
        public function getPlayer():PlayerInterface {
            return $this->player;
        }

        public function getName():string {
            return $this->player->getName();
        }

        public function getRatio():float {
            return $this->player->getRatio();
        }

        public function getRange(): int
        {
            return $this->range;
        }

        public function upgradeRange():void
        {
            $this->range = min($this->range + 1, 40);
        }

        
       
    }

 