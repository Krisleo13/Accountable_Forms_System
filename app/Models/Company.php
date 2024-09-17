<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Company extends Model
{
    use HasFactory;
    public $compid;
    public $bu_id;
    public $name;
    public $description;
    public $active;


      public function AddCompany(){
        try {
            DB::select('CALL AddCompany(?, ?, ?, ?, ?, ?)', [$this->bu_id,$this->name,$this->description, $this->active, now(), now()]);
            $this->result = "Company Added";
            $this->icon = "success";
            return $this->result;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

    }
     public function GetCompany(){
        try {

            $this->result = DB::select('CALL GetCompany()');
            $this->icon = "success";
            return $this->result;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

    }
}
