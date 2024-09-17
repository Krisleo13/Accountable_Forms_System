<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class Items extends Model
{
    use HasFactory;

    private $description;
    private $type;
    private $classification;
    private $cost;
    private $unit;
    private $supplier;
    private $created;
    private $updated;


    public function AddItems(){
        try {
            DB::select('CALL AddItem(?, ?, ?, ?, ?, ?, ?, ?)', [$this->description, $this->type,$this->classification, $this->cost, $this->supplier, now(),now(), $this->unit]);
            $this->result = "Add Ticket Succeed";
               
            $this->icon = "success";
            return $this->result;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

    }
    public function GetItems(){
        try {
            $this->result=DB::select('CALL GetItems()');

            return $this->result;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function setClassification($classification)
    {
        $this->classification = $classification;
    }

    public function setCost($cost)
    {
        $this->cost = $cost;
    }

    public function setUnit($unit)
    {
        $this->unit = $unit;
    }

    public function setSupplier($supplier)
    {
        $this->supplier = $supplier;
    }

    public function setCreated($created)
    {
        $this->created = $created;
    }

    public function setUpdated($updated)
    {
        $this->updated = $updated;
    }

    // Getter methods
    public function getDescription()
    {
        return $this->description;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getClassification()
    {
        return $this->classification;
    }

    public function getCost()
    {
        return $this->cost;
    }

    public function getUnit()
    {
        return $this->unit;
    }



}
