<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Requisition;
use App\Models\Items;
use App\Models\Department;
use App\Models\OrderLine;
use App\Models\Supplier;
use App\Models\PurchaseOrder;
use App\Models\Receiving;
use App\Models\ReceivingOrdeline;
use App\Models\Inventory;
use App\Models\status as Status;
use App\Models\ReceivingLogs;
use App\Models\ReceivingItems;

use Illuminate\Support\Facades\DB;




use Illuminate\View\View;

class ReceiveOrderController extends Controller
{
    //
        private $requisition;
        private $items;
        private $orderline;
        private $department;
        private $supplier;
        private $po;
        private $receive;
        private $receive_orderline;
        private $inventory;
        private $status;
        private $receiving_logs;
        private $receiving_items;




    public function __construct()
    {
        $this->requisition= new Requisition;
        $this->items = new Items;
        $this->department = new Department;
        $this->orderline = new OrderLine;
        $this->supplier = new Supplier;
        $this->po = new PurchaseOrder;
        $this->receive = new Receiving;
        $this->receive_orderline = new ReceivingOrdeline;
        $this->inventory = new Inventory;
        $this->status = new Status;
        $this->receiving_logs = new ReceivingLogs;
        $this->receiving_items=new ReceivingItems();


    }

    public function ReceivingOrderPage():View{
        $this->status->stage=3;
        return view('Forms.Receiving.Receiving')->with('items', $this->items)->with('department',$this->department)->with('supplier',$this->supplier)->with('status',$this->status);
    }

    public function ReceivingStockPage($encrypted):View{
        $intransit_id=intval(decrypt($encrypted));
        $this->status->stage=3;
        return view('Forms.Receiving.ReceivingStock')->with('items', $this->items)->with('department',$this->department)->with('supplier',$this->supplier)->with('status',$this->status)->with('intransit_id',$intransit_id);
    }

    public function ReceivingOrderListPage():View{
         $this->status->stage=3;

        return view('Forms.Receiving.ReceivingList')->with('items', $this->items)->with('department',$this->department)->with('supplier',$this->supplier)->with('status',$this->status);
    }
    public function ReceivingStockTransferListPage():View{

        return view('Forms.Receiving.StockTransferReceiving');
    }

    public function ReceivingOriginPage():View{
        $this->status->stage=3;
        return view('Forms.Receiving.ReceivingOrigin')->with('items', $this->items)->with('department',$this->department)->with('supplier',$this->supplier)->with('status',$this->status);
    }

    public function ReceivingOrderDetailsPage($drno):View{
            $this->receive->dr_no=$drno;
            $data=$this->receive->GetReceivingDetails()[0];
            $this->status->stage=3;

        return view('Forms.Receiving.ReceivingDetails')->with('items', $this->items)->with('department',$this->department)->with('supplier',$this->supplier)->with('receive',$data)->with('status',$this->status);
    }

    public function DetailsPage($drno):View{
        $this->receive->dr_no=$drno;
        $data=$this->receive->GetReceiving()[0];
        $this->status->stage=3;

        return view('Forms.Receiving.Details')->with('items', $this->items)->with('department',$this->department)->with('supplier',$this->supplier)->with('receive',$data)->with('status',$this->status);
    }

