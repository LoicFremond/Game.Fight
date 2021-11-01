<?php
namespace classes;
// images sorts !!!!
class Guerrier extends Character
{
    ///////////////////////////////////////////////////
    ////                    Stats                  ////
    //////////////////////////////////////////////////
    private $Potion;
    private $tourbillon;
    private $execution;
    private $charge;
    private $briseGenoux;
    private $criDeGuerre;

    public function __construct($name, $picture) {
        parent :: __construct($name);
        $this->pv *= 2;
        $this->force *= 20;
        $this->picture = "/public/pictures/varian.jpg";
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
    // Execution
    private function execution(Character $target) {
        $rand = rand(2, 5);
        if ($this->mana > 50) {
            $atk = floor ($rand * ($this->mana + $this->force) /8);
            $this->mana -= 50;
            $target->setLifePoints($atk);
            $status = "{$this->name} fais une Execution <img src='../public/pictures/Abilities8/marteau.png' width=30px /> et inflige {$atk} points de dégats!";
        } else {
            $status = "{$this->name} n'a plus de point d'énergie!";
        }
        return $status;
    }
    // tourbillon
    private function tourbillon(Character $target) {
        $rand = rand(2, 5);
        if ($this->mana > 15) {
            $atk = floor ($rand * $this->force / 6);
            $this->mana -= 15;
            $target->setLifePoints($atk);
            $status = "{$this->name} utilise tourbillon <img src='../public/pictures/Abilities8/lancer.png' width=30px /> et inflige {$atk} points de dégats! ";
        } else {
            $status = "{$this->name} n'a plus de point d'énergie!";
        }
        return $status;
    }

    // Brise Genoux
    private function briseGenoux(Character $target) {
        $rand = rand(2, 5);
        if ($this->mana > 15) {
            $atk = floor ($rand * $this->force / 6);
            $this->mana -= 15;
            $target->setLifePoints($atk);
            $status = "{$this->name} utilise Brise Genoux <img src='../public/pictures/Abilities8/lancer.png' width=30px /> et inflige {$atk} points de dégats! ";
        } else {
            $status = "{$this->name} n'a plus de point d'énergie!";
        }
        return $status;
    }

    // Charge
    private function charge(Character $target) {
        $rand = rand(2, 5);
        if ($this->mana > 30) {
            $atk = floor ($rand * $this->force / 5);
            $this->mana -= 30;
            $target->setLifePoints($atk);
            $status = "{$this->name} lance charge <img src='../public/pictures/Spells6/concecration.png' width=30px />  et inflige {$atk} points de dégats! ";
        } else {
            $target->setLifePoints(2);
            $status = "{$this->name} n'a plus de point d'énergie!";
        }
        return $status;
    }
    // Attaque simple
    private function coupEpee(Character $target) {
        $attack = floor (rand(3, 7) * $this->force / 10);
        $target->setlifePoints($attack);
        $status = "{$this->name} attaque à l'épée' <img src='../public/pictures/Abilities8/epee.png' width=30px />  et inflige {$attack} points de dégats! ";
        return $status;
    }

    // Attaque qui soigne
    private function criDeGuerre($target) {
        $rand = rand(2, 5);
        if ($this->mana > 40) {
            $atk = floor ($rand * $this->force / 7);
            $target->setLifePoints($atk);
            $rand = floor (rand(3, 7) * $this->force / 10);
        $this->criDeGuerre = True;
        $this->pv += $rand;
        $this->mana -= 40;
            $status = "{$this->name} utilise Cri de Guerre <img src='../public/pictures/Spells7/retribution.png' width=30px /> , {$rand} PV restaurés et {$atk} dégats infligés ";
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
            $status = $this->charge($target); // 
        }
        else if ($rand > 20 && $rand < 27) {
            $status = $this->execution($target); // Coup de Grace
        }
        else if ($rand > 27 && $rand < 35) {
            $status = $this->criDeGuerre($target); // 
        }
        else if ($rand > 35 && $rand < 65) {
            $status = $this->briseGenoux($target); // 
        }
        else if ($rand > 65 && $rand < 90) {
            $status = $this->tourbillon($target); // 
        }
        else{
            $status = $this->coupEpee($target); // 
        }
        return $status;
    }
}