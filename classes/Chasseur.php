<?php

namespace classes;
class Chasseur extends Character

{
    ///////////////////////////////////////////////////
    ////                    Stats                  ////
    //////////////////////////////////////////////////
    private $Potion;
    private $tirRapide;
    private $assasinat;
    private $coupDePied;
    private $maitriseBetes;
    private $tirMultiple;

    public function __construct($name, $picture)
    {
        parent::__construct($name);
        $this->pv *= 2;
        $this->agility *= 20;
        $this->picture = "/public/pictures/sylvanas.png";
    }

    ///////////////////////////////////////////////////
    ////                    Sorts                  ////
    //////////////////////////////////////////////////


    // Potion
    private function Potion()
    {
        $rand = rand(30, 60);
        $this->Potion = True;
        $this->pv += $rand;
        $status = "{$this->name} utilise une potion <img src='../public/pictures/Abilities5/potion.png' width=30px /> et se soigne de {$rand} PV!";
        return $status;
    }
    // Assasinat
    private function assasinat(Character $target)
    {
        $rand = rand(2, 5);
        if ($this->mana > 50) {
            $atk = floor($rand * ( $this->agility) / 8);
            $this->mana -= 50;
            $target->setLifePoints($atk);
            $status = "{$this->name} fais un Assassinat <img src='../public/pictures/Abilities3/Ability_hunter_assassinate2.png' width=30px /> et inflige {$atk} points de dégats!";
        } else {
            $status = "{$this->name} n'a plus de point d'énergie!";
        }
        return $status;
    }
    // Tir Rapide
    private function tirRapide(Character $target)
    {
        $rand = rand(2, 5);
        if ($this->mana > 15) {
            $atk = floor($rand * $this->agility / 6);
            $this->mana -= 15;
            $target->setLifePoints($atk);
            $status = "{$this->name} utilise Tire Rapide <img src='../public/pictures/Abilities3/Ability_hunter_fervor.png' width=30px /> et inflige {$atk} points de dégats! ";
        } else {
            $status = "{$this->name} n'a plus de point d'énergie!";
        }
        return $status;
    }

    // Coup de pied
    private function coupDePied(Character $target)
    {
        $rand = rand(2, 5);
        if ($this->mana > 15) {
            $atk = floor($rand * $this->agility / 6);
            $this->mana -= 15;
            $target->setLifePoints($atk);
            $status = "{$this->name} utilise Coup de Pieds <img src='../public/pictures/Abilities9/Ability_rogue_fleetfooted.png' width=30px /> et inflige {$atk} points de dégats! ";
        } else {
            $status = "{$this->name} n'a plus de point d'énergie!";
        }
        return $status;
    }

    // Maitrise des betes
    private function maitriseBete(Character $target)
    {
        $rand = rand(2, 5);
        if ($this->mana > 30) {
            $atk = floor($rand * $this->agility / 5);
            $this->mana -= 30;
            $target->setLifePoints($atk);
            $status = "{$this->name} lance Maitrise des Bêtes <img src='../public/pictures/Abilities3/Ability_hunter_fervor.png' width=30px /> et inflige {$atk} points de dégats! ";
        } else {
            $target->setLifePoints(2);
            $status = "{$this->name} n'a plus de point d'énergie!";
        }
        return $status;
    }
    // Attaque simple
    private function coupArc(Character $target)
    {
        $attack = floor(rand(3, 7) * $this->agility / 10);
        $target->setlifePoints($attack);
        $status = "{$this->name} Tire à l'arc <img src='../public/pictures/wow/Weapons/INV_Weapon_Bow_08.png' width=30px />  et inflige {$attack} points de dégats! ";
        return $status;
    }

    // Tire Multiple
    private function tirMultiple(Character $target)
    {
        $rand = rand(2, 5);
        if ($this->mana > 50) {
            $atk = floor($rand * ($this->agility) / 8);
            $this->mana -= 50;
            $target->setLifePoints($atk);
            $status = "{$this->name} fais un Tir Multiple <img src='../public/pictures/Abilities5/Ability_hunter_thrillofthehunt.png' width=30px /> et inflige {$atk} points de dégats!";
        } else {
            $status = "{$this->name} n'a plus de point d'énergie!";
        }
        return $status;
    }

    ///////////////////////////////////////////////////
    ////              Random Sorts                 ////
    //////////////////////////////////////////////////

    public function attack(Character $target)
    {
        $rand = rand(1, 100);
        if ($rand < 10) {
            $status = $this->potion(); // On regénère la vie !
        } else if ($rand > 10 && $rand < 20) {
            $status = $this->maitriseBete($target); // 
        } else if ($rand > 20 && $rand < 27) {
            $status = $this->assasinat($target); // 
        } else if ($rand > 27 && $rand < 35) {
            $status = $this->coupDePied($target); // 
        } else if ($rand > 35 && $rand < 65) {
            $status = $this->tirMultiple($target); // 
        } else if ($rand > 65 && $rand < 90) {
            $status = $this->tirRapide($target); // 
        } else {
            $status = $this->coupArc($target); //
        }
        return $status;
    }
}
