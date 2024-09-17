<?php

namespace App\Http\Controllers;


use App\Models\po_logs;
use Illuminate\Http\Request;

use App\Models\Requisition;
use App\Models\Items;
use App\Models\Department;
use App\Models\OrderLine;
use App\Models\Supplier;
use App\Models\PurchaseOrder;
use App\Models\Inventory;
use App\Models\status as Status;
use App\Models\po_logs as PoLogs;
use App\Models\PO_Attachments;




class PurchaseOrderController extends Controller
{
    //
      private $requisition;
      private $items;
      private $orderline;
      private $department;
      private $supplier;
      private $po;
      private  $inventory;
      private  $status;
      private  $po_logs;
      private  $po_files;

      private  $result;



    public function __construct()
    {
        $this->requisition= new Requisition;
        $this->items= new Items;
        $this->department= new Department;
        $this->orderline= new OrderLine;
        $this->supplier= new Supplier;
        $this->po= new PurchaseOrder;
        $this->inventory= new Inventory;
        $this->status= new Status;
        $this->po_logs= new PoLogs;
        $this->po_files= new PO_Attachments;

    }
    public function POCode()
    {
        $this->po->from=session()->get('user')->branch;
        $reqcount=$this->requisition->CountRequisitions()[0];
        $count = str_repeat("0", 4 - strlen($reqcount->reqcount)).$reqcount->reqcount;
        $reqcode="PO".session()->get('user')->BranchCode.$count;

        return $reqcode;

    }
    public function PurchaseOrderPage(){

        return view('Forms/Purchase Order/PurchaseOrder')->with('items', $this->items)->with('department',$this->department)->with('supplier',$this->supplier);
    }
    public function POList(){
        $this->status->stage=2;
        return view('Forms/Purchase Order/PoList')->with('items', $this->items)->with('department',$this->department)->with('supplier',$this->supplier)->with('status', $this->status);
    }
    public function PORequests(){
        return view('Forms/Purchase Order/PoApprovals')->with('items', $this->items)->with('department',$this->department)->with('supplier',$this->supplier);

    }

    public function GetBranchRequisitions(){
        return view('Forms.Purchase Order.AllRequisition')->with('items', $this->items)->with('department',$this->department)->with('supplier',$this->supplier);

    }

    public function handleUploadedFile($file, $poid)
    {
        try {
            //code...
            $destinationPath = public_path('storage/uploads');
        // Generate a unique name for the file
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            // Move the uploaded file to the destination path
            $file->move($destinationPath, $fileName);

            // You can store the file path or perform any other operations here
            $this->po_files->poid= $poid;
            $this->po_files->fileName=$fileName;
            $this->po_files->uploadFile();

        } catch (\Throwable $th) {
            //throw $th;
           $this->result = $th->getMessage();
        }
        // Set the destination path where the file will be stored

    }



