<?php 
namespace App;

class Validator {
    private $data;
    protected $errors = []; 

     /**
     * Undocumented function
     *
     * @param array $date
     * @return array|bool
     */

    public function validates(array $data) {
        $this->errors = [];
        $this->data = $data;

    }

    public function  validate (string $field, string $method, ...$parameters){
        if (!isset($this->data[$field])) {
            $this->errors[$field] = " Le chams $field n'est pas remplis";
        } else{
            call_user_func ([$this, $method], $field, ...$parameters );

        }
    }

    public function minlength (string $field, int $length){
        if (mb_strlen($field) < $length) {
            $this->errors[$field] = "Le champs doit avoir plus de $length caractères";
        }
    }

    public function date (string $field){
        if (\DateTime::createFromFormat('Y-m-d', $this->data[$field]) === false) {
            $this->errors[$field] = "la date ne semble pas valide";
        }


    }

    public function time (string $field){
        if (\DateTime::createFromFormat('H:i', $this->data[$field]) === false) {
            $this->errors[$field] = "le temps ne semble pas valide";
            return false;
        }
        return true;
    }
    public function beforTime (string $startField, string $endField){
        if($this->time($startField) && $this->time($endField))
        $start = \DateTime::createFromFormat('H:i', $this->data[$startField];
        $end = \DateTime::createFromFormat('H:i', $this->data[$endField];
        if ($start->getTimestamp() > $end->getTimestamp()){
            $this->errors[$startField] = "Le temps de début doit être inférieur de fin ";
            return false;
        }
        return true;
    }
}