<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class po_logs extends Model
{
    use HasFactory;
    public $pologsid;
    public $uid;
    public $state;
    public $po_id;
    public $remarks;
    public $results;


    public function AddPoLogs(){
        try {
            DB::select('CALL AddPologs(?, ?, ?, ?, ?, ?)', [$this->uid, $this->state,$this->po_id, $this->remarks,now(), now()]);
            $this->results = "Action logged";
            $this->icon = "success";
            return $this->results;
        } catch (\Throwable $th) {
            return $this->results = $th->getMessage();
        }
    }

    public function getPoLogs(){
        try {
            $this->results = DB::select('CALL getPOLogs(?)', [$this->po_id]);
            return $this->results;
        } catch (\Throwable $th) {
            return $this->results = $th->getMessage();
        }
    }
}
