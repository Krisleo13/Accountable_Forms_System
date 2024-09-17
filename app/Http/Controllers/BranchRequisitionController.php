<?php

namespace App\Http\Controllers;

use App\Models\status;
use Illuminate\Http\Request;
use App\Models\Requisition;
use App\Models\Items;
use App\Models\Department;
use App\Models\OrderLine;
use App\Models\requisition_logs as ReqLogs;



use Carbon\Carbon;
use MongoDB\Driver\Session;

class BranchRequisitionController  extends Controller
{
        private $requisition;
        private $items;
        private $orderline;
        private $department;
        private $status;

        private $req_logs;

    public function __construct()
    {
        $this->requisition= new Requisition;
        $this->items= new Items;
        $this->department= new Department;
        $this->orderline= new OrderLine;
        $this->status= new status;
        $this->req_logs= new ReqLogs;


    }
    public function RequisitionCode()
    {
        $this->requisition->from=session()->get('user')->branch;
        $reqcount=$this->requisition->CountRequisitions()[0];
        $count = str_repeat("0", 4 - strlen($reqcount->reqcount)).$reqcount->reqcount;
        $reqcode="REQ".session()->get('user')->BranchCode.$count;


        return $reqcode;

    }
    public function DetailsPage($reqno){

        try{

            $this->requisition->req_no=$reqno;
            $this->status->stage=1;
            $requisition = $this->requisition->GetRequisitions()[0];
            return view('Forms/Requisition/Details')->with('items', $this->items)->with('department',$this->department)->with('requisition',$requisition)->with('orderline',$this->orderline)->with('status',$this->status);
        }catch(\Throwable $th){
             $this->requisition->req_no=$reqno;

             return $this->requisition->GetRequisitions();

        }
    }
    public function RequisitionPage(){

        return view('Forms/Requisition/Requisition')->with('items', $this->items)->with('department',$this->department);
    }

