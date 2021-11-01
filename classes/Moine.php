<?php

namespace classes;
// images sorts !!!!
class Moine extends Character
{
    ///////////////////////////////////////////////////
    ////                    Stats                  ////
    //////////////////////////////////////////////////
    private $brumeAppaisante;
    private $coupBaton;
    private $frappeVoileNoir;
    private $coconVie;
    private $paumeTigre;
    private $ventJade;
    private $explosionChi;

    public function __construct($name, $picture)
    {
        parent::__construct($name);
        $this->maitrise *= 10;
        $this->pv *= 2;
        $this->agility *= 20;
        $this->picture = "/public/pictures/lili.png";
    }
    ///////////////////////////////////////////////////
    ////                    Sorts                  ////
    //////////////////////////////////////////////////


    private function brumeAppaisante()
    {
        if ($this->mana > 20) {
            $rand = floor(rand(2, 5) * $this->agility / 5);
            $this->pv += $rand;
            $this->mana -= 20;
            $status = "{$this->name} se lance Brume Appaisante <img src='../public/pictures/moine/ba.jpg' width=30px /> et se soigne de {$rand} PV!";
        } else {
            $status = "{$this->name} n'a plus de point de magie!";
        }
        return $status;
    }

    // Explosion de chi
    private function explosionChi(Character $target)
    {
        $rand = rand(2, 5);
        if ($this->mana > 50) {
            $atk = floor($rand * ($this->mana + $this->agility) / 8);
            $this->mana -= 50;
            $target->setLifePoints($atk);
            $status = "{$this->name} lance Explosion de chi <img src='../public/pictures/moine/ec.jpg' width=30px /> et inflige {$atk} points de dégats!";
        } else {
            $target->setLifePoints(2);
            $status = "{$this->name} n'a plus de point d'énergie!";
        }
        return $status;
    }
    // Cocon de Vie
    private function coconVie()
    {
        if ($this->mana > 30) {
            $rand = rand(3, 7) * $this->maitrise / 5;
            $this->mana -= 30;
            $this->pv += $rand;
            $status = "{$this->name} utilise Cocon de Vie <img src='../public/pictures/moine/cv.jpg' width=30px /> pour se protéger de {$rand} dégats! ";
        } else {
            $status = "{$this->name} n'a plus de point d'énergie!";
        }
        return $status;
    }

    // Frappe du voile noir
    private function frappeVoileNoir(Character $target)
    {
        $rand = rand(2, 5);
        if ($this->mana > 15) {
            $atk = floor($rand * $this->agility / 6);
            $this->mana -= 15;
            $target->setLifePoints($atk);
            $status = "{$this->name} utilise Frappe du voile noir <img src='../public/pictures/moine/fn.jpg' width=30px /> et inflige {$atk} points de dégats! ";
        } else {
            $status = "{$this->name} n'a plus de point d'énergie!";
        }
        return $status;
    }

    // Vent de jade fulgurant
    private function ventJade(Character $target)
    {
        $rand = rand(2, 5);
        if ($this->mana > 30) {
            $atk = floor($rand * $this->agility / 5);
            $this->mana -= 30;
            $target->setLifePoints($atk);
            $status = "{$this->name} lance Vent de jade fulgurant <img src='../public/pictures/moine/vj.jpg' width=30px />  et inflige {$atk} points de dégats! ";
        } else {
            $target->setLifePoints(2);
            $status = "{$this->name} n'a plus de point d'énergie!";
        }
        return $status;
    }
    // Attaque simple
    private function coupBaton(Character $target)
    {
        $attack = floor(rand(3, 7) * $this->agility / 10);
        $target->setlifePoints($attack);
        $status = "{$this->name} attaque au bâton <img src='../public/pictures/wow/Weapons/INV_Staff_30.png' width=30px />  et inflige {$attack} points de dégats! ";
        return $status;
    }

    // Attaque qui soigne
    private function paumeTigre($target)
    {
        $rand = rand(2, 5);
        if ($this->mana > 40) {
            $atk = floor($rand * $this->agility / 7);
            $target->setLifePoints($atk);
            $rand = floor(rand(3, 7) * $this->agility / 10);
            $this->pv += $rand;
            $this->mana -= 40;
            $status = "{$this->name} utilise Paume du tigre <img src='../public/pictures/moine/pt.jpg' width=30px /> , {$rand} PV restaurés et {$atk} dégats infligés";
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
            $status = $this->brumeAppaisante(); // 
        } else if ($rand > 10 && $rand < 20) {
            $status = $this->coconVie(); // 
        } else if ($rand > 20 && $rand < 27) {
            $status = $this->explosionChi($target); // 
        } else if ($rand > 27 && $rand < 35) {
            $status = $this->paumeTigre($target); // 
        } else if ($rand > 35 && $rand < 65) {
            $status = $this->frappeVoileNoir($target); // 
        } else if ($rand > 65 && $rand < 90) {
            $status = $this->ventJade($target); //
        } else {
            $status = $this->coupBaton($target); // 
        }
        return $status;
    }
}
