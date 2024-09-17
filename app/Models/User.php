<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'emp_id',
        'role',
        'position',
        'branch',
        'name',
        'email',
        'password',
    ];
    public $id;
    public $email;
    public $password;
    public $name;
    public $branch;
    public $position;
    public $empid;
    public $roles;
    public $active;
    public $result;





    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function Auth() {
        try {
            //code...
            $this->result =  DB::select('CALL `Auth`(?)', [$this->email]);

            return $this->result;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
     public function AddUser() {
        try {
            //code...
            DB::select('CALL `AddUser`(?, ?, ?, ?, ?, ?, ?, ?, ? )', [$this->name, $this->password, $this->email, $this->empid, $this->roles, $this->position, $this->branch, now(), now()]);
            $this->result="User Added";
            return $this->result;
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }
    }

     public function UpdateUser() {
        try {
            //code...
            DB::select('CALL `UpdateUser`( ?, ?, ?, ?, ?, ?, ?, ? )', [$this->id, $this->name, $this->position, $this->branch, $this->active, $this->email, $this->password, now()]);

            return $this->result="User Details Updated";
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }
    }

      public function GetUsers() {
        try {
            //code...
            $this->result = DB::select('CALL `GetUsers`(?, ?)', [$this->branch, $this->roles ]);
            return $this->result;
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }
    }




}
