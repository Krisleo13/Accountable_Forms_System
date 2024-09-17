<?php

namespace App\Http\Controllers;
use App\Models\Items;
use App\Models\Group;
use App\Models\Department;
use App\Models\Supplier;
use App\Models\BusinessUnit;
use App\Models\Company;
use App\Models\status as Status;
use App\Models\Employee;
use App\Models\Employees;

use Carbon\Carbon;
use Illuminate\View\View;

use Illuminate\Http\Request;


class ToolsController extends Controller
{
       public $items;
       public $group;
       public $department;
       public $supplier;
       public $bu;
       public $company;
       public $status;
       public $employee;
       public $employees;

    public function __construct(){
        $this->items= new Items;
        $this->group= new Group;
        $this->department = new Department;
        $this->supplier= new Supplier;
        $this->bu= new BusinessUnit;
        $this->company= new Company;
        $this->status= new Status;
        $this->employee= new Employee;
        $this->employees= new Employees;



    }
    public function ItemsPage(): View{
         return view('tools/items')->with('group',$this->group);

    }
    public function GroupPage(){
         return view('tools/group');

    }

    public function DepartmentPage(){
         return view('tools/Department')->with('bu',$this->bu)->with('company',$this->company);

    }
      public function SupplierPage(){
         return view('tools/supplier');

    }
    public function BUPage(){
         return view('tools/BusinessUnit');

    }
    public function CompanyPage(){
         return view('tools/Company')->with('bu',$this->bu);

    }

    public function EmployeePage(){
         return view('tools/Employee')->with('bu',$this->bu)->with('department',$this->department);

    }
    public function EmployeeDetailsPage($emp_id){
         $this->employees->id = $emp_id;
         $emp=$this->employees->getAllEmployees()[0];
         return view('tools/EmployeesDetails')->with('bu',$this->bu)->with('department',$this->department)->with('employee',$emp);

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
    public function AddGroup(Request $request){
        try {
            $this->group->setClassname($request->input('class_name'));
            $this->group->setCode($request->input('class_code'));
            $this->group->setDetails($request->input('details'));
            return $this->group->AddGroup();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
     public function AddDepartment(Request $request){
        try {
            $this->department->setBu($request->input('bu'));
            $this->department->setCompany($request->input('comp_name'));
            $this->department->setName($request->input('branch_dept'));
            $this->department->setAlias($request->input('alias'));
            $this->department->setCode($request->input('bcode'));
            $this->department->setStore($request->input('scode'));
            $this->department->setRole($request->input('role'));
            return $this->department->AddDeparment();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
      public function AddSupplier(Request $request){
        try {
            $this->supplier->setSupplier($request->input('supplier'));
            $this->supplier->setContact($request->input('contact_no'));
            $this->supplier->setName($request->input('name'));
            $this->supplier->setPosition($request->input('position'));
            $this->supplier->setEmail($request->input('email'));
            $this->supplier->setTermid($request->input('terms'));
            $this->supplier->setAddress($request->input('address'));
            $this->supplier->setStatus($request->input('status'));
            $this->supplier->setDescript($request->input('info'));
            return $this->supplier->AddSupplier();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
       public function AddBu(Request $request){
        try {

            $this->bu->name=$request->input('bu_name');
            $this->bu->description=$request->input('bu_description');
            $this->bu->active=$request->input('bu_state');
            return $this->bu->AddBu();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function AddCompany(Request $request){
        try {

           $this->company->bu_id=$request->input('buid');
           $this->company->name=$request->input('comp_name');
           $this->company->description=$request->input('comp_description');
           $this->company->active=$request->input('active');
            return $this->company->AddCompany();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function AddEmployee(Request $request){
        try {
           $this->employees->fname = $request->input('fname');
           $this->employees->lname = $request->input('lname');
           $this->employees->email = $request->input('email');
           $this->employees->position = $request->input('position');
           $this->employees->dept_id = $request->input('dept_id');
           $this->employees->active = $request->input('active');
            return $this->employees->AddEmployees();
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
    public function GetGroup(){
        try {
            return $this->group->GetGroup();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }


    }
    public function GetDepartment(){
        try {
            return $this->department->GetDeparment();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }


    }
      public function GetSupplier(){
        try {
            return $this->supplier->GetAllSupplier();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }


    }
      public function GetBu(){
        try {
            return  $this->bu->GetBu();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
      public function GetCompany(){
        try {
            return $this->company->GetCompany();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }


    }
    public function GetStatus($stage){
        try {
            return $this->status->getStatus();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }


    }
    public function GetEmployees(){
        try {
            return $this->employee->GetEmployees();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }


    }
     public function GetAllEmployees($dept_id){
        try {
            $this->employees->dept_id=$dept_id;
            $this->employees->id=null;
            return $this->employees->getAllEmployees();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

}
