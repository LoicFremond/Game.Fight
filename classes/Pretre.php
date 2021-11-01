<?php
namespace classes;

class Pretre extends Character
{
                    ///////////////////////////////////////////////////
                    ////                    Stats                  ////
                    //////////////////////////////////////////////////
    private $soinRapide  = False;
    private $penitence;
    private $coupBaguette;
    private $feuSacré;
    private $atkMentale;
    private $soin = False;
    private $bouclier = False;


    public function __construct($name, $picture) {
        parent :: __construct($name);
        $this->maitrise *= 20;
        $this->intel *= 20;
        $this->pv *= 2;
        $this->picture = "/public/pictures/anduin.jpg";
    }
                    ///////////////////////////////////////////////////
                    ////                    Sorts                  ////
                    //////////////////////////////////////////////////

    // Soin rapide
    private function soinRapide() {
        if ($this->mana > 20) {
        $rand = floor (rand(2, 5) * $this->intel / 5);
        $this->soinRapide = True;
        $this->pv += $rand;
        $this->mana -= 20;
        $status = "{$this->name} se lance Soin Rapide <img src='../public/pictures/Spells7/soin.png' width=30px /> et se soigne de {$rand} PV!";
    } else {
        $status = "{$this->name} n'a plus de point de magie!";
    }
    return $status;
    }
    // Soin
    private function soin() {
        if ($this->mana > 40) {
        $rand = floor (rand(3, 7) * $this->intel / 5);
        $this->soin = True;
        $this->pv += $rand;
        $this->mana -= 40;
        $status = "{$this->name} se lance Soin <img src='../public/pictures/Spells7/sr.png' width=30px /> et se soigne de {$rand} PV!";
    } else {
        $status = "{$this->name} n'a plus de point de magie!";
    }
    return $status;
    }
    // Pénitence
    private function penitence(Character $target) {
        $rand = rand(2, 5);
        if ($this->mana > 10) {
            $atk = floor ($rand * $this->intel / 6);
            $this->mana -= 10;
            $target->setLifePoints($atk);
            $status = " {$this->name} lance Pénitence <img src='../public/pictures/Spells6/chatiment.png' width=30px /> et inflige {$atk} points de dégats!";
        } else {
            $status = "{$this->name} n'a plus de point de magie!";
        }
        return $status;
    }
    // Attaque simple
    private function coupBaguette(Character $target) {
        $attack = rand(10, 20);
        $target->setlifePoints($attack);
        $status = "{$this->name} utilise sa baguette <img src='../public/pictures/Wands/bag.png' width=30px />  et inflige {$attack} points de dégats!";
        return $status;
    }
    // Bouclier
    private function bouclier() {
        if ($this->mana > 30) {
        $rand = rand(2, 5) * $this->maitrise / 5;
        $this->shield = True;
        $this->mana -= 30;
        $this->pv += $rand ;
        $status = "{$this->name} lance Bouclier <img src='../public/pictures/Spells6/bouclier.png' width=30px /> pour se protéger de {$rand} dégats!";
    } else {
        $status = "{$this->name} n'a plus de point de magie!";
    }
    return $status;
    }

    // Feu Sacré
    private function feuSacré(Character $target) {
        $rand = rand(2, 5);
        if ($this->mana > 15) {
            $atk = floor ($rand * $this->intel / 6);
            $this->mana -= 15;
            $target->setLifePoints($atk);
            $status = "{$this->name} lance Feu Sacré <img src='../public/pictures/Spells7/fs.png' width=30px /> sur {$target->name}! Et inflige {$atk} points de dégats!";
        } else {
            $status = "{$this->name} n'a plus de point de magie!";
        }
        return $status;
    }

    // Attaque Mentale
    private function atkMentale(Character $target) {
        $rand = rand(2, 5);
        if ($this->mana > 30) {
            $atk = floor ($rand * $this->intel / 5);
            $this->mana -= 30;
            $target->setLifePoints($atk);
            $status = "{$this->name} lance Attaque Mentale <img src='../public/pictures/Abilities8/am.png' width=30px />  sur {$target->name}! Et inflige {$atk} points de dégats!";
        } else {
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
                $status = $this->soinRapide($target); // On regénère la vie !
            }
            else if ($rand > 10 && $rand < 20) {
                $status = $this->bouclier(); // On se protège !
            }
            else if ($rand > 20 && $rand < 27) {
                $status = $this->soin(); // On regénère la vie encore plus !
            }
            else if ($rand > 27 && $rand < 55) {
                $status = $this->penitence($target); // Pénitence
            }
            else if ($rand > 55 && $rand < 75) {
                $status = $this->feuSacré($target); // Feu Sacré
            }
            else if ($rand > 75 && $rand < 90) {
                $status = $this->atkMentale($target); // Attaque Mentale
            }
            else{
                $status = $this->coupBaguette($target); // Attaque à la baguette !
            }
            return $status;
        }
}
