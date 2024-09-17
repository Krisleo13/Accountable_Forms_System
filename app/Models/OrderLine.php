<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderLine extends Model
{
    use HasFactory;
    public $ol_id;
    public $item_id;
    public $quantity;
    public $req_no;
    public $cost;
    public $series_no;
    public $po_no;
    public $remarks;


    public function AddOrderLine(){
         try {
            DB::select('CALL AddOrderLine(?, ?, ?, ?, ?, ?, ?, ?)', [$this->req_no, $this->quantity,$this->item_id, $this->cost,$this->series_no,$this->remarks,now(), now()]);
            $this->result = "Orderline Added";
            $this->icon = "success";
            return $this->result;
        } catch (\Throwable $th) {
            return $this->result = $th->getMessage();
        }
    }
    public function GetOrderLine(){
         try {
             $this->result = DB::select('CALL GetOrderlineDetails(?,?)', [$this->req_no,$this->po_no]);

             return $this->result;
        } catch (\Throwable $th) {
            return $this->result = $th->getMessage();
        }
    }
      public function GetRequisitionOrderLine(){
        try {

            $this->result = DB::select('CALL GetRequisitions(?)', [$this->req_no]);

            return $this->result;
        } catch (\Throwable $th) {
            return $this->result = $th->getMessage();
        }
    }
       public function GetOrderLineForPO(){
         try {
             $this->result = DB::select('CALL `GetOrderLineForPO`()');

            return $this->result;
        } catch (\Throwable $th) {
            return $this->result = $th->getMessage();
        }
    }
     public function GetOrderLineForReceiving(){
         try {
             $this->result = DB::select('CALL `GetPOforReceiving`()');

            return $this->result;
        } catch (\Throwable $th) {
            return $this->result = $th->getMessage();
        }
    }
      public function UpdatePOid(){
         try {
             DB::select('CALL UpdatePOid(?,?)', [$this->ol_id,$this->po_no]);
             $this->result="Purchase Orders Submitted";

            return $this->result;
        } catch (\Throwable $th) {
            return $this->result = $th->getMessage();
        }
    }
    public function Delete(){
         try {
             DB::update('CALL DeleteRequisitionItems(?)', [$this->ol_id]);
            $this->result = "Orderline Deleted";
            $this->icon = "success";

            return $this->result;
        }catch(\Throwable $th){

            return $this->result = $th->getMessage();
        }

    }
    public function removePOItem()
    {
        try {
            DB::update('CALL removePOItem(?)', [$this->ol_id]);
            $this->result = "Orderline Removed";
            $this->icon = "success";

            return $this->result;
        }catch(\Throwable $th){

            return $this->result = $th->getMessage();
        }

    }
    public function UpdateOrder(){
        try {
            DB::update('CALL UpdatedRequisitionItems(? ,? ,?)', [$this->ol_id,$this->quantity,$this->series_no]);
            $this->result = "Orderline Updated";
            $this->icon = "success";
            return $this->result;
        }catch(\Throwable $th){
            return $this->result = $th->getMessage();
        }
    }
     public function getOrderlineitems(){
        try {
            $this->result = DB::select('CALL `getOrderlineItems`(?)', [$this->ol_id]);


            return $this->result;
        }catch(\Throwable $th){
            return $this->result = $th->getMessage();
        }
    }

}
