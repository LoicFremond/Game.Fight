<?php
namespace classes;

class Chaman extends Character
{
                ///////////////////////////////////////////////////
                ////                    Stats                  ////
                //////////////////////////////////////////////////
    private $restauration = False;
    private $chaineEclair;
    private $totemFeu;
    private $eclair;
    private $elemFeu;
    private $bouclierFoudre = False;
    private $coupHache;


    public function __construct($name, $picture) {
        parent :: __construct($name);
        $this->maitrise *= 20;
        $this->intel *= 20;
        $this->pv *= 2;
        $this->picture = "./public/pictures/thrall.jpg";
    }

                    ///////////////////////////////////////////////////
                    ////                    Sorts                  ////
                    //////////////////////////////////////////////////

    // Restauration
    private function restauration() {
        if ($this->mana > 20) {
        $rand = floor (rand(2, 5) * $this->intel / 5);
        $this->restauration = True;
        $this->pv += $rand;
        $this->mana -= 20;
        $status = "{$this->name} se lance Restauration <img src='../public/pictures/wow/Spells/Spell_Nature_ResistMagic.png' width=30px /> et se soigne de {$rand} PV!";
    } else {
        $status = "{$this->name} n'a plus de point de magie!";
    }
    return $status;
    }
    // Eclair
    private function eclair(Character $target) {
        $rand = rand(2, 5);
        if ($this->mana > 15) {
            $atk = floor ($rand * $this->intel / 7);
            $this->mana -= 15;
            $target->setLifePoints($atk);
            $status = " {$this->name} lance Eclair <img src='../public/pictures/wow/Spells/Spell_Nature_Lightning.png' width=30px /> et inflige {$atk} points de dégats!";
        } else {
            $status = "{$this->name} n'a plus de point de magie!";
        }
        return $status;
    }
    // Chaine D'éclairs
    private function chaineEclair(Character $target) {
        $rand = rand(2, 5);
        if ($this->mana > 20) {
            $atk = floor ($rand * $this->intel / 6);
            $this->mana -= 20;
            $target->setLifePoints($atk);
            $status = " {$this->name} lance Chaine d'éclair <img src='../public/pictures/wow/Spells/Spell_Nature_LightningBolt.png' width=30px /> et inflige {$atk} points de dégats!";
        } else {
            $status = "{$this->name} n'a plus de point de magie!";
        }
        return $status;
    }
    // Attaque simple
    private function coupHache(Character $target) {
        $attack = rand(10, 20);
        $target->setlifePoints($attack);
        $status = "{$this->name} utilise sa hache <img src='../public/pictures/wow/Weapons/INV_Axe_14.png' width=30px /> et inflige {$attack} points de dégats!";
        return $status;
    }
    // Bouclier de Foudre
    private function bouclierFoudre() {
        if ($this->mana > 0) {
        $rand = rand(2, 5) * $this->maitrise / 5;
        $this->mana += 30;
        $this->pv += $rand ;
        $status = "{$this->name} lance Bouclier de Foudre <img src='../public/pictures/wow/Spells/Spell_Nature_LightningShield.png' width=30px /> {$rand} PV et 30 Mana régénérés!";
    } else {
        $status = "{$this->name} n'a plus de point de magie!";
    }
    return $status;
    }

    // Elementaire de Feu
    private function elemFeu(Character $target) {
        $rand = rand(2, 5);
        if ($this->mana > 30) {
            $atk = floor ($rand * $this->intel / 5);
            $this->mana -= 30;
            $target->setLifePoints($atk);
            $status = "{$this->name} invoque un élémentaire de feu <img src='../public/pictures/wow/Spells/Spell_Fire_Incinerate.png' width=30px /> et inflige {$atk} points de dégats!";
        } else {
            $status = "{$this->name} n'a plus de point de magie!";
        }
        return $status;
    }

    // Totem de Feu
    private function totemFeu(Character $target) {
        $rand = rand(2, 5);
        if ($this->mana > 15) {
            $atk = floor ($rand * $this->intel / 5);
            $this->mana -= 15;
            $target->setLifePoints($atk);
            $status = "{$this->name} fait appel au Totem du Feu <img src='../public/pictures/wow/Spells/Spell_Fire_SearingTotem.png' width=30px />  et inflige {$atk} points de dégats!";
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
                $status = $this->restauration(); // On regénère la vie !
            }
            else if ($rand > 10 && $rand < 20) {
                $status = $this->bouclierFoudre(); // On se protège et regen Mana !
            }
            else if ($rand > 20 && $rand < 27) {
                $status = $this->elemFeu($target); // Elementaire de Feu
            }
            else if ($rand > 27 && $rand < 55) {
                $status = $this->totemFeu($target); // Totem de feu
            }
            else if ($rand > 55 && $rand < 75) {
                $status = $this->eclair($target); // Eclair
            }
            else if ($rand > 75 && $rand < 90) {
                $status = $this->chaineEclair($target); // Chaine d'eclair
            }
            else{
                $status = $this->coupHache($target); // Attaque à la hache !
            }
            return $status;
        }
}
                