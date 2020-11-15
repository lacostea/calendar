<?php

namespace App\Date;

class Month{

    public$day = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];

    public $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
    public $month;
    public $year;
    




    /**
     * Month constructor 
     *
     * @param integer $month le mois compris entre 1 et 12 
     * @param integer $year l'année
     * @throws \Exception 
     */

    public function __construct(?int $month = null, ?int $year = null)
    {
        if ($month === null){
            $month = intval(date('m'));
        }

        if  ($year === null){
            $year = intval(date('Y'));
        }

        $month = $month % 12;
        
        $this ->month = $month;
        $this ->year = $year;
    }


    /**
     * renvoie le premier jour du mois 
     *
     * @return \DateTime
     */

    public function getStratingDay () {
        return new \DateTime("{$this ->year}-{$this->month}-01");
    }    
    
    /**
     * Retourne le mois en toute lettre
     *  @return string
     */

    public function toString (): string {
       return $this->months[$this->month -1] . ' '. $this->year;

    } 

    public function getWeeks (): int {
        $start = $this->getStratingDay();
       
        $end = (clone $start)->modify('+1 month -1 day');

        /*return intval($end->format('W')) - intval($start->format('W'));*/

        $weeks = intval($end->format('W')) - intval($start->format('W')) +1;
        if ($weeks < 0){
            $weeks = intval($end->format('W'));
        }
        return $weeks;
        
    }
    /**
     * Renvoie au mois suivant
     *
     * @return Month
     */

    public function nextMonth (): Month
    {
        $month =$this->month +1;
        $year = $this->year;
        if ($month > 12){
            $month =1;
            $year += 1; 
        }
        return new Month($month, $year);
    }

    
    /**
     * Renvoie au mois précédent
     *
     * @return Month
     */

    public function previousMonth (): Month
    {
        $month =$this->month - 1;
        $year = $this->year;
        if ($month < 1){
            $month = 12;
            $year -= 1; 
        }
        return new Month($month, $year);
    }

}