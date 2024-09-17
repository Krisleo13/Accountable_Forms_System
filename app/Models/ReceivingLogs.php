<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ReceivingLogs extends Model
{
    use HasFactory;

    public  $receiving_id;
    public  $remarks;
    public  $uid;
    public  $state ;
    public  $id;
    public  $result;
    public  $lastInsertedId;


    public function AddReceivingLogs()
    {
        try {
            DB::select('CALL AddReceivingLogs(?, ?, ?, ?, ?, ?)', [$this->remarks,$this->uid,$this->state,$this->receiving_id, now(),now()]);
            $this->lastInsertedId = DB::selectOne('SELECT LAST_INSERT_ID() as last_inserted_id')->last_inserted_id;
            $this->result = "Logs Recorded";

            return $this->result;
        } catch (\Throwable $th) {
            return $this->result=$th->getMessage();
        }


    }
    public function GetReceivingLogs()
    {
        try {
            $this->result=DB::select('CALL GetReceivingLogs(?)', [$this->receiving_id]);
            return $this->result;
        } catch (\Throwable $th) {
            return $this->result=$th->getMessage();
        }


    }



}
