<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Employees extends Model
{
    use HasFactory;
    public $id;
    public $fname;
    public $lname;
    public $email;
    public $position;
    public $active;
    public $dept_id;
      public function AddEmployees(){
            try {
            DB::select('CALL AddEmployees(?, ?, ?, ?, ?, ?, ?, ?)',[$this->fname,$this->lname,$this->email,$this->position,$this->active, $this->dept_id, now(), now()]);
            return  $this->result = "Employee Added Successfully";
        } catch (\Throwable $th) {
            return $this->result = $th->getMessage();
        }
    }
    public function getAllEmployees(){
            try {

            $this->result = DB::select('CALL getAllEmployees(?, ?)',[$this->dept_id, $this->id]);
            return   $this->result;
        } catch (\Throwable $th) {
            return $this->result = $th->getMessage();
        }
    }


}
