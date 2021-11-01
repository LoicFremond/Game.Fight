<?php
namespace classes;

class Voleur extends Character
{
    ///////////////////////////////////////////////////
    ////                    Stats                  ////
    //////////////////////////////////////////////////
    private $Potion;
    private $rupture;
    private $coupDeGrace;
    private $coupDePied;
    private $shadowDanse;
    private $appelSinistre;

    public function __construct($name, $picture) {
        parent :: __construct($name); 
        $this->pv *= 2;
        $this->agility *= 20;
        $this->picture = "/public/pictures/garona.jpg";
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
    // Coup de grâce
    private function coupDeGrace(Character $target) {
        $rand = rand(2, 5);
        if ($this->mana > 50) {
            $atk = floor ($rand * ($this->mana + $this->agility) /8);
            $this->mana -= 50;
            $target->setLifePoints($atk);
            $status = "{$this->name} fais un coup de grâce <img src='../public/pictures/Abilities3/Ability_gouge.png' width=30px /> et inflige {$atk} points de dégats!";
        } else {
            $status = "{$this->name} n'a plus de point d'énergie!";
        }
        return $status;
    }
    // Rupture
    private function rupture(Character $target) {
        $rand = rand(2, 5);
        if ($this->mana > 15) {
            $atk = floor ($rand * $this->agility / 6);
            $this->mana -= 15;
            $target->setLifePoints($atk);
            $status = "{$this->name} utilise Rupture <img src='../public/pictures/Abilities10/Ability_rogue_rupture.png' width=30px /> et inflige {$atk} points de dégats! ";
        } else {
            $status = "{$this->name} n'a plus de point d'énergie!";
        }
        return $status;
    }

    // Coup de pied
    private function coupDePied(Character $target) {
        $rand = rand(2, 5);
        if ($this->mana > 15) {
            $atk = floor ($rand * $this->agility / 6);
            $this->mana -= 15;
            $target->setLifePoints($atk);
            $status = "{$this->name} utilise Coup de Pieds <img src='../public/pictures/Abilities9/Ability_rogue_fleetfooted.png' width=30px /> et inflige {$atk} points de dégats! ";
        } else {
            $status = "{$this->name} n'a plus de point d'énergie!";
        }
        return $status;
    }

    // Danse de l'ombre
    private function shadowDance(Character $target) {
        $rand = rand(2, 5);
        if ($this->mana > 30) {
            $atk = floor ($rand * $this->agility / 5);
            $this->mana -= 30;
            $target->setLifePoints($atk);
            $status = "{$this->name} lance Danse de l'Ombre <img src='../public/pictures/Abilities9/Ability_rogue_envelopingshadows.png' width=30px />  et inflige {$atk} points de dégats! ";
        } else {
            $target->setLifePoints(2);
            $status = "{$this->name} n'a plus de point d'énergie!";
        }
        return $status;
    }
    // Attaque simple
    private function coupDague(Character $target) {
        $attack = floor (rand(3, 7) * $this->agility / 10);
        $target->setlifePoints($attack);
        $status = "{$this->name} attaque à la dague <img src='../public/pictures/Abilities9/Ability_rogue_fanofknives.png' width=30px />  et inflige {$attack} points de dégats! ";
        return $status;
    }

    // Attaque qui soigne
    private function appelSinistre($target) {
        $rand = rand(2, 5);
        if ($this->mana > 40) {
            $atk = floor ($rand * $this->agility / 7);
            $target->setLifePoints($atk);
            $rand = floor (rand(3, 7) * $this->agility / 10);
        $this->appelSinistre = True;
        $this->pv += $rand;
        $this->mana -= 40;
            $status = "{$this->name} utilise Appel Sinistre <img src='../public/pictures/Spells7/retribution.png' width=30px /> , {$rand} PV restaurés et {$atk} dégats infligés ";
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
            $status = $this->coupDePied($target); // 
        }
        else if ($rand > 20 && $rand < 27) {
            $status = $this->coupDeGrace($target); // Coup de Grace
        }
        else if ($rand > 27 && $rand < 35) {
            $status = $this->appelSinistre($target); // 
        }
        else if ($rand > 35 && $rand < 65) {
            $status = $this->shadowDance($target); // 
        }
        else if ($rand > 65 && $rand < 90) {
            $status = $this->rupture($target); // 
        }
        else{
            $status = $this->coupDague($target); // Attaque à la dague' !
        }
        return $status;
    }
}