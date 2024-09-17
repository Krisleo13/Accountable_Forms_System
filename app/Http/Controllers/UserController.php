<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;
use App\Models\User;
use App\Models\UserRoles;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    private $employees;
    public $users;
    public $department;
    public $user_roles;

     public function __construct()
    {
        $this->employees = new Employee;
        $this->users = new User;
        $this->department = new Department;
        $this->user_roles = new UserRoles;


    }
    //
 public function CreateUser(){
        return view('Users/CreateUser')->with('employees', $this->employees)->with('department', $this->department);

 }

 public function UsersList(){
        return view('Users/UsersList')->with('employees', $this->employees)->with('department', $this->department);

 }
 public function Login(){
    if(session()->has('user')){

        return redirect('/dashboard');

    }
        return view('auth/login')->with('employees', $this->employees);
 }
 public function Logout(){
    session()->forget('user');
    return redirect('/Login');

 }

 public function Auth(Request $request){

     $validatedData = $request->validate([

            'email' => 'required',
            'password' => 'required'
        ]);
    try {
        //code...
        $this->users->email = $validatedData['email'];
        $user = $this->users->Auth()[0];
        if ( isset($user) && Hash::check($request->password, $user->password)) {
            session()->put('user',$user);
            return "Login Successful";
        }

        return "Invalid credentials";

    } catch (\Throwable $th) {
        return $th->getMessage();
    }
 }

  public function AddUser(Request $request){



     $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'position' => 'required',
            'branch' => 'required',
            'role' => 'required',
            'emp_id' => 'required',
            'dept_id' => 'required'

        ]);


    try {
        //code...
        $this->users->email = $validatedData['email'];
        $this->users->password = bcrypt($validatedData['password']);
        $this->users->name = $validatedData['name'];
        $this->users->branch = $validatedData['dept_id'];
        $this->users->position = $validatedData['position'];
        $this->users->empid = $validatedData['emp_id'];
        $this->users->roles = $validatedData['role'];

        $this->users->AddUser();


    return $this->users->result;

    } catch (\Throwable $th) {
        return $th->getMessage();
    }

 }
   public function GetUserbyRole(){
    try {
        //code...
        $this->users->roles=4;
        $this->users->branch=session()->get('user')->branch;
    return  $this->users->GetUsers();

    } catch (\Throwable $th) {
        return $th->getMessage();
    }

 }
 public function GetAllUser(){
    try {
        //code...
        $this->users->roles=null;
        $this->users->branch=session()->get('user')->branch;
    return  $this->users->GetUsers();

    } catch (\Throwable $th) {
        return $th->getMessage();
    }

 }


 public function UpdateUser(Request $request){
     $validatedData = $request->validate([
            'name' => 'required',
            'position' => 'required',
            'branch' => 'required',
            'email' => 'required',
            'uid' => 'required',
            'active' => 'required'

        ]);

    try {
        //code...
        $pass=$request->input("password");
        $this->users->email = $validatedData['email'];
        $this->users->password = isset($pass)?bcrypt($request->input("password")):'';
        $this->users->name = $validatedData['name'];
        $this->users->branch = $validatedData['branch'];
        $this->users->position = $validatedData['position'];
        $this->users->active = $validatedData['active'];
        $this->users->id = $validatedData['uid'];
        $this->users->UpdateUser();

        return $this->users->UpdateUser();

    } catch (\Throwable $th) {
        //throw $th;
        return $th->getMessage() ;
    }

 }
 public function UpdateUserRoles(Request $request){
     $validatedData = $request->validate([
            'incharge' => 'required',
            'branch_manager' => 'required',
            'regional_manager' => 'required',
            'admin' => 'required',
            'role_id' => 'required'

        ]);
    try {
        //code...
        $this->user_roles->incharge=$validatedData['incharge'];
        $this->user_roles->admin=$validatedData['admin'];
        $this->user_roles->branch_manager=$validatedData['branch_manager'];
        $this->user_roles->regional_manager=$validatedData['regional_manager'];
        $this->user_roles->id=$validatedData['role_id'];

        $this->user_roles->UpdateUserRoles();

        return $this->users->result;

    } catch (\Throwable $th) {
        //throw $th;
        return $th->getMessage() ;
    }

 }
 public function AssignUserRoles(Request $request){
    try {
        //code...
         $this->user_roles->uid=$request->input("uid");
         $this->user_roles->incharge=$request->input("incharge");
         $this->user_roles->branch_manager=$request->input("branch_manager");
         $this->user_roles->admin=$request->input("admin");
         $this->user_roles->regional_manager=$request->input("regional_manager");
         $this->user_roles->AddUserRoles();

        return  $this->user_roles->result;

    } catch (\Throwable $th) {
        //throw $th;
        return $th->getMessage() ;
    }

 }
}
