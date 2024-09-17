<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Receiving extends Model
{
    use HasFactory;

    public $receive_id;
    public $dr_no;
    public $source;
    public $sender;
    public $receiver;
    public $status;
    public $remarks;
    public $prepared_id;
    public $approved_id;
    public $approved_date;

    public $result;
    public $lastInsertedId;



    public function AddReceiving(){

         try {
            DB::select('CALL addReceiving(?, ?, ?, ?, ?, ?, ?, ?, ?)', [$this->source, $this->dr_no,$this->sender, $this->receiver, $this->status,$this->remarks, $this->prepared_id, now(), now()]);
            $this->lastInsertedId = DB::selectOne('SELECT LAST_INSERT_ID() as last_inserted_id')->last_inserted_id;
            $this->result = "Item Received";
            $this->icon = "success";

            return $this->result;
        } catch (\Throwable $th) {
            return  $this->result=$th->getMessage();
        }

    }

    public function GetReceiving(){
         try {
            $this->result = DB::select('CALL GetReceivings(?)', [$this->dr_no]);
            return $this->result;
        } catch (\Throwable $th) {
            return  $this->result=$th->getMessage();
        }
    }
    public function GetReceivingOrder(){

         try {
            $this->result = DB::select('CALL GetReceivingOrderline(?)', [$this->dr_no]);
            return $this->result;
        } catch (\Throwable $th) {
            return  $this->result=$th->getMessage();
        }

    }
    public function GetReceivingDetails(){

         try {
            $this->result = DB::select('CALL GetReceivingDetails(?)', [$this->dr_no]);
            return $this->result;
        } catch (\Throwable $th) {
            return  $this->result=$th->getMessage();
        }

    }

     public function ApproveReceivingDetails(){

         try {
           DB::select('CALL ApproveReceiving(?, ?, ?, ?)', [$this->receive_id, $this->approved_id,$this->status, $this->approved_date   ]);
            return $this->result = $this->status==9?"Disapproved":"Approved";
        } catch (\Throwable $th) {
            return  $this->result=$th->getMessage();
        }

    }
    public function UpdateReceivingDetails(){

        try {
            DB::select('CALL UpdateReceivingDetails(?, ?, ?, ?, ?, ?)', [$this->dr_no, $this->source, $this->sender, $this->remarks, now(), $this->receive_id]);
            $this->result ="Receiving Details Updated";
            return $this->result;
        } catch (\Throwable $th) {
            return  $this->result=$th->getMessage();
        }

    }
    public function UpdateReceivingStatus(){

        try {
            DB::select('CALL UpdateReceivingStatus(?, ?)', [$this->receive_id, $this->status]);
            $this->result ="Receiving Status Updated";
            return $this->result;
        } catch (\Throwable $th) {
            return  $this->result=$th->getMessage();
        }

    }
}