    public function RequisitionListPage(){

        return view('Forms/Requisition/RequisitionList')->with('items', $this->items)->with('department',$this->department);
    }
    public function RequisitionRequestPage(){

        return view('Forms/Requisition/ReqApprovals')->with('items', $this->items)->with('department',$this->department);
    }
    public function RequisitionDetailsPage($reqno)
    {
        try{

            $this->requisition->req_no=$reqno;
            $this->status->stage=1;
            $requisition = $this->requisition->GetRequisitions()[0];
            return view('Forms/Requisition/RequisitionDetails')->with('items', $this->items)->with('department',$this->department)->with('requisition',$requisition)->with('orderline',$this->orderline)->with('status',$this->status);
        }catch(\Throwable $th){
             $this->requisition->req_no=$reqno;

             return $this->requisition->GetRequisitions();

        }
    }
    public function RequisitionApprovalPage()
    {
        try{

            return view('Forms/Requisition/RequisitionDetails')->with('items', $this->items)->with('department',$this->department)->with('orderline',$this->orderline);
        }catch(\Throwable $th){

             return $th->getMessage();

        }
    }
    public function RequisitionOrdersPage()
    {
        try{

            return view('Forms/Requisition/RequisitionOrders')->with('items', $this->items)->with('department',$this->department)->with('orderline',$this->orderline);
        }catch(\Throwable $th){

             return $th->getMessage();

        }
    }
    public function AddRequisition(Request $request)
    {
        $validatedData = $request->validate([
//            'req_no' => 'required',
            'to' => 'required',
            'from' => 'required',
            'attn' => 'required',
            'status' => 'required',
            'prepared_by_id' => 'required',
            'remarks' => 'required',
            'orderline_items' => 'required',
            'orderline_items.*.description_id' => 'required',
            'orderline_items.*.quantity' => 'required|numeric|min:1',
            'orderline_items.*.cost' => 'required|numeric|min:0',
            'orderline_items.*.series_no' => 'required',
        ]);

        try {
            $this->requisition->req_no = $this->RequisitionCode();
            $this->requisition->to=$request->input("to");
            $this->requisition->from=$request->input("from");
            $this->requisition->attn=$request->input("attn");
            $this->requisition->status=$request->input("status");
            $this->requisition->prepared_id=$request->input("prepared_by_id");
            $this->requisition->remarks=$request->input("remarks");
            $this->requisition->AddRequisition();

            //add requisition logs
            $this->req_logs->req_id=$this->requisition->lastInsertedId;
            $this->req_logs->state=1;
            $this->req_logs->uid=session()->get('user')->id;
            $this->req_logs->remarks="Created a Purchase Request";
            $this->req_logs->AddRequisitionLogs();

//           add the orders
            $this->orderline->req_no=$this->requisition->lastInsertedId;
            $this->orderline->remarks=$validatedData['remarks'];
            foreach (json_decode($validatedData['orderline_items']) as $res) {

                $this->orderline->item_id=$res->description_id;
                $this->orderline->quantity=$res->quantity;
                $this->orderline->cost=$res->cost;
                $this->orderline->series_no=$res->series_no;

                $this->orderline->AddOrderLine();

            }

            return  $this->req_logs->result."\n".$this->requisition->result. " " . $this->orderline->result;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function getRequisition($bid,$reqno){
        try {
            //code...
             $this->requisition->req_no=$reqno;
             $this->requisition->from=$bid;
             return $this->requisition->RequisitionApprovals();

        } catch (\Throwable $th) {
            return $th->getMessage();
            // return "Something went Wrong";
        }
    }

    public function getMyRequisition(){
        try {
            //code...s
             $this->requisition->prepared_id=session()->get('user')->id;
             return $this->requisition->GetRequisitions();

        } catch (\Throwable $th) {
            return $th->getMessage();
            // return "Something went Wrong";
        }

    }
    public function getRequisitionApprovals($dept_id){
        try {
            //code...
            $this->requisition->from=$dept_id;
             return $this->requisition->RequisitionApprovals();

        } catch (\Throwable $th) {
            return $th->getMessage();
            // return "Something went Wrong";
        }

    }
    public function getRequisitionLogs($reqid){
        try {
            //code...
            $this->req_logs->req_id=$reqid;
            return $this->req_logs->GetRequisitionLogs();

        } catch (\Throwable $th) {
            return $th->getMessage();
            // return "Something went Wrong";
        }

    }
    public function getOrderline($pono,$reqno){
        try {
            //code...
             $this->orderline->req_no=$reqno;
             $this->orderline->po_no=$pono;
             return $this->orderline->GetOrderLine();

        } catch (\Throwable $th) {
            return $th->getMessage();
            // return "Something went Wrong";

        }

    }
    public function RequisitionApprovals(Request $request){
        try {
            //code...
            //add requisition logs
            $state = (int) $request->input("status");

            $this->req_logs->req_id = $request->input("reqid");
            $this->req_logs->state =  $state;
            $this->req_logs->uid = session()->get('user')->id;
            $this->req_logs->remarks = $request->input("remarks");
            $this->req_logs->AddRequisitionLogs();
            $this->req_logs->state= $state == 17? 3: 1;
            $this->req_logs->remarks = $state == 17? "Request is Now Final" : "Request Drafted";
            $this->req_logs->AddRequisitionLogs();


            // reset noted
            if($state==21){

                $this->requisition->req_id = $request->input("reqid");
                $this->requisition->noted_id = 0;
                $this->requisition->noted_date = null;
                $this->requisition->status = $state == 17? 1: 3;
                $this->requisition->RequisitionNoted();

            }

            // approve requisition
            $this->requisition->req_id = $request->input("reqid");
            $this->requisition->approved_id = $state == 17?$request->input("uid"):null;
            $this->requisition->status = $state == 17? 3:1;
            return $this->requisition->RequisitionApproved();






        } catch (\Throwable $th) {
            return $th->getMessage();
            // return "Something went Wrong";

        }

    }
    public function RequisitionNoted(Request $request){
        try {
            $res="";
            //code...
                //add requisition logs
                $this->req_logs->req_id = $request->input("reqid");
                $this->req_logs->state = $request->input("status");
                $this->req_logs->uid = session()->get('user')->id;
                $this->req_logs->remarks = $request->input("remarks");
                $this->req_logs->AddRequisitionLogs();
                $res.= $this->req_logs->result."\n";
                //

                //requisition noted code
                $this->requisition->req_id = $request->input("reqid");
                $this->requisition->noted_id = intval($request->input("status")) == 1? 0 : intval($request->input("uid"));
                $this->requisition->noted_date = intval($request->input("status")) == 1? null : now();
                $this->requisition->status = intval($request->input("status")) === 1 ? 1 : 2;
                $this->requisition->RequisitionNoted();
                $res.= $this->requisition->result."\n";
                //

              return $res." status". $this->requisition->status;

        } catch (\Throwable $th) {
            return $th->getMessage();
            // return "Something went Wrong";

        }

    }
    public function updateRequisition(Request $request){

        // return $request;
         $validatedData = $request->validate([
            'req_no' => 'required',
            'reqid' => 'required',
            'to' => 'required',
            'from' => 'required',
            'attn' => 'required',
            'status' => 'required',
            'remarks' => 'required'
        ]);


        try {
            //add requisition logs
            $this->req_logs->req_id=$request->input("reqid");
            $this->req_logs->state=16;
            $this->req_logs->uid=session()->get('user')->id;
            $this->req_logs->remarks="Requisition Updated";
            $this->req_logs->AddRequisitionLogs();

            //requisition details
            $this->requisition->req_no = $validatedData["req_no"];
            $this->requisition->req_id=$request->input("reqid");
            $this->requisition->to=$request->input("to");
            $this->requisition->from=$request->input("from");
            $this->requisition->attn=$request->input("attn");
            $this->requisition->status=$request->input("status");
            $this->requisition->remarks=$request->input("remarks");

            $this->orderline->req_no=$request->input("reqid");
            $this->orderline->remarks=$validatedData['remarks'];

            // update the updated quantity and series number in the items

            // $result=$result." ".$this->orderline->result;
            return    $this->requisition->UpdateRequisition();
        }catch(\Throwable $th){
                return $th->getMessage();
        }
    }
    public function UpdateOrderlines(Request $request){
        $validatedData = $request->validate([
            'req_items' => 'required',
        ]);
        try {
            //code...
            $this->orderline->req_no=$request->input("reqid");
            $this->orderline->remarks="    ";

             foreach (json_decode($request->input('req_items')) as $res) {

                if(isset($res->updated)){
                    $this->orderline->ol_id=(int)$res->id;
                    $this->orderline->quantity=(int)$res->quantity;
                    $this->orderline->series_no=(int)$res->series_no;
                    $this->orderline->UpdateOrder();
                }

                if(!isset($res->id)){
                    $this->orderline->item_id=$res->description_id;
                    $this->orderline->quantity=$res->quantity;
                    $this->orderline->cost=$res->cost;
                    $this->orderline->series_no=$res->series_no;
                    $this->orderline->AddOrderLine();
                }
            }
            // delete the removed items
            foreach (json_decode($request->input('del_item')) as $res) {
                $this->orderline->ol_id=$res->id;
                $this->orderline->Delete();
            }
                   return      $this->orderline->result;
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }


    }
    public function UpdateStatus(Request $request){
        $validatedData = $request->validate([
            'reqid' => 'required',
            'status' => 'required',
            'remarks' => 'required',
        ]);
        try {
            //code...
            //add requisition logs
            $this->req_logs->req_id=$request->input("reqid");
            $this->req_logs->state=$request->input('status');
            $this->req_logs->uid=session()->get('user')->id;
            $this->req_logs->remarks=$request->input('remarks');
            $this->req_logs->AddRequisitionLogs();

//            update requisition status
            $this->requisition->req_id = $request->input('reqid');
            $this->requisition->status = $request->input('status');
            return $this->requisition->UpdateRequisitionStatus();

        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }


    }
    public function RequisitionFinal($reqid){
        try {
            //code...
            $this->req_logs->req_id = $reqid;
            $this->req_logs->state = 3;
            $this->req_logs->uid = session()->get('user')->id;
            $this->req_logs->remarks="<b class='text-danger'>System: This requisition is now finalized, and the details are no longer available for editing </b>";
            $this->req_logs->AddRequisitionLogs();

//            final the request
              $this->requisition->req_id = $reqid;
              return $this->requisition->RequisitionFinal();
        } catch (\Throwable $th) {
            return $th->getMessage();
            // return "Something went Wrong";

        }

    }
    public function getRequisitionOrders($dept_id){
        try {
            //code...
             $this->requisition->from = $dept_id;
             return $this->requisition->GetOrders();
        } catch (\Throwable $th) {
            return $th->getMessage();
            // return "Something went Wrong";

        }

    }
}
