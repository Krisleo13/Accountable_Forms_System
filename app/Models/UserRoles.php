<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;


class UserRoles extends Model
{
    use HasFactory;

    public $id;
    public $uid;
    public $incharge;
    public $branch_manager;
    public $admin;
    public $regional_manager;
    public $result;

    public function AddUserRoles() {
        try {
            //code...
            DB::select('CALL `AddUserRoles`(?, ?, ?, ?, ?, ?, ? )', [$this->uid, $this->incharge, $this->admin, $this->branch_manager, $this->regional_manager, now(), now()]);
            $this->result="User Role Assigned";
            return $this->result;
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }
    }
     public function UpdateUserRoles() {
        try {
            //code...
            DB::select('CALL `UpdateUserRoles`(?, ?, ?, ?, ?, ? )', [ $this->incharge, $this->admin, $this->branch_manager, $this->regional_manager,$this->id, now()]);
            $this->result="User Role Updated";
            return $this->result;
        } catch (\Throwable $th) {
            //throw $th;
            return  $this->result=$th->getMessage();
        }
    }

}
