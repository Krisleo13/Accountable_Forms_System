<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class Group extends Model
{
    use HasFactory;

    private $class_id;
    private $classname;
    private $code;
    private $details;
    private $created;
    private $updated;


public function AddGroup(){
      try {
            DB::select('CALL AddClassifications(?, ?, ?, ?, ? )', [$this->classname, $this->code, $this->details, now(),now()]);
            $this->result = " classification Added";
            $this->icon = "success";
            return $this->result;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

}
public function GetGroup(){
      try {
            $this->result=DB::select('CALL GetClassifications()');

            return $this->result;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

}







    public function setClassId($class_id) {
        $this->class_id = $class_id;
    }

    // Getter for $class_id
    public function getClassId() {
        return $this->class_id;
    }

    // Setter for $classname
    public function setClassname($classname) {
        $this->classname = $classname;
    }

    // Getter for $classname
    public function getClassname() {
        return $this->classname;
    }

    // Setter for $code
    public function setCode($code) {
        $this->code = $code;
    }

    // Getter for $code
    public function getCode() {
        return $this->code;
    }

    // Setter for $details
    public function setDetails($details) {
        $this->details = $details;
    }

    // Getter for $details
    public function getDetails() {
        return $this->details;
    }

    // Setter for $created
    public function setCreated($created) {
        $this->created = $created;
    }

    // Getter for $created
    public function getCreated() {
        return $this->created;
    }

    // Setter for $updated
    public function setUpdated($updated) {
        $this->updated = $updated;
    }

    // Getter for $updated
    public function getUpdated() {
        return $this->updated;
    }

}
