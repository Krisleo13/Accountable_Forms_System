<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class PurchaseOrder extends Model
{
    use HasFactory;
    // properties

    public $po_id;
    public $sup_id;
    public $po_no;
    public $status;
    public $term;
    public $po_branch;
    public $requesters;
    public $remark;
    public $prepared;
    public $approved;
    public $lastInsertedId;


    public function AddPO(){
        try {
                DB::select('CALL AddPO(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$this->sup_id, $this->po_no,$this->status, $this->term, $this->po_branch, $this->remark,$this->requesters, now(), now(),  $this->prepared]);
                $this->lastInsertedId = DB::selectOne('SELECT LAST_INSERT_ID() as last_inserted_id')->last_inserted_id;
                $this->result = "Purchase Order Sent";
                $this->icon = "success";
                return $this->lastInsertedId;
            } catch (\Throwable $th) {
                return $th->getMessage();
            }

    }

    public function GetPOList(){
    try {
            $this->result =  DB::select('CALL `GetPolist`(?)', [$this->po_no]);
            return $this->result;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

    }

    public function GetPORequest(){
        try {
            
            $this->result =  DB::select('CALL `GetPORequests`()');
            return $this->result;

        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
       public function UpdatePODetails(){
    try {

            DB::select('CALL `UpdatePO`(?, ?, ?, ?, ?)', [$this->po_id, $this->term, $this->remark, $this->sup_id, now()]);
            $this->result="Po Updated";
            return $this->result;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

    }

    public function ApprovedPO(){
    try {

            DB::select('CALL `ApprovedPO`(?, ?, ?, ?)', [$this->po_id, $this->approved,$this->status, now()]);
            $this->result ="PO Approved";
            return $this->result;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

    }

    public function updateStatus(){
        try {

            DB::select('CALL `UpdatePOStatus`(?, ?)', [$this->po_id, $this->status]);
            $this->result ="PO Status Updated";
            return $this->result;
        } catch (\Throwable $th) {
            $this->result =$th->getMessage();
            return  "Update Error";
        }

    }





}
