<?php

namespace classes;

class Character
{
    public const MAX_LIFE = 2000;
    public const MAX_MANA = 800;
    public $name;
    public $pv = 1000; // points de vie
    public $mana = 800; // utilisation sort
    // public $rage = 1000; // utilisation attaque
    // public $energy = 1000; //utilisation attaque
    public $maitrise = 10; // puissance bouclier
    public $force = 10; // puissance attaque
    public $intel = 10; // puissance sort
    public $agility = 10; // puissance attaque


    function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getLifePoints()
    {
        return $this->pv;
    }

    public function setLifePoints($dmg)
    {
        $this->pv -= round($dmg);
        if ($this->pv < 0) {
            $this->pv = 0;
        }
        return;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getImg(): string
    {
        return $this->picture;
    }
    public function isAlive(): bool
    {
        return $this->getLifePoints() > 0;
    }
}