    public function getOrderLineForReceiving(){
        try {
            //code...
            return  $this->orderline->GetOrderLineForReceiving();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function GetReceiving(){
        try {
            //code...
            return  $this->receive->GetReceiving();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function addRecevingItem(Request $request){

          try {
            $validatedData = $request->validate([
            'dr_no' => 'required',
            'receiver' => 'required',
            'sender' => 'required',
            'status' => 'required',
            'prepared_by_id' => 'required',
            'remarks' => 'required',
            'receiving_items' => 'required',
            'receiving_items.*.end' => 'required',
            'receiving_items.*.start' => 'required',
            'receiving_items.*.rec_qty' => 'required|numeric|min:1',
            'receiving_items.*.set' => 'required|numeric|min:1',
            'inventory_items' => 'required',
            ]);
            //code...

              $inventory_items = json_decode($request->input("inventory_items"));
              $receiving_items = json_decode($request->input("receiving_items"));
              $filtered_inventory=[];
              $olid=0;


            //add receiving's table
                $this->receive->dr_no = $request->input("dr_no");
                $this->receive->source = 1;
                $this->receive->sender = $request->input("sender");
                $this->receive->receiver = $request->input("receiver");
                $this->receive->status = $request->input("status");
                $this->receive->remarks = $request->input("remarks");
                $this->receive->prepared_id = $request->input("uid");
                $this->receive->AddReceiving();
            //end

            // add to receiving_order_line


                // end
                // add to item to inventory
                $this->inventory->receiving_id = $this->receive->lastInsertedId;
                foreach ( $inventory_items as $res1) {
                    $this->inventory->iid = $res1->id;
                    $this->inventory->series_start = $res1->series_start;
                    $this->inventory->series_end = $res1->series_end;
                    $this->inventory->set_qty = $res1->set_qty;
                    $this->inventory->location = $request->input("receiver");
                    $this->inventory->quantity = 1;
                    $this->inventory->UpdateInventory();
                    //add item to receiving item tables
                    $this->receiving_items->inventory_id=$res1->id;
                    $this->receiving_items->receiving_id=$this->receive->lastInsertedId;
                    $this->receiving_items->AddReceivingItems();
                }
            // add to activity logs
              $this->receiving_logs->remarks = "New Receiving Record Added";
              $this->receiving_logs->state = 9;
              $this->receiving_logs->uid = $request->input("uid");
              $this->receiving_logs->receiving_id = $this->receive->lastInsertedId;
              $this->receiving_logs->AddReceivingLogs();
            // end
            return  "Receiving:".$this->receive->result."<br> items :".$this->receiving_items->result."<br> inventory: ".$this->inventory->result;
        } catch (\Throwable $th) {

            return $th->getMessage()." line".$th->getLine() ;
        }

    }

    public function addReceiveFromOrigin(Request $request){

          try {

            //code...

              $receiving_items = json_decode($request->input("items"));
              $filtered_inventory=[];
              $olid=0;


            //add receiving's table
                $this->receive->dr_no = $request->input("dr_no");
                $this->receive->source = 6;//from origin
                $this->receive->sender =0;//from origin
                $this->receive->receiver = $request->input("receiver");
                $this->receive->status = $request->input("status");
                $this->receive->remarks = "From Origin Inventory \n".$request->input("remarks");
                $this->receive->prepared_id = $request->input("uid");
                $this->receive->AddReceiving();
            //end
                $this->inventory->receiving_id = $this->receive->lastInsertedId;
                foreach ( $receiving_items as $res) {
                    // add to item to inventory
                    $this->inventory->item_id = $res->id;
                    $this->inventory->receiving_id = 0;
                    $this->inventory->ol_id = 0;
                    $this->inventory->location = $request->input("receiver");
                    $this->inventory->quantity = 1;
                    $this->inventory->booklet = $res->booklet;
                    $this->inventory->set_qty = $res->set_qty;
                    $this->inventory->series_start = $res->start;
                    $this->inventory->series_end = $res->end;
                    $this->inventory->AddToInventory();

                    //add item to receiving item tables
                    $this->receiving_items->inventory_id = $this->inventory->lastInsertedId;
                    $this->receiving_items->receiving_id = $this->receive->lastInsertedId;

                    $this->receiving_items->AddReceivingItems();
                }
            // add to activity logs
              $this->receiving_logs->remarks = "New Receiving Record Added";
              $this->receiving_logs->state = 9;
              $this->receiving_logs->uid = $request->input("uid");
              $this->receiving_logs->receiving_id = $this->receive->lastInsertedId;
              $this->receiving_logs->AddReceivingLogs();
            // end
            return  "Receiving From Origin Succeed";
        } catch (\Throwable $th) {

            return $th->getMessage()." line".$th->getLine() ;
        }

    }
    public  function getReceivingItems($rid)
    {
        try {
            //code...
            $this->receiving_items->receiving_id=$rid;
            return  $this->receiving_items->getReceivingItems();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function GetReceivingOrders($drno){
        try {
            //code...
            $this->receive->dr_no=$drno;
            return  $this->receive->GetReceivingOrder();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function UpdateReceiveDetails(Request $request){
        try {
            //code...
            $this->receive->dr_no = $request->input("dr_no");
            $this->receive->source = $request->input("source");
            $this->receive->sender = $request->input("sender");
            $this->receive->status = $request->input("status");
            $this->receive->remarks = $request->input("remarks");
            $this->receive->receive_id = $request->input("recid");
            return $this->receive->UpdateReceivingDetails();

        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();

        }

    }
    public function UpdateReceiveOrderItems(Request $request){
        try {

            $inventory_items = json_decode($request->input("inventory_items"));
            $del_inventory_items_list=json_decode($request->input("del_inventory_items_list"));
            $new_inventory_items_list=json_decode($request->input("new_inventory_items_list"));

            $filtered_inventory=[];
            DB::beginTransaction();
            $error="";
            $error.=   $this->receive_orderline->result."<br>";

            foreach ($del_inventory_items_list as $res) {
                // Reset inventory details
                $this->inventory->iid=$res->id;
                $this->inventory->series_start=0;
                $this->inventory->series_end=0;
                $this->inventory->set_qty = 0;
                $this->inventory->location=0;
                $this->inventory->quantity=1;
                $this->inventory->receiving_id=0;
                $this->inventory->UpdateInventory();
                /// delete from receiving_items table
                $this->receiving_items->id=$res->receiving_id;
                $this->receiving_items->DeleteReceivingItems();
            }
               $error.=   "<br> Delete Receiving Item".$this->receiving_items->result."<br>";


               // add to item to inventory
                $this->receiving_items->receiving_id =$request->input("receiving_id");
                foreach ( $new_inventory_items_list as $res1) {
                    //add item to receiving item tables
                    $this->receiving_items->inventory_id=$res1->id;
                    $this->receiving_items->AddReceivingItems();
                }
            $error.=   "<br> New Receiving Item".$this->receiving_items->result."<br>";

                // add to item to inventory
                $this->inventory->receiving_id = $request->input("receiving_id");
                foreach ( $new_inventory_items_list as $res1) {

                    $this->inventory->iid = $res1->id;
                    $this->inventory->series_start = $res1->series_start;
                    $this->inventory->series_end = $res1->series_end;
                    $this->inventory->set_qty = $res1->set_qty;
                    $this->inventory->quantity = 1;
                    $this->inventory->location = $res1->location;
                    $this->inventory->UpdateInventory();

                }

            //end
            $error.=   $this->inventory->result."<br>";
            DB::commit();
            $this->receiving_logs->remarks = "Details Updated";
            $this->receiving_logs->state =  16;
            $this->receiving_logs->uid = $request->input("uid");
            $this->receiving_logs->receiving_id = $request->input("receiving_id");
            $this->receiving_logs->AddReceivingLogs();
             $error.=   "Receiving logs".$this->receiving_logs->result."<br>";

            return $error;



        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return $th->getMessage()." ".$th->getLine();

        }

    }
    public  function UpdateReceivingStatus(Request $request)
    {
        try {
            //code...

            ///add to activity logs
            $this->receiving_logs->remarks = $request->input("remarks");
            $this->receiving_logs->state =  $request->input("status");
            $this->receiving_logs->uid = $request->input("uid");
            $this->receiving_logs->receiving_id = $request->input("receiving_id");
            $this->receiving_logs->AddReceivingLogs();

            /// update receiving status
            $this->receive->receive_id = $request->input("receiving_id");
            $this->receive->status = $request->input("status");
            return       $this->receiving_logs->result." <br>".$this->receive->UpdateReceivingStatus();

        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();

        }

    }
    public function ApproveReceiveDetails(Request $request){
        try {
            //code...
            ///add to activity logs
            $this->receiving_logs->remarks = $request->input("remarks");
            $this->receiving_logs->state =  $request->input("status");
            $this->receiving_logs->uid = $request->input("uid");
            $this->receiving_logs->receiving_id = $request->input("receiving_id");
            $this->receiving_logs->AddReceivingLogs();
            ///
            $status=intval($request->input("status"));
            $this->receive->approved_id = $status==9? null: $request->input("uid");
            $this->receive->receive_id = $request->input("receiving_id");
            $this->receive->approved_date =  $status==9? null:now();
            $this->receive->status =  $status;
            return $this->receive->ApproveReceivingDetails();

        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();

        }

    }
    public function getOrderlineItems($olid){
        try {
            //code...
            $this->orderline->ol_id = $olid;
            return $this->orderline->getOrderlineitems();

        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();

        }

    }
    public function getReceivingLogs($logs_id){
        try {
            //code...
            $this->receiving_logs->receiving_id = $logs_id;
            return $this->receiving_logs->GetReceivingLogs();

        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();

        }

    }
   public function addReceivingLogs(Request $request)
   {
       try {
           //code...
           $this->receiving_logs->remarks = "";
           $this->receiving_logs->state = "";
           $this->receiving_logs->uid = "";
           $this->receiving_logs->receiving_id = "";
           return $this->receiving_logs->AddReceivingLogs();

       } catch (\Throwable $th) {
           //throw $th;
           return $th->getMessage();

       }

   }
}
