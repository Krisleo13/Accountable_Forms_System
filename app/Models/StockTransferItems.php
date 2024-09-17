<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StockTransferItems extends Model
{
    use HasFactory;

    public $id;
    public $inventory_id;
    public $stock_transfer_id;
    public $status;

    public function addIntransitItem()
    {
        try {
            DB::select('CALL addIntransitItem(?, ?, ?, ?)', [$this->inventory_id,$this->stock_transfer_id,now(), now()]);
            $this->result = "In-transit Items Added";
            $this->id = DB::selectOne('SELECT LAST_INSERT_ID() as last_inserted_id')->last_inserted_id;

            return $this->result;
        } catch (\Throwable $th) {
            return  $this->result=$th->getMessage();
        }
    }
    public function getIntransitItem()
    {
        try {
            $this->result =DB::select('CALL getIntransitItems(?)', [$this->stock_transfer_id]);

            return $this->result;
        } catch (\Throwable $th) {
            return  $this->result=$th->getMessage();
        }
    }
     public function UpdateStatusIntransitItem()
    {
        try {
            DB::select('CALL UpdateStatusIntransitItem(?,?)', [$this->id,$this->status]);
            $this->result ="Items Status Updated";

            return $this->result;
        } catch (\Throwable $th) {
            return  $this->result=$th->getMessage();
        }
    }
    public function deleteIntransitItem()
    {
        try {
            DB::select('CALL deleteStockTransferItem(?)', [$this->id]);
            $this->result ="Items Deleted";

            return $this->result;
        } catch (\Throwable $th) {
            return  $this->result=$th->getMessage();
        }
    }


}
