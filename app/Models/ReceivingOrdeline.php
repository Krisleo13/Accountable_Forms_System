<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ReceivingOrdeline extends Model
{
    use HasFactory;
    public $id;

    public $dr_no;
    public $order_id;
    public $qty_received;
    public $set_per_item;
    public $copy_per_set;
    public $series_start;
    public $booklets;
    public $series_end;
    public $result;
    public $receiving_id;
    public $lastInsertedId;

     public function AddReceivingOrderLine(){

         try {
            DB::select('CALL AddReceivingOrderLine(?, ?, ?, ?, ?, ?, ?, ?, ?)', [$this->receiving_id, $this->order_id, $this->qty_received,$this->booklets, $this->copy_per_set, $this->series_start, $this->series_end, now(), now()]);
            $this->lastInsertedId = DB::selectOne('SELECT LAST_INSERT_ID() as last_inserted_id')->last_inserted_id;
            $this->result = "Order Received";
            $this->icon = "success";
            return $this->result;
        } catch (\Throwable $th) {
            return $this->result=$th->getMessage();
        }

    }
    public function DeleteReceivingOrderLine(){

        try {
            DB::select('CALL DeleteReceivingOrder(?)', [$this->id]);
            $this->result = "Order Deleted";
            $this->icon = "success";
            return $this->result;
        } catch (\Throwable $th) {
            return $this->result=$th->getMessage();
        }

    }
    public function UpdateReceivingOrderLine(){

        try {
            DB::select('CALL UpdateReceivingOrderline(?, ?, ?, ?, ?, ?, ?)', [$this->qty_received,$this->copy_per_set,$this->booklets,$this->series_start,$this->series_end,now(),$this->id]);
            $this->result = "Order Updated";
            $this->icon = "success";
            return $this->result;
        } catch (\Throwable $th) {
            return $this->result=$th->getMessage();
        }

    }
}
