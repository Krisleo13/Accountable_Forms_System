<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Inventory extends Model
{
    use HasFactory;

    public $iid;
    public $dr_no;
    public $location;
    public $ol_id;
    public $quantity;
    public $item_id;
    public $booklet;
    public $set_qty;
    public $series_start;
    public $series_end;
    public $assignee;
    public $receiving_ol_id;
    public $result;

    public $receiving_id;
    public $lastInsertedId;


    public function AddToInventory(){
         try {
            DB::select('CALL AddToInventory(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$this->receiving_id,$this->location,$this->quantity, $this->series_start, $this->series_end,$this->booklet, now(), now(),$this->item_id,$this->ol_id,$this->set_qty]);
            $this->result = "Item Received";
             $this->lastInsertedId = DB::selectOne('SELECT LAST_INSERT_ID() as last_inserted_id')->last_inserted_id;
            $this->icon = "success";
            return $this->result;
        } catch (\Throwable $th) {
            return  $this->result=$th->getMessage();
        }

    }
    public function UpdateInventory(){
         try {
            DB::select('CALL UpdateInventoryItem(?, ?, ?, ?, ?, ?, ?, ?)', [$this->iid, $this->series_start, $this->series_end,$this->receiving_id,$this->set_qty,$this->location, now(),$this->quantity]);
            $this->result = "Item Received";
            $this->icon = "success";
            return $this->result;
        } catch (\Throwable $th) {
            return  $this->result=$th->getMessage();
        }

    }
    public function GetAllInventory(){
         try {
            $this->result = DB::select('CALL `GetInventory`(?)', [$this->location]);

            return $this->result;
        } catch (\Throwable $th) {
            return  $this->result=$th->getMessage();
        }

    }
    public function GetApprovedItems(){
        try {
            $this->result = DB::select('CALL `GetApprovedItems`(?)', [$this->location]);
            return $this->result;
        } catch (\Throwable $th) {
            return  $this->result=$th->getMessage();
        }

    }
    public function GetInventorySummary(){
        try {
            $this->result = DB::select('CALL `GetInventorySummary`(?)', [$this->location]);
            return $this->result;
        } catch (\Throwable $th) {
            return  $this->result=$th->getMessage();
        }

    }
    public function AssignInventoryItem(){
         try {
            DB::select('CALL `AssignItem`(?,?,?)', [$this->assignee, $this->iid, now()]);
            $this->result ="Assigned Successful";

            return $this->result;
        } catch (\Throwable $th) {
            return  $this->result=$th->getMessage();
        }

    }

     public function UpdateInventoryLocation(){
         try {
            DB::select('CALL `UpdateInventoryLocation`(?, ?, ?)', [$this->location, $this->iid, now()]);
            $this->result ="Assigned Successful";

            return $this->result;
        } catch (\Throwable $th) {
            return  $this->result=$th->getMessage();
        }

    }
    public  function  RemoveReceivingInventoryItem()
    {
        try {
            DB::update('CALL `RemoveReceivingInventoryItem`(?,?)', [$this->iid,$this->receiving_ol_id]);
            $this->result ="Item Removed";

            return $this->result;
        } catch (\Throwable $th) {
            return  $this->result=$th->getMessage();
        }

    }

}
