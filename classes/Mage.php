<?php
namespace classes;

class Mage extends Character
{
    private $bouclierMana;
    private $bouclierFeu;
    private $coupDague;
    private $bouleDeFeu;
    private $explosionPyro;
    private $missileArcane;

    public function __construct($name, $picture) {
        parent :: __construct($name);
        $this->maitrise *= 10;
        $this->intel *= 25;
        $this->pv *= 2;
        $this->picture = "/public/pictures/jaina.jpg";
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
    // Bouclier de Mana
    private function bouclierMana() {
        $rand = rand(2, 5) * $this->maitrise / 5;
        $this->bouclierMana = True;
        $this->mana -= ($rand /2);
        $this->pv += $rand ;
        $status = "{$this->name} lance un Bouclier de mana <img src='../public/pictures/Abilities11/mana.png' width=30px /> pour se protéger de {$rand} dégats!";
        return $status;
    }

    // Bouclier de Feu
    private function bouclierFeu() {
        $rand = rand(2, 5) * $this->maitrise / 5;
        $this->bouclierFeu = True;
        $this->mana -= 30;
        $this->pv += $rand ;
        $status = "{$this->name} lance un Bouclier de feu <img src='../public/pictures/Abilities5/bf.png' width=30px />  pour se protéger de {$rand} dégats!";
        return $status;
    }
    // Explosion Pyrotechnique
    private function explosionPyro(Character $target) {
        $rand = rand(2, 5);
        if ($rand <= $this->mana) {
            $atk = floor ($rand * $this->intel / 5);
            $this->mana -= 30;
            $target->setLifePoints($atk);
            $status = "{$this->name} lance Explosion Pyrotechnique <img src='../public/pictures/Abilities5/ep.png' width=30px />  et inflige {$atk} points de dégats!";
        } else {
            $target->setLifePoints(2);
            $status = "{$this->name} n'a plus de point de magie!";
        }
        return $status;
    }
    // Attaque simple
    private function coupDague(Character $target) {
        $attack = rand(10, 20);
        $target->setlifePoints($attack);
        $status = "{$this->name} lance une attaque à la dague <img src='../public/pictures/Abilities11/dague.png' width=30px /> et inflige {$attack} points de dégats!";
        return $status;
    }

    // Missile Arcanique
    private function missileArca(Character $target) {
        $rand = rand(2, 5);
        if ($rand <= $this->mana) {
            $atk = floor ($rand * $this->intel / 7);
            $this->mana -= 15;
            $target->setLifePoints($atk);
            $status = "{$this->name} lance un Missile Arcanique <img src='../public/pictures/Abilities5/ma.png' width=30px /> et inflige {$atk} points de dégats!";
        } else {
            $target->setLifePoints(2);
            $status = "{$this->name} n'a plus de point de magie!";
        }
        return $status;
    }

    // Boule de Feu
    private function bouleDeFeu(Character $target) {
        $rand = rand(2, 5);
        if ($rand <= $this->mana) {
            $atk = floor ($rand * $this->intel / 6);
            $this->mana -= 30;
            $target->setLifePoints($atk);
            $status = " {$this->name} lance Boule de Feu <img src='../public/pictures/Spells3/bdf.png' width=30px /> et inflige {$atk} points de dégats!";
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
                $status = $this->potion(); // On regénère la vie !
            }
            else if ($rand > 10 && $rand < 17) {
                $status = $this->bouclierMana(); // On se protège !
            }
            else if ($rand > 17 && $rand < 25) {
                $status = $this->bouclierFeu(); // On se protège plus!
            }
            else if ($rand > 25 && $rand < 55) {
                $status = $this->missileArca($target); // Missile Arcanique
            }
            else if ($rand > 55 && $rand < 75) {
                $status = $this->explosionPyro($target); // Explosion Pyrotechnique
            }
            else if ($rand > 75 && $rand < 90) {
                $status = $this->bouleDeFeu($target); // Boule de Feu
            }
            else{
                $status = $this->coupDague($target); // Attaque à la dague !
            }
            return $status;
        }
}
