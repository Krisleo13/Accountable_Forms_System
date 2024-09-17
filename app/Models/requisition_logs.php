<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class requisition_logs extends Model
{
    use HasFactory;

    public $reqlogs_id;
    public $uid;
    public $state;
    public $req_id;
    public $remarks;

    public function AddRequisitionLogs()
    {
        try {
            DB::select('CALL AddRequisitionLogs(?, ?, ?, ?, ?, ?)', [$this->uid, $this->state,$this->req_id, $this->remarks,now(),now()]);
            $this->lastInsertedId = DB::selectOne('SELECT LAST_INSERT_ID() as last_inserted_id')->last_inserted_id;
            $this->result = "Requisition Submitted";

            return $this->result;
        } catch (\Throwable $th) {
            return $this->result=$th->getMessage();
        }


    }
    public function GetRequisitionLogs()
    {
        try {
            $this->result=DB::select('CALL GetRequisitionLogs(?)', [$this->req_id]);

            return $this->result;
        } catch (\Throwable $th) {
            return $this->result=$th->getMessage();
        }


    }
}
