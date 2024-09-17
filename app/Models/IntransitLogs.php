<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class IntransitLogs extends Model
{
    use HasFactory;
    public $id;
    public $user_id;
    public $stock_transfer_id;
    public $state;
    public $remarks;
    public $result;
    public function addIntransitLogs(){
        try {
            DB::select('CALL AddIntransitLogs(?, ?, ?, ?, ?, ?)', [$this->user_id,$this->stock_transfer_id,$this->state, $this->remarks, now(),now()]);
            $this->lastInsertedId = DB::selectOne('SELECT LAST_INSERT_ID() as last_inserted_id')->last_inserted_id;
            $this->result = "Logs Recorded";

            return $this->result;
        } catch (\Throwable $th) {
            return $this->result=$th->getMessage();
        }

    }
    public function getIntransitLogs(){
        try {
            $this->result = DB::select('CALL `getIntransitLogs`(?)', [$this->stock_transfer_id]);

            return $this->result;
        } catch (\Throwable $th) {
            return $this->result=$th->getMessage();
        }

    }

}
