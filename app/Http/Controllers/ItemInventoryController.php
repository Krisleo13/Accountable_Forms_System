<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Items;
use App\Models\Inventory;


class ItemInventoryController extends Controller
{
    //
    public  $inventory;
    public  $items;
        public function __construct()
    {
        $this->inventory= new Inventory;
        $this->items= new Items;

    }
    public function ListInventoryPage(){

        return view('inventory/ItemsInventory')->with('items', $this->items)->with('Inventory',$this->inventory);
    }
    public function GetInventory($bid){
        $this->inventory->location = $bid;
        $this->inventory->GetAllInventory();

        return $this->inventory->result;

    }
       public function GetInventorySummary($bid){
        $this->inventory->location = $bid;
        $this->inventory->GetInventorySummary();

        return $this->inventory->result;

    }
    public function GetApprovedItems($bid){
        $this->inventory->location = $bid;
        $this->inventory->GetApprovedItems();

        return $this->inventory->result;

    }

     public function AssignInventoryItem(Request $request){
        try{
        $this->inventory->iid = $request->input("item_id");
        $this->inventory->assignee = $request->input("assignee");
        $this->inventory->AssignInventoryItem();
        return $this->inventory->result;
        }catch(\Exception $e){
            return "Error: ". $e->getMessage();
        }

    }
}
