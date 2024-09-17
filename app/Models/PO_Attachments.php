<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;

class PO_Attachments extends Model
{
    use HasFactory;
    public $fileName;
    public $poid;

    function  uploadFile() {
         try {
            DB::select('CALL `AddPOAttach`(?, ?, ?, ?)', [$this->fileName,$this->poid,now(),now()]);
            $this->result ="File Attached";
            return $this->result;
        } catch (\Throwable $th) {
            return    $this->result = $th->getMessage();
        }

    }
    function  getPOAttachments() {
         try {
           $this->result = DB::select('CALL `getAttachments`( ?)', [$this->poid]);
            return $this->result;
        } catch (\Throwable $th) {
            return    $this->result = $th->getMessage();
        }

    }
}
