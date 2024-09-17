<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Employee extends Model
{
    use HasFactory;

    private $empid;
    private $role;
    private $position;
    private $bcode;
    private $branch;

    public function GetEmployees(){
            try {
            $this->result = DB::select('CALL GetEmployees()');
            return $this->result;
        } catch (\Throwable $th) {
            return $this->result = $th->getMessage();
        }

    }


}
