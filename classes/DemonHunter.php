<?php
namespace classes;

class DemonHunter extends Character
{
    ///////////////////////////////////////////////////
    ////                    Stats                  ////
    //////////////////////////////////////////////////
    
    private $Potion;
    private $sombreEntaille;
    private $frappeChaos;
    private $novaChaos;
    private $eruptionGangrenee;
    private $rayonAccablant;

    public function __construct($name, $picture) {
        parent :: __construct($name); 
        $this->pv *= 2;
        $this->agility *= 20;
        $this->picture = "/public/pictures/illidan.jpg";
    }
                    ///////////////////////////////////////////////////
                    ////                    Sorts                  ////
                    //////////////////////////////////////////////////


    // Potion
    private function Potion() {
        $rand = rand (30, 60);
        $this->Potion = True;
        $this->pv += $rand;
        $status = "{$this->name} utilise une potion <img src='../public/pictures/Abilities5/potion.png' width=30px /> et se soigne de {$rand} PV!";
        return $status;
    }
    // Frappe du Chaos
    private function frappeChaos(Character $target) {
        $rand = rand(2, 5);
        if ($this->mana > 50) {
            $atk = floor ($rand * ($this->agility) /7);
            $this->mana -= 50;
            $target->setLifePoints($atk);
            $status = "{$this->name} fais un Frappe du Chaos <img src='../public/pictures/dh/fc.jpg' width=30px /> et inflige {$atk} points de dégats!";
        } else {
            $status = "{$this->name} n'a plus de point d'énergie!";
        }
        return $status;
    }
    // Sombre Entaille
    private function sombreEntaille(Character $target) {
        $rand = rand(2, 5);
        if ($this->mana > 15) {
            $atk = floor ($rand * $this->agility / 6);
            $this->mana -= 15;
            $target->setLifePoints($atk);
            $status = "{$this->name} utilise Sombre Entaille <img src='../public/pictures/dh/se.jpg' width=30px /> et inflige {$atk} points de dégats! ";
        } else {
            $status = "{$this->name} n'a plus de point d'énergie!";
        }
        return $status;
    }

    // Nova du Chaos
    private function novaChaos(Character $target) {
        $rand = rand(2, 5);
        if ($this->mana > 15) {
            $atk = floor ($rand * $this->agility / 6);
            $this->mana -= 15;
            $target->setLifePoints($atk);
            $status = "{$this->name} utilise Nova du Chaos <img src='../public/pictures/dh/nc.jpg' width=30px /> et inflige {$atk} points de dégats! ";
        } else {
            $status = "{$this->name} n'a plus de point d'énergie!";
        }
        return $status;
    }

    // Erruption Gangrénée
    private function erruptionGangrenee(Character $target) {
        $rand = rand(2, 5);
        if ($this->mana > 30) {
            $atk = floor ($rand * $this->agility / 5);
            $this->mana -= 30;
            $target->setLifePoints($atk);
            $status = "{$this->name} lance Erruption Gangrénée <img src='../public/pictures/dh/eg.jpg' width=30px />  et inflige {$atk} points de dégats! ";
        } else {
            $target->setLifePoints(2);
            $status = "{$this->name} n'a plus de point d'énergie!";
        }
        return $status;
    }
    // Attaque simple
    private function coupGlaive(Character $target) {
        $attack = floor (rand(3, 7) * $this->agility / 10);
        $target->setlifePoints($attack);
        $status = "{$this->name} attaque avec ses Glaives <img src='../public/pictures/dh/g.jpg' width=30px /> et inflige {$attack} points de dégats! ";
        return $status;
    }

    // Rayon Accablant
    private function rayonAccablant($target) {
        $rand = rand(2, 5);
        if ($this->mana > 40) {
            $atk = floor ($rand * $this->agility / 6);
            $target->setLifePoints($atk);
            $rand = floor (rand(2, 5) * $this->agility / 10);
        $this->rayonAccablant = True;
        $this->pv += $rand;
        $this->mana -= 40;
            $status = "{$this->name} utilise Appel Sinistre <img src='../public/pictures/dh/ar.jpg' width=30px /> , {$rand} PV restaurés et {$atk} dégats infligés";
        } else {
            $status = "{$this->name} n'a plus de point d'énergie!";
        }
        return $status;
    }

                ///////////////////////////////////////////////////
                ////              Random Sorts                 ////
                //////////////////////////////////////////////////

    public function attack(Character $target) {
        $rand = rand(1, 100);
        if ($rand < 10 ) {
            $status = $this->potion(); // On regénère la vie !
        }
        else if ($rand > 10 && $rand < 20) {
            $status = $this->novaChaos($target); // 
        }
        else if ($rand > 20 && $rand < 27) {
            $status = $this->frappeChaos($target); // 
        }
        else if ($rand > 27 && $rand < 35) {
            $status = $this->rayonAccablant($target); // 
        }
        else if ($rand > 35 && $rand < 65) {
            $status = $this->erruptionGangrenee($target); // 
        }
        else if ($rand > 65 && $rand < 90) {
            $status = $this->sombreEntaille($target); // 
        }
        else{
            $status = $this->coupGlaive($target); // 
        }
        return $status;
    }
}