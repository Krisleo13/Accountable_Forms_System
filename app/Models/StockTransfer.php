<?php

namespace App\Models;

use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StockTransfer extends Model
{
    use HasFactory;

    public $id;
    public $intransit_no;
    public $from;
    public $to;
    public $status;
    public $purpose;
    public $prepared_by;
    public $approved_by;
    public $approved_date;
    public $received_by;
    public $received_date;
    public $receiving_approved_by;
    public $receiving_approved_date;
    public $result;




    public function addStockTransfer()
    {
        try {
            DB::select('CALL addStockTransfer(?, ?, ?, ?, ?, ?, ?,?)', [$this->intransit_no,$this->from,$this->to,$this->status,$this->purpose, now(), now(), $this->prepared_by]);
            $this->result = "Stock Transfer Created";
            $this->id = DB::selectOne('SELECT LAST_INSERT_ID() as last_inserted_id')->last_inserted_id;

            return $this->result;
        } catch (\Throwable $th) {
            return  $this->result=$th->getMessage();
        }
    }
    public function getStockTransfer()
    {
        try {
            $this->result =DB::select('CALL getIntransitList(?, ?, ?)', [$this->from,$this->intransit_no,$this->to]);

            return $this->result;
        } catch (\Throwable $th) {
            return  $this->result=$th->getMessage();
        }
    }
    public function updateStockTransferDetails()
    {
        try {
            DB::update('CALL updateStockTransferDetails(?, ?, ?, ?)', [$this->id,$this->intransit_no,$this->purpose,$this->to]);
            $this->result ="Stock Transfer Details Updated";

            return $this->result;
        } catch (\Throwable $th) {
            return  $this->result=$th->getMessage();
        }
    }
    public function updateStockTransferReceivingDetails()
    {
        try {
            DB::update('CALL UpdateIntransitReceivingDetails(?, ?, ?, ?)', [$this->id,$this->received_by,$this->received_date, $this->status]);
            $this->result ="Stock Received";

            return $this->result;
        } catch (\Throwable $th) {
            return  $this->result=$th->getMessage();
        }
    }
    public function updateStockTransferStatus()
    {
        try {
            DB::update('CALL UpdateStockTransferStatus(?,?)', [$this->id,$this->status]);
            $this->result ="Stock Transfer Status";

            return $this->result;
        } catch (\Throwable $th) {
            return  $this->result=$th->getMessage();
        }
    }
    public function approvedStockTransfer()
    {
        try {
            DB::update('CALL approveStockTransfer(?, ?, ?, ? )', [$this->status,$this->approved_by,$this->approved_date,$this->id]);
            $this->result ="Stock Transfer Approved";

            return $this->result;
        } catch (\Throwable $th) {
            return  $this->result=$th->getMessage();
        }
    }
     public function approveIntransitReceivingDetails()
    {
        try {
            DB::update('CALL ApprovedRecevingIntransit(?, ?, ?, ? )', [$this->id,$this->receiving_approved_by,$this->receiving_approved_date,$this->status]);
            $this->result ="Receiving Stock Transfer Approved";

            return $this->result;
        } catch (\Throwable $th) {
            return  $this->result=$th->getMessage();
        }
    }


}