    public function ForPOOrderline(){
        try {
            //code...
            return    $this->orderline->GetOrderLineForPO();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function DetailsPage($pono){
        try {
            //code...
            $this->po->po_no = $pono;
            $po =  $this->po->GetPOList()[0];

            $this->status->stage=2;
            return view('Forms/Purchase Order/Details')->with('items', $this->items)->with('department',$this->department)->with('supplier',$this->supplier)->with('po', $po)->with('status', $this->status);

        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function PODetailsPage($pono){
        try {
            //code...
            $this->po->po_no = $pono;
            $po =  $this->po->GetPOList()[0];
            $this->status->stage=2;
            $this->po_files->poid=$po->id;

            return view('Forms/Purchase Order/PODetails')->with('items', $this->items)->with('department',$this->department)->with('supplier',$this->supplier)->with('po', $po)->with('attachments', $this->po_files)->with('status', $this->status);

        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
      public function GetPoList(){
        try {
            //code...
            $this->po->po_no=null;
            return   $this->po->GetPOList();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

    }

    public function AddPurchaseOrder(Request $request){
         $validatedData = $request->validate(
            [
                'supplier' => 'required',
                'term' => 'required',
                'po_no' => 'required',
                'po_branch' => 'required',
                'requesters' => 'required',
                'prepared_by_id' => 'required',
                'remarks' => 'required',
                'po_items' => 'required'
            ]
    );
         try {
            //code...
            // add purchase order table
              $this->po->sup_id=$request->input("supplier");
              $this->po->term=$request->input("term");
              $this->po->po_no=$request->input("po_no");
              $this->po->status=4;
              $this->po->po_branch=$request->input("po_branch");
              $this->po->remark=$request->input("remarks");
              $this->po->requesters=$request->input("requesters");
              $this->po->prepared=$request->input("prepared_by_id");
              $this->po->AddPO();
            //  end code
            //  add logs
             $this->po_logs->uid = session()->get('user')->id;
             $this->po_logs->state = 4;
             $this->po_logs->po_id=$this->po->lastInsertedId;
             $this->po_logs->remarks="New Purchase Order Requested";
             $this->po_logs->AddPoLogs();
            //  end code


            // update to orderline table
                $this->orderline->po_no=$this->po->lastInsertedId;
              foreach (json_decode($request->input("po_items")) as $res) {
                $this->orderline->ol_id=$res->id;
                $this->orderline->UpdatePOid();
              }
            // end code
                 return        $this->po_logs->results."\n ".$this->orderline->result."\n ".$this->po->result;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }



    }
    public function UpdatePurchaseOrder(Request $request){
         $validatedData = $request->validate([
            'supplier' => 'required',
            'term' => 'required',
            'poid' => 'required',
            'remarks' => 'required',

        ]);
         try {
            //code...
            // update purchase order table

              $this->po->po_id      =   $request->input("poid");
              $this->po->sup_id     =   $request->input("supplier");
              $this->po->term       =   $request->input("term");
              $this->po->remark     =   $request->input("remarks");
              $this->po->UpdatePODetails();
            //  end code
            //add to logs
             $this->po_logs->uid = session()->get('user')->id;
             $this->po_logs->state = 16;
             $this->po_logs->po_id=$request->input("poid");
             $this->po_logs->remarks="PO Updated";
             $this->po_logs->AddPoLogs();

                 return   $this->po_logs->results."<br/> ".$this->po->result;
        } catch (\Throwable $th) {
            return $th->getMessage()." ".$th->getLine();
        }

    }

    public  function UpdateOrderline(Request $request)
    {
        // update to orderline table
        $delitems = json_decode($request->input("delitems"));

        $orders = json_decode($request->input("po_items"));

        $this->orderline->po_no = $request->input("poid");

        foreach ($orders as $res) {
            $this->orderline->ol_id=$res->id;
            $this->orderline->UpdatePOid();
        }
        // end

        // update quantity
        $updatedRecords = array_filter($orders, function ($item) {
        return isset($item->updated); // Assuming each updated record has an 'updated' flag
        });

        if (!empty($updatedRecords)) {
             foreach ($updatedRecords as $res) {

                  $this->orderline->ol_id=$res->id;
                  $this->orderline->quantity=$res->quantity;
                  $this->orderline->series_no=$res->series_no;
                  $this->orderline->UpdateOrder();

            }
        }
        // end

        //add to logs
        $this->po_logs->uid = session()->get('user')->id;
        $this->po_logs->state = 16;
        $this->po_logs->po_id=$request->input("poid");
        $this->po_logs->remarks="PO Items Updated";
        $this->po_logs->AddPoLogs();

        if ( count($delitems)>0 ){
            foreach (json_decode($request->input("delitems")) as $res) {
                $this->orderline->ol_id=$res->id;
                $this->orderline->removePOItem();
            }
        }
        // end code
        return    $this->orderline->result;
    }
     public function ApprovedPO(Request $request){
        try {
            //code...
            $this->po->po_id    =   $request->input("poid");
            $this->po->status   =   (int)$request->input("status") == 17? 8: 4;
            $this->po->approved =   $request->input("uid");

            //add to logs
            $this->po_logs->uid = session()->get('user')->id;
            $this->po_logs->state = $request->input("status");
            $this->po_logs->po_id=$request->input("poid");
            $this->po_logs->remarks=$request->input("remarks");
            $this->po_logs->AddPoLogs();

            $this->po_logs->state = (int)$request->input("status") == 17? 8: 4;
            $this->po_logs->remarks=(int)$request->input("status") == 17?"PO Reviewed and Approved":"PO Drafted";
            $this->po_logs->AddPoLogs();


            return $this->po->ApprovedPO();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function AddToInventory(Request $request){
        try {
            $po_items=json_decode($request->input("po_items"));
            //code...
            foreach ($po_items as $res) {

                for ($i = 1 ; $i <= $res->quantity; $i++){

                    $this->inventory->item_id=$res->iid;
                    $this->inventory->receiving_id=0;
                    $this->inventory->ol_id=$res->id;
                    $this->inventory->location=0;
                    $this->inventory->quantity=1;
                    $this->inventory->booklet=$i;
                    $this->inventory->set_qty = 0;
                    $this->inventory->series_start=0;
                    $this->inventory->series_end=0;
                    $this->inventory->AddToInventory();
                }
            }

            return $this->inventory->result;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function  AttachATPFile(Request $request){
        try {
            //code...
            if ($request->hasFile('atp_file')) {
                $files = $request->file('atp_file');
                if (is_array($files)) {
                    // Multiple files uploaded
                    foreach ($files as $file) {
                        // Handle each file individually
                        $this->handleUploadedFile($file, $request->input("poid"));
                    }
                } else {
                    // Single file uploaded
                    $this->handleUploadedFile($files, $request->input("poid"));
                }
            }
            // add logs
            $this->po_logs->uid = $request->input("uid");
            $this->po_logs->state = $request->input("status");
            $this->po_logs->po_id=7;
            $this->po_logs->remarks=$request->input("remarks");
            $this->po_logs->AddPoLogs();

            // update status
            $this->po->po_id    = $request->input("poid");
            $this->po->status   = 8;
            $this->po->updateStatus();

            //add to logs
            $this->po_logs->uid = $request->input("uid");
            $this->po_logs->state = 8;
            $this->po_logs->po_id=$request->input("poid");
            $this->po_logs->remarks=$request->input("remarks");
            $this->po_logs->AddPoLogs();

           return $this->po_files->result;
        } catch (\Throwable $th) {
            //throw $th;
            return $this->result = $th->getMessage();
        }

    }


    public function GetPORequest(){
        try {
            //code...
            return $this->po->GetPORequest();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

    }

    public function getAllRequisition(){
        try {
            //code...
             return $this->requisition->GetRequisitions();
        } catch (\Throwable $th) {
            return $th->getMessage();
            // return "Something went Wrong";

        }

    }

    public function getPologs($poid){
        try {
            //code...
            $this->po_logs->po_id=$poid;
            return $this->po_logs->getPoLogs();
        } catch (\Throwable $th) {
            return $th->getMessage();
            // return "Something went Wrong";

        }

    }
    public function getPOAttachments($poid){
        try {
            //code...
            $this->po_files->poid=$poid;
            return $this->po_files->getPOAttachments();

        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }

    }
    public function UpdateStatus(Request $request){
        try {
            //add to logs
            $this->po_logs->uid = session()->get('user')->id;
            $this->po_logs->state = $request->input("status");
            $this->po_logs->po_id=$request->input("poid");
            $this->po_logs->remarks=$request->input("remarks");
            $this->po_logs->AddPoLogs();
            //code...
            $this->po->po_id    =  $request->input("poid");
            $this->po->status   =  $request->input("status");
            return $this->po_logs->results."<br/>".$this->po->updateStatus();
        } catch (\Throwable $th) {
//            return $th->getMessage();
             return "Something went Wrong";

        }

    }
}
