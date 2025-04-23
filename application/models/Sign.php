<?php

class Sign extends CI_Model
{
    private $empnum;

    public function setEmployeeNumber($empnum = "000000") {
        if (ctype_digit($empnum) && strlen($empnum) === 6 && $empnum!=="000000") {
            $this->empnum = $empnum;
        } else {
            throw new InvalidArgumentException("Employee number must be exactly 6 digits and numeric.");
        }
    }

    public function saveToDataBase(){
        try {
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function getEmployeeNumber() {
        return $this->empnum;
    }
}
?>
