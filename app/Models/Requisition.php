<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Requisition extends Model
{
    use HasFactory;

    public $req_id;
    public $to;
    public $attn;
    public $from;
    public $req_no;
    public $created;
    public $updated;
    public $status;
    public $prepared_id;
    public $noted_id;
    public $approved_id;
    public $approved_date;
    public $noted_date;
    public $remarks;
    public $lastInsertedId;

    public function AddRequisition(){
         try {
            DB::select('CALL AddRequisition(?, ?, ?, ?, ?, ?, ?, ?, ?)', [$this->req_no, $this->to,$this->from, $this->prepared_id, now(), now(), $this->attn, $this->status,$this->remarks]);
            $this->lastInsertedId = DB::selectOne('SELECT LAST_INSERT_ID() as last_inserted_id')->last_inserted_id;
            $this->result = "Requisition Submitted";
            $this->icon = "success";
            return $this->result;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function GetRequisitions(){
          try {
             $this->result = DB::select('CALL GetRequisitions(?,?,?)', [$this->from, $this->req_no, $this->prepared_id]);
            return $this->result;
        } catch (\Throwable $th) {
            return $this->result = $th->getMessage();
        }
    }
    public function CountRequisitions(){
        try {
            $this->result = DB::select('CALL RequisitionCounter(?)', [$this->from]);
            return $this->result;
        } catch (\Throwable $th) {
            return $this->result = $th->getMessage();
        }
    }
     public function UpdateRequisition(){
         try {
            DB::select('CALL UpdateRequistion(?, ?, ?, ?, ?, ?, ?, ?)', [$this->req_id,$this->req_no, $this->to,$this->from, $this->attn,$this->remarks, now(),$this->status]);
            $this->result = "Requisition Updated";
            $this->icon = "success";
            return $this->result;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public  function  UpdateRequisitionStatus(){
        try {
            $this->result = DB::update('CALL UpdateRequisitionStatus(?,?)', [$this->req_id,$this->status]);
            return "Requisition Status Updated";
        } catch (\Throwable $th) {
            return $this->result = $th->getMessage();
        }

    }
    public function RequisitionApprovals(){
        try {
             $this->result = DB::select('CALL GetRequisitionsApprovals(?)', [$this->from]);
            return $this->result;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function RequisitionApproved(){
        try {
            DB::select('CALL RequisitionApproved(?, ?, ?, ?)', [$this->req_id,$this->approved_id, now(), $this->status]);

            $this->result = $this->status==3? "Request Approved":"Request Disapproved";
            $this->icon =  $this->status==3? "success":"error";

            return $this->result;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function RequisitionNoted(){
         try {
            DB::select('CALL RequisitionNotedBy(?, ?, ?, ?)', [$this->req_id,$this->noted_id, $this->noted_date, $this->status]);
            $this->result = "Requisition Updated";
            $this->icon = "success";
            return $this->result;
        } catch (\Throwable $th) {
            return $this->result=$th->getMessage();
        }
    }
      public function RequisitionFinal(){
         try {
            DB::select('CALL RequisitionFinal(?,?)', [$this->req_id, now()]);
            $this->result = "Requisition Final";
            $this->icon = "success";
            return $this->result;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
     public function GetOrders(){
        try {
            $this->result =  DB::select('CALL GetOrders(?)', [$this->from]);
            return $this->result;
        }catch(\Throwable $th){
            return $this->result = $th->getMessage();
        }
    }



}
