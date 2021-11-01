<?php

namespace classes;

class DeathKnight extends Character
{
    ///////////////////////////////////////////////////
    ////                    Stats                  ////
    //////////////////////////////////////////////////

    private $empriseFielsang;
    private $frappeCoeur;
    private $furoncleSanglant;
    private $carresseMort;
    private $faucheurAme;
    private $dechirureMoelle;

    public function __construct($name, $picture)
    {
        parent::__construct($name);
        $this->pv *= 2;
        $this->force *= 20;
        $this->picture = "/public/pictures/mograine.jpg";
    }
    ///////////////////////////////////////////////////
    ////                    Sorts                  ////
    //////////////////////////////////////////////////


    // Attaque qui soigne
    private function empriseFielsang($target)
    {
        $rand = rand(2, 5);
        if ($this->mana > 25) {
            $atk = floor($rand * $this->force / 8);
            $target->setLifePoints($atk);
            $rand = floor(rand(2, 5) * $this->force / 15);
            $this->empriseFielsang = True;
            $this->pv += $rand;
            $this->mana -= 25;
            $status = "{$this->name} utilise Emprise de Fielsang <img src='../public/pictures/wow/Spells/Spell_Shadow_Metamorphosis.png' width=30px /> , {$rand} PV restaurés et {$atk} dégats infligés";
        } else {
            $status = "{$this->name} n'a plus de point d'énergie!";
        }
        return $status;
    }
    // Attaque qui soigne
    private function frappeCoeur($target)
    {
        $rand = rand(2, 5);
        if ($this->mana > 30) {
            $atk = floor($rand * $this->force / 8);
            $target->setLifePoints($atk);
            $rand = floor(rand(2, 5) * $this->force / 15);
            $this->frappeCoeur = True;
            $this->pv += $rand;
            $this->mana -= 30;
            $status = "{$this->name} utilise Frappe au Coeur <img src='../public/pictures/wow/Spells/Spell_Shadow_DeathPact.png' width=30px /> , {$rand} PV restaurés et {$atk} dégats infligés";
        } else {
            $status = "{$this->name} n'a plus de point d'énergie!";
        }
        return $status;
    }
    // Carresse de Mort
    private function carresseMort($target)
    {
        $rand = rand(2, 5);
        if ($rand <= $this->mana) {
            $atk = floor ($rand * $this->force / 7);
            $this->mana -= 15;
            $target->setLifePoints($atk);
            $status = "{$this->name} utilise Carresse de la Mort <img src='../public/pictures/wow/Spells/Spell_Shadow_DeathScream.png' width=30px /> et inflige {$atk} points de dégats ";
        } else {
            $target->setLifePoints(2);
            $status = "{$this->name} n'a plus de point de magie!";
        }
        return $status;
    }

    // Attaque qui soigne
    private function faucheurAme($target)
    {
        $rand = rand(2, 5);
        if ($this->mana > 40) {
            $atk = floor($rand * $this->force / 7);
            $target->setLifePoints($atk);
            $rand = floor(rand(3, 6) * $this->force / 10);
            $this->appelSinistre = True;
            $this->pv += $rand;
            $this->mana -= 40;
            $status = "{$this->name} utilise Faucheur d'âme <img src='../public/pictures/wow/Spells/Spell_Shadow_DarkRitual.png' width=30px /> , {$rand} PV restaurés et {$atk} dégats infligés";
        } else {
            $status = "{$this->name} n'a plus de point d'énergie!";
        }
        return $status;
    }
    // Attaque qui soigne
    private function dechirureMoelle($target)
    {
        $rand = rand(2, 5);
        if ($rand <= $this->mana) {
            $atk = floor ($rand * $this->force / 7);
            $this->mana -= 15;
            $target->setLifePoints($atk);
            $status = "{$this->name} utilise Déchirure de moelle <img src='../public/pictures/wow/Spells/Spell_Shadow_RitualOfSacrifice.png' width=30px /> et inflige {$atk} points de dégats ";
        } else {
            $status = "{$this->name} n'a plus de point d'énergie!";
        }
        return $status;
    }

    // Attaque qui soigne
    private function furoncleSanglant($target)
    {
        $rand = rand(2, 5);
        if ($this->mana > 30) {
            $atk = floor($rand * $this->force / 9);
            $target->setLifePoints($atk);
            $rand = floor(rand(3, 7) * $this->force / 12);
            $this->appelSinistre = True;
            $this->pv += $rand;
            $this->mana -= 30;
            $status = "{$this->name} utilise Furoncle sanglant <img src='../public/pictures/wow/Spells/Spell_Shadow_BloodBoil.png' width=30px /> , {$rand} PV restaurés et {$atk} dégats infligés";
        } else {
            $status = "{$this->name} n'a plus de point d'énergie!";
        }
        return $status;
    }
    // Attaque simple
    private function coupEpee(Character $target)
    {
        $attack = floor(rand(3, 7) * $this->force / 10);
        $target->setlifePoints($attack);
        $status = "{$this->name} attaque à l'épée <img src='../public/pictures/wow/Weapons/INV_Sword_48.png' width=30px /> et inflige {$attack} points de dégats! ";
        return $status;
    }


    ///////////////////////////////////////////////////
    ////              Random Sorts                 ////
    //////////////////////////////////////////////////

    public function attack(Character $target)
    {
        $rand = rand(1, 100);
        if ($rand < 10) {
            $status = $this->empriseFielsang($target); //
        } else if ($rand > 10 && $rand < 20 ) {
            $status = $this->frappeCoeur($target); // 
        } else if ($rand > 20 && $rand < 27) {
            $status = $this->furoncleSanglant($target); //
        } else if ($rand > 27 && $rand < 35) {
            $status = $this->carresseMort($target); // 
        } else if ($rand > 35 && $rand < 65) {
            $status = $this->dechirureMoelle($target); // 
        } else if ($rand > 65 && $rand < 90) {
            $status = $this->FaucheurAme($target); // 
        } else {
            $status = $this->coupEpee($target); // 
        }
        return $status;
    }
}
