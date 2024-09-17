<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Department extends Model
{
    use HasFactory;
    private $bu;
    private $company;
    private $name;
    private $alias;
    private $code;
    private $store;
    private $role;
public function permissions() {
    return $this->belongsTo(User::class);
}
    public function AddDeparment(){
        try {
            DB::select('CALL AddDepartment(?, ?, ?, ?, ?, ?, ?, ?, ?)', [$this->bu, $this->company,$this->name, $this->alias, $this->store, $this->code, $this->role, now(), now()]);
            $this->result = "Department Added";
            $this->icon = "success";
            return $this->result;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

    }
    public function GetDeparment(){
        try {
             $this->result =DB::select('CALL GetDepartment()');

            return $this->result;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

    }
      public function SearchDeparment(){
        try {
             $this->result =DB::select('CALL SearchDepartment(?)', [$this->code]);

            return $this->result;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

    }



    public function setBu($bu) {
        $this->bu = $bu;
    }

    public function setCompany($company) {
        $this->company = $company;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setAlias($alias) {
        $this->alias = $alias;
    }

    public function setCode($code) {
        $this->code = $code;
    }

    public function setStore($store) {
        $this->store = $store;
    }

    public function setRole($role) {
        $this->role = $role;
    }

    // Getter methods
    public function getBu() {
        return $this->bu;
    }

    public function getCompany() {
        return $this->company;
    }

    public function getName() {
        return $this->name;
    }

    public function getAlias() {
        return $this->alias;
    }

    public function getCode() {
        return $this->code;
    }

    public function getStore() {
        return $this->store;
    }

    public function getRole() {
        return $this->role;
    }


}
