<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class Supplier extends Model
{
    use HasFactory;
    private $sup_id;
    private $supplier;
    private $contact;
    private $name;
    private $position;
    private $email;
    private $termid;
    private $address;
    private $status;
    private $descript;
// classes for this model

public function AddSupplier(){
    try {
            DB::select('CALL AddSupplier(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$this->supplier, $this->contact,$this->name, $this->position, $this->email, $this->termid,$this->address,$this->status,$this->descript, now(), now()]);
            $this->result = "supplier added";
            $this->icon = "success";
            return $this->result;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

}
public function GetAllSupplier(){
    try {
            $this->result = DB::select('CALL GetSupplier()');

            return $this->result;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

}




// end

// setter and getters
     public function getSupId() {
        return $this->sup_id;
    }

    public function setSupId($sup_id) {
        $this->sup_id = $sup_id;
    }

    public function getSupplier() {
        return $this->supplier;
    }

    public function setSupplier($supplier) {
        $this->supplier = $supplier;
    }

    public function getContact() {
        return $this->contact;
    }

    public function setContact($contact) {
        $this->contact = $contact;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getPosition() {
        return $this->position;
    }

    public function setPosition($position) {
        $this->position = $position;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getTermid() {
        return $this->termid;
    }

    public function setTermid($termid) {
        $this->termid = $termid;
    }

    public function getAddress() {
        return $this->address;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getDescript() {
        return $this->descript;
    }

    public function setDescript($descript) {
        $this->descript = $descript;
    }
//

}
