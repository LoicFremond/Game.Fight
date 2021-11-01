<?php
namespace classes;

class Druide extends Character
{
    ///////////////////////////////////////////////////
    ////                    Stats                  ////
    //////////////////////////////////////////////////
    private $nourir;
    private $eclatLunaire;
    private $ravage;
    private $typhon;
    private $attaqueSurprise;
    private $griffure;

    public function __construct($name, $picture) {
        parent :: __construct($name);
        $this->pv *= 2;
        $this->agility *= 20;
        $this->intel *= 20;
        $this->picture = "/public/pictures/malfurion.jpg";
    }
                    ///////////////////////////////////////////////////
                    ////                    Sorts                  ////
                    //////////////////////////////////////////////////


    // Nourir
    private function nourir() {
        if ($this->mana > 20) {
            $rand = floor(rand(2, 5) * $this->intel / 7);
            $this->nourir = true;
            $this->pv += $rand;
            $this->mana -= 20;
            $status = "{$this->name} se lance Nourir <img src='../public/pictures/Abilities2/Ability_druid_nourish.png' width=30px /> et se soigne de {$rand} PV!";
        } else {
            $status = "{$this->name} n'a plus de point de magie!";
        }
        return $status;
    }
    // Ravage

    private function ravage(Character $target) {
        $rand = rand(2, 5);
        if ($this->mana > 50) {
            $atk = floor ($rand * ($this->agility) /8);
            $this->mana -= 50;
            $target->setLifePoints($atk);
            $status = "{$this->name} fais un ravage <img src='../public/pictures/Abilities2/Ability_druid_ravage.png' width=30px /> et inflige {$atk} points de dégats!";
        } else {
            $status = "{$this->name} n'a plus de point d'énergie!";
        }
        return $status;
    }
    // Eclat Lunaire
    private function eclatLunaire(Character $target) {
        $rand = rand(2, 5);
        if ($this->mana > 25) {
            $atk = floor ($rand * $this->intel / 6);
            $this->mana -= 25;
            $target->setLifePoints($atk);
            $status = "{$this->name} utilise Eclat Lunaire <img src='../public/pictures/Abilities2/Ability_druid_starfall.png' width=30px /> et inflige {$atk} points de dégats! ";
        } else {
            $status = "{$this->name} n'a plus de point d'énergie!";
        }
        return $status;
    }

    // Griffure
    private function griffure(Character $target) {
        $rand = rand(2, 5);
        if ($this->mana > 20) {
            $atk = floor ($rand * $this->agility / 6);
            $this->mana -= 20;
            $target->setLifePoints($atk);
            $status = "{$this->name} utilise Griffure <img src='../public/pictures/Abilities2/Ability_druid_rake.png' width=30px /> et inflige {$atk} points de dégats! ";
        } else {
            $status = "{$this->name} n'a plus de point d'énergie!";
        }
        return $status;
    }

    // Attaque Surprise
    private function attaqueSurprise(Character $target) {
        $rand = rand(2, 5);
        if ($this->mana > 30) {
            $atk = floor ($rand * $this->agility / 5);
            $this->mana -= 30;
            $target->setLifePoints($atk);
            $status = "{$this->name} lance Attaque Surprise <img src='../public/pictures/Abilities2/Ability_druid_supriseattack.png' width=30px /> et inflige {$atk} points de dégats! ";
        } else {
            $target->setLifePoints(2);
            $status = "{$this->name} n'a plus de point d'énergie!";
        }
        return $status;
    }
    // Attaque simple
    private function coupBaton(Character $target) {
        $attack = floor (rand(3, 7) * $this->agility / 10);
        $target->setlifePoints($attack);
        $status = "{$this->name} attaque au bâton <img src='../public/pictures/wow/Weapons/INV_Staff_30.png' width=30px /> et inflige {$attack} points de dégats! ";
        return $status;
        
    }
    // Typhon
    private function typhon(Character $target) {
        $rand = rand(2, 5);
        if ($this->mana > 50) {
            $atk = floor ($rand * $this->intel / 5);
            $this->mana -= 50;
            $target->setLifePoints($atk);
            $status = "{$this->name} lance Typhon <img src='../public/pictures/Abilities2/Ability_druid_typhoon.png' width=30px /> et inflige {$atk} points de dégats! ";
        } else {
            $target->setLifePoints(2);
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
            $status = $this->nourir(); // On regénère la vie !
        }
        else if ($rand > 10 && $rand < 20) {
            $status = $this->griffure($target); // 
        }
        else if ($rand > 20 && $rand < 27) {
            $status = $this->typhon($target); //
        }
        else if ($rand > 27 && $rand < 35) {
            $status = $this->attaqueSurprise($target); // 
        }
        else if ($rand > 35 && $rand < 65) {
            $status = $this->eclatLunaire($target); // 
        }
        else if ($rand > 65 && $rand < 90) {
            $status = $this->ravage($target); // 
        }
        else{
            $status = $this->coupBaton($target); // 
        }
        return $status;
    }
}