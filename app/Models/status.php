<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class status extends Model
{
    use HasFactory;

    public  $id;
    public  $state;
    public  $description;
    public  $stage;
    public  $results;

    public  function  getStatus(){
        try {
            $this->result = DB::select('CALL GetStatus(?)', [$this->stage]);
            return $this->result;
        } catch (\Throwable $th) {
            return $this->result = $th->getMessage();
        }

    }




}
