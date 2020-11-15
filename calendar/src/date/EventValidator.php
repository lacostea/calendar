<?php
namespace date;

use App\Validator;

class EventValidator extends Validator {
  
    /**
     * Undocumented function
     *
     * @param array $date
     * @return array|bool
     */
    public function validates(array $data) {
        parent::validates($data);
        $this->validate('name', 'minLength',  3);
        $this->validate('date', 'date');
        $this->validate('start', 'beforTime', 'end');
        return $this->errors;
    }

}

?>