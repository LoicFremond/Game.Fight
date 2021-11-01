<?php
namespace classes;

class Demoniste extends Character
{
            ///////////////////////////////////////////////////
            ////                    Stats                  ////
            //////////////////////////////////////////////////
    private $potion = False;
    private $siphonAme = False;
    private $diablotin;
    private $grangreFeu;
    private $drainVie = False;
    private $coupBaguette;


    public function __construct($name, $picture) {
        parent :: __construct($name);
        $this->intel *= 20;
        $this->pv *= 2;
        $this->picture = "/public/pictures/Guldan.jpg";
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
    // diablotin
    private function diablotin(Character $target) {
        $rand = rand(2, 5);
        if ($this->mana > 15) {
            $atk = floor ($rand * $this->intel / 7);
            $this->mana -= 15;
            $target->setLifePoints($atk);
            $status = " {$this->name} invoque un Diablotin <img src='../public/pictures/Abilities11/Ability_warlock_impoweredimp.png' width=30px /> et inflige {$atk} points de dégats!";
        } else {
            $status = "{$this->name} n'a plus de point de magie!";
        }
        return $status;
    }
    // Gangrefeu
    private function gangreFeu(Character $target) {
        $rand = rand(2, 5);
        if ($this->mana > 20) {
            $atk = floor ($rand * $this->intel / 6);
            $this->mana -= 20;
            $target->setLifePoints($atk);
            $status = " {$this->name} lance Gangrefeu <img src='../public/pictures/Abilities11/Ability_warlock_backdraft.png' width=30px /> et inflige {$atk} points de dégats!";
        } else {
            $status = "{$this->name} n'a plus de point de magie!";
        }
        return $status;
    }
    // Attaque simple
    private function coupBaguette (Character $target) {
        $attack = rand(10, 20);
        $target->setlifePoints($attack);
        $status = "{$this->name} utilise sa baguette <img src='../public/pictures/Wands/bag.png' width=30px />  et inflige {$attack} points de dégats!";
        return $status;
    }
    // Siphon D'Ame
    private function siphonAme($target) {
        $rand = rand(2, 5);
        if ($this->mana > 15) {
            $atk = floor($rand * $this->intel / 7);
            $this->mana -= 15;
            $target->setLifePoints($atk);
            $rand = floor(rand(3, 7) * $this->intel / 10);
            $this->siphonAme = true;
            $this->pv += $rand;
            $status = "{$this->name} utilise Siphon D'Ames <img src='../public/pictures/Abilities12/Ability_warlock_soulsiphon.png' width=30px /> , {$rand} PV restaurés et {$atk} dégats infligés";
        } else {
            $target->setLifePoints(2);
            $status = "{$this->name} n'a plus de point de magie!";
        }
        return $status;
    }
    // Drain de Vie
    private function drainVie($target) {
        $rand = rand(2, 5);
        if ($this->mana > 15) {
            $atk = floor($rand * $this->intel / 7);
            $this->mana -= 15;
            $target->setLifePoints($atk);
            $rand = floor(rand(3, 7) * $this->intel / 10);
            $this->drainVie = true;
            $this->pv += $rand;
            $status = "{$this->name} utilise Drain de Vie <img src='../public/pictures/Abilities12/Ability_warlock_soulswap.png' width=30px /> , {$rand} PV restaurés et {$atk} dégats infligés";
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
            else if ($rand > 10 && $rand < 25) {
                $status = $this->diablotin($target); // diablotin
            }
            else if ($rand > 25 && $rand < 37) {
                $status = $this->siphonAme($target); // Siphon d'Ames
            }
            else if ($rand > 37 && $rand < 65) {
                $status = $this->drainVie($target); // Drain de vie
            }
            else if ($rand > 65 && $rand < 85) {
                $status = $this->gangreFeu($target); // GangreFeu
            }
            else{
                $status = $this->coupBaguette($target); // Attaque à la baguette !
            }
            return $status;
        }
    }
