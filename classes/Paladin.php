<?php
namespace classes;

class Paladin extends Character
{
    ///////////////////////////////////////////////////
    ////                    Stats                  ////
    //////////////////////////////////////////////////

    private $soin = False; // soin
    private $lancerBouclier; // attaque physique
    private $coupEpee; // attaque normale
    private $egideDivine = False; // bouclier
    private $lumiereDivine = False; // attaque qui soigne
    private $concecration; // attaque magique
    private $marteauDeCourroux; // attaque M/P

    public function __construct($name, $picture) {
        parent :: __construct($name);
        $this->maitrise *= 10;
        $this->intel *= 15;
        $this->pv *= 2;
        $this->force *= 15;
        $this->picture = "/public/pictures/arthas.jpg";
    }
                    ///////////////////////////////////////////////////
                    ////                    Sorts                  ////
                    //////////////////////////////////////////////////


    // Soin
    private function soin() {
        $rand = floor (rand(3, 7) * $this->intel / 5);
        $this->soin = True;
        $this->pv += $rand;
        $this->mana -= 40;
        $status = "{$this->name} se lance Soin  <img src='../public/pictures/Spells6/sp.png' width=30px /> et se soigne de {$rand} PV!";
        return $status;
    }
    // Marteau du Courroux
    private function marteauDeCourroux(Character $target) {
        $rand = rand(2, 5);
        if ($rand <= $this->mana) {
            $atk = floor ($rand * ($this->intel + $this->force) /8);
            $this->mana -= 50;
            $target->setLifePoints($atk);
            $status = "{$this->name} lance Marteau du Courroux <img src='../public/pictures/Abilities8/marteau.png' width=30px /> et inflige {$atk} points de dégats!";
        } else {
            $target->setLifePoints(2);
            $status = "{$this->name} n'a plus de point de magie!";
        }
        return $status;
    }
    // Egide Divine
    private function egideDivine() {
        $rand = rand(3, 7) * $this->maitrise / 5;
        $this->mana -= 30;
        $this->pv += $rand ;
        $status = "{$this->name} utilise Egide Divine <img src='../public/pictures/Abilities8/egide.png' width=30px /> pour se protéger de {$rand} dégats! ";
        return $status;
    }

    // Lancer de Bouclier
    private function lancerBouclier(Character $target) {
        $rand = rand(2, 5);
        if ($rand <= $this->mana) {
            $atk = floor ($rand * $this->force / 6);
            $this->mana -= 15;
            $target->setLifePoints($atk);
            $status = "{$this->name} utilise Bouclier Vengeur <img src='../public/pictures/Abilities8/lancer.png' width=30px /> et inflige {$atk} points de dégats! ";
        } else {
            $target->setLifePoints(2);
            $status = "{$this->name} n'a plus de point de magie!";
        }
        return $status;
    }

    // Concécration
    private function concecration(Character $target) {
        $rand = rand(2, 5);
        if ($rand <= $this->mana) {
            $atk = floor ($rand * $this->intel / 5);
            $this->mana -= 30;
            $target->setLifePoints($atk);
            $status = "{$this->name} lance Concécration <img src='../public/pictures/Spells6/concecration.png' width=30px />  et inflige {$atk} points de dégats! ";
        } else {
            $target->setLifePoints(2);
            $status = "{$this->name} n'a plus de point de magie!";
        }
        return $status;
    }
    // Attaque simple
    private function coupEpee(Character $target) {
        $attack = floor (rand(3, 7) * $this->force / 10);
        $target->setlifePoints($attack);
        $status = "{$this->name} attaque à l'épée <img src='../public/pictures/Abilities8/epee.png' width=30px />  et inflige {$attack} points de dégats! ";
        return $status;
    }

    // Attaque qui soigne
    private function lumiereDivine($target) {
        $rand = rand(2, 5);
        if ($this->mana > 25) {
            $atk = floor ($rand * $this->force / 7);
            $this->mana -= 25;
            $target->setLifePoints($atk);
            $rand = floor (rand(3, 7) * $this->intel / 10);
        $this->lumiereDivine = True;
        $this->pv += $rand;
            $status = "{$this->name} utilise Lumière Divine <img src='../public/pictures/Spells7/retribution.png' width=30px /> , {$rand} PV restaurés et {$atk} dégats infligés  ";
        } else {
            $target->setLifePoints(2);
            $status = "{$this->name} n'a plus de point de magie!";
        }
        return $status;
    }

                ///////////////////////////////////////////////////
                ////              Random Sorts                 ////
                //////////////////////////////////////////////////

    public function attack(Character $target) {
        $rand = rand(1, 100);
        if ($rand < 10 ) {
            $status = $this->soin($target); // On regénère la vie !
        }
        else if ($rand > 10 && $rand < 20) {
            $status = $this->egideDivine(); // On se protège !
        }
        else if ($rand > 20 && $rand < 27) {
            $status = $this->marteauDeCourroux($target); // Big attaque
        }
        else if ($rand > 27 && $rand < 35) {
            $status = $this->lumiereDivine($target); // Boost
        }
        else if ($rand > 35 && $rand < 65) {
            $status = $this->lancerBouclier($target); // attaque physique
        }
        else if ($rand > 65 && $rand < 90) {
            $status = $this->concecration($target); // Attaque Magique
        }
        else{
            $status = $this->coupEpee($target); // Attaque à l'épée' !
        }
        return $status;
    }
}