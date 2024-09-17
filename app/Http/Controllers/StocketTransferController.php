<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\status;
use App\Models\Requisition;
use App\Models\Items;
use App\Models\Department;
use App\Models\OrderLine;
use App\Models\StockTransfer;
use App\Models\StockTransferItems;
use App\Models\IntransitLogs;
use App\Models\Inventory;

use Illuminate\Support\Facades\DB;

class StocketTransferController extends Controller
{
    private $requisition;
    private $items;
    private $orderline;
    private $department;
    private $status;
    private $instransit;
    private $stocktransferitems;
    private $intransit_logs;
    private $inventory;





    public function __construct()
    {
        $this->requisition= new Requisition;
        $this->items= new Items;
        $this->department= new Department;
        $this->orderline= new OrderLine;
        $this->status= new status;
        $this->instransit= new StockTransfer;
        $this->stocktransferitems=new StockTransferItems();
        $this->intransit_logs=new IntransitLogs;
        $this->inventory=new Inventory ;



    }
    public function StockTransferPage(){

        return view('Forms.Stock Transfer.TransferItems')->with('items', $this->items)->with('department',$this->department);
    }
    public function IntransitListPage(){

        return view('Forms.Stock Transfer.IntransitList')->with('items', $this->items)->with('department',$this->department);
    }
    public function IntransitDetailsPage($intransit_no){
        $this->instransit->from=null;
        $this->instransit->intransit_no=$intransit_no;
        $instransit =  $this->instransit->getStockTransfer()[0];
        $this->status->stage= $instransit->status == 10 || $instransit->status == 9 ? 3 : 4;

        return view('Forms.Stock Transfer.IntransitDetails')->with('items', $this->items)->with('department',$this->department)->with('intransit',$instransit)->with('status',$this->status);
    }
    public function addStockTransfer(Request $request){
        $request->validate([
            // Validation rules here
            'stocktransfer_items' => 'required',
            'intransit_no' => 'required',
            'from_branch' => 'required',
            'to_branch' => 'required',
            'purpose' => 'required',

        ]);

        // Begin transaction
        DB::beginTransaction();
        try {
            ///
            $stocktransferitems=json_decode($request->input('stocktransfer_items'));
            ///
            $this->instransit->intransit_no =$request->input('intransit_no');
            $this->instransit->from         =$request->input('from_branch');
            $this->instransit->to           =$request->input('to_branch');
            $this->instransit->status       =12;
            $this->instransit->prepared_by  =$request->input('uid');
            $this->instransit->purpose      =$request->input('purpose');
            $this->instransit->addStockTransfer();

            $this->stocktransferitems->stock_transfer_id=$this->instransit->id;
            ///add in-transit item
            foreach ($stocktransferitems as $res) {
                $this->stocktransferitems->inventory_id = $res->id;
                $this->stocktransferitems->addIntransitItem();
            }
            /// add logs
            $this->intransit_logs->state               =12;
            $this->intransit_logs->user_id              =$request->input('uid');
            $this->intransit_logs->stock_transfer_id    = $this->instransit->id;
            $this->intransit_logs->remarks              ="Stock Transfer Record Added";
            $this->intransit_logs->addIntransitLogs();
            /// end

            DB::commit();

            return $this->instransit->result." <br>". $this->intransit_logs->result;

        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['error' => 'Failed to transfer stock: ' . $th->getMessage()], 500);
        }
    }
    public function getIntransitList($from){
        try {
            $this->instransit->from=$from;
            return $this->instransit->getStockTransfer();
        }catch (\Throwable $th) {
            return response()->json(['error' => 'Failed to transfer stock: ' . $th->getMessage()], 500);
        }
    }
     public function getReceivingIntransitList($to_dept){
        try {
            $this->instransit->to   =   $to_dept;
            return $this->instransit->getStockTransfer();
        }catch (\Throwable $th) {
            return response()->json(['error' => 'Failed to transfer stock: ' . $th->getMessage()], 500);
        }
    }
    public function getIntransitItems($stid){
        try {
            $this->stocktransferitems->stock_transfer_id=$stid;
            return $this->stocktransferitems->getIntransitItem();
        }catch (\Throwable $th) {
            return response()->json(['error' => 'Failed to transfer stock: ' . $th->getMessage()], 500);
        }
    }
    public function getIntransitLogs($st_id)
    {
        try{
            $this->intransit_logs->stock_transfer_id =$st_id;
            return $this->intransit_logs->getIntransitLogs();
        }catch (\Throwable $th) {
            return response()->json(['error' => 'Failed to transfer stock: ' . $th->getMessage()], 500);
        }

    }
    public function updateIntransitItems(Request $request){
        $request->validate([
            // Validation rules here
            'del_stocktransfer_items' => 'required'
        ]);
        // Begin transaction
        DB::beginTransaction();
        try {
            ///
            $del_stock_transfer_items=json_decode($request->input('del_stocktransfer_items'));
            $new_stock_transfer_items=json_decode($request->input('new_stocktransfer_items'));
            ///delete stock transfer items
            foreach ($del_stock_transfer_items as $res) {
                $this->stocktransferitems->id = $res->iti_id;
                $this->stocktransferitems->deleteIntransitItem();
            }
            /// add new item to the stock transfer
            $this->stocktransferitems->stock_transfer_id    =   $request->input('in_transit_id');
            foreach ($new_stock_transfer_items as $res) {
                $this->stocktransferitems->inventory_id = $res->id;
                $this->stocktransferitems->addIntransitItem();
            }

            DB::commit();
            return response()->json(['message' => $this->stocktransferitems->result], 200);

        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['error' => 'Failed to transfer stock: ' . $th->getMessage()], 500);
        }
    }
    public function updateIntransitStatus(Request $request){
        $request->validate([
            // Validation rules here
            'status' => 'required',
            'st_id' => 'required',
            'remarks' => 'required'
        ]);

        // Begin transaction
        DB::beginTransaction();
        try {
            //update status
            $this->instransit->id = $request->input('st_id');
            $this->instransit->status = $request->input('status');
            $this->instransit->updateStockTransferStatus();
            //end

            //add logs
            $this->intransit_logs->state               =$request->input('status');
            $this->intransit_logs->user_id             =$request->input('uid');
            $this->intransit_logs->stock_transfer_id   = $request->input('st_id');
            $this->intransit_logs->remarks             =$request->input('remarks');
            $this->intransit_logs->addIntransitLogs();
            //end

            DB::commit();

            return   $this->intransit_logs->result." <br> ".$this->instransit->result;

        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['error' => 'Failed to transfer stock: ' . $th->getMessage()], 500);
        }
    }
    public function updateIntransitDetails(Request $request){
//        $request->validate([
//            // Validation rules here
//            'status' => 'required',
//            'st_id' => 'required',
//            'remarks' => 'required'
//        ]);

        // Begin transaction
        DB::beginTransaction();
        try {
            //update status
            $this->instransit->id = $request->input('st_id');
            $this->instransit->intransit_no = $request->input('intransit_no');
            $this->instransit->purpose = $request->input('purpose');
            $this->instransit->to = $request->input('to_branch');

            $this->instransit->updateStockTransferDetails();
            //end

            //add logs
            $this->intransit_logs->state               =    16;
            $this->intransit_logs->user_id             =    $request->input('uid');
            $this->intransit_logs->stock_transfer_id   =    $request->input('st_id');
            $this->intransit_logs->remarks             =    "Stock Transfer Details Updated";
            $this->intransit_logs->addIntransitLogs();
            //end

            DB::commit();

            return   $this->intransit_logs->result." <br> ".$this->instransit->result;

        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['error' => 'Failed to transfer stock: ' . $th->getMessage()], 500);
        }
    }

    public  function UpdateIntransitReceivingDetails(Request $request){
        try {
             $stock_transfer_items=json_decode($request->input('stocktransfer_items'));
            //code...
            $this->instransit->id   =  $request->input('in_transit_id');
            $this->instransit->received_by  = $request->input('received_by');
            $this->instransit->received_date    =   now();
            $this->instransit->status    =   $request->input('status');
            $this->instransit->updateStockTransferReceivingDetails();

            /// add new item to the stock transfer
            foreach ($stock_transfer_items as $res) {
                $this->stocktransferitems->id = $res->iti_id;
                $this->stocktransferitems->status = $res->confirm;
                $this->stocktransferitems->UpdateStatusIntransitItem();

                if($res->confirm == 19){
                    $this->inventory->iid=$res->id;
                    $this->inventory->location= $request->input('received_branch');
                    $this->inventory->UpdateInventoryLocation();
                }

            }

            //add logs
            $this->intransit_logs->state               = $request->input('status');
            $this->intransit_logs->user_id             = $request->input('received_by');
            $this->intransit_logs->stock_transfer_id   = $request->input('in_transit_id');
            $this->intransit_logs->remarks             = $request->input('remarks');
            $this->intransit_logs->addIntransitLogs();
            //end
            return $this->instransit->result."<br>".$this->stocktransferitems->result."<br>". $this->intransit_logs->result;

        } catch (\Throwable $th) {
            return $th->getMessage();
            //throw $th;
        }

    }
    public function approvedStockTransfer(Request $request){
        $request->validate([
            // Validation rules here
            'status' => 'required',
            'st_id' => 'required',
            'remarks' => 'required'
        ]);

        // Begin transaction
        DB::beginTransaction();
        try {
            $status=intval($request->input('status'));
            //update status
                $this->instransit->id           = $request->input('st_id');
                $this->instransit->status       = $status;
                $this->instransit->approved_by  = $status == 14 ? $request->input('uid'):null;
                $this->instransit->approved_date= $status == 14 ? now():null;
                $this->instransit->approvedStockTransfer();
            //end

            //add logs
            $this->intransit_logs->state               =    $request->input('status');
            $this->intransit_logs->user_id             =    $request->input('uid');
            $this->intransit_logs->stock_transfer_id   =    $request->input('st_id');
            $this->intransit_logs->remarks             =    $request->input('remarks');
            $this->intransit_logs->addIntransitLogs();
            //end

            DB::commit();

            return   $this->intransit_logs->result." <br> ".$this->instransit->result;

        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['error' => 'Failed to transfer stock: ' . $th->getMessage()], 500);
        }
    }
    public function approvedStockTransferReceivingDetails(Request $request){
        // Begin transaction
        DB::beginTransaction();
        try {
              $status=intval($request->input('status'));
            //update status
                $this->instransit->id   =  $request->input('st_id');
                $this->instransit->receiving_approved_by  = $status==9?NULL:$request->input('uid');
                $this->instransit->receiving_approved_date    =$status==9?NULL:now();
                $this->instransit->status    =    $status;
                $this->instransit->approveIntransitReceivingDetails();
            //end
            DB::commit();
            return  $this->instransit->result;

        } catch (\Throwable $th) {
            DB::rollback();
            return  $th->getMessage();
        }
    }

}
