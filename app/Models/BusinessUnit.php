<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BusinessUnit extends Model
{
    use HasFactory;

    public $buid;
    public $name;
    public $description;
    public $active;

     public function AddBu(){
        try {
            DB::select('CALL AddBu(?, ?, ?, ?, ?)', [$this->name,$this->description, $this->active, now(), now()]);
            $this->result = "Business Unit Added";
            $this->icon = "success";
            return $this->result;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

    }
     public function GetBu(){
        try {
            $this->result =  DB::select('CALL GetBu()');
            $this->icon = "success";
            return $this->result;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

    }
}
