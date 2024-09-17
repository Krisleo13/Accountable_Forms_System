<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ReceivingItems extends Model
{
    use HasFactory;
    public $inventory_id;

    public $receiving_id;
    public $id;

    public function AddReceivingItems(){

        try {
            DB::select('CALL addReceiveItems(?, ?, ?, ?)', [$this->inventory_id, $this->receiving_id, now(), now()]);
            $this->result = "Items Received";
            $this->icon = "success";
            return $this->result;
        } catch (\Throwable $th) {
            return $this->result=$th->getMessage();
        }

    }
    public function getReceivingItems(){

        try {
            $this->result =DB::select('CALL GetReceiveItems(?)', [$this->receiving_id]);
            $this->icon = "success";
            return $this->result;
        } catch (\Throwable $th) {
            return $this->result=$th->getMessage();
        }

    }
       public function DeleteReceivingItems(){

        try {
            DB::select('CALL DeleteReceivingItem(?)', [$this->id]);
            $this->result = "Items Deleted";
            $this->icon = "success";
            return $this->result;
        } catch (\Throwable $th) {
            return $this->result=$th->getMessage();
        }

    }




}
