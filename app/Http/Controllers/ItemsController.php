<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Items;
use Carbon\Carbon;


class ItemsController extends Controller
{
    public $items;

    public function __construct(){
        $this->items= new Items;
    }

    public function ItemsPage(){
         return view('tools/items');

    }
    public function ClassPage(){
         return view('tools/classifications');

    }
    public function AddItem(Request $request){
        try {
        $this->items->setDescription($request->input('description'));
        $this->items->setType($request->input('type'));
        $this->items->setClassification($request->input('class'));
        $this->items->setCost($request->input('cost'));
        $this->items->setUnit($request->input('unit'));
        $this->items->setSupplier($request->input('supplier'));
        return $this->items->AddItems();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }





    }
    public function GetItem(){
        try {
            return $this->items->GetItems();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }


    }


}
