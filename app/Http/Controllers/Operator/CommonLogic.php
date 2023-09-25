<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Baglog\Baglog;
use Illuminate\Http\Request;

class CommonLogic 
{
    public function ManipCode($id, $RawCode){
        $len = strlen($id);
        if ($len < 3){
            $idManip = $id;
            for($i = 0; $i < (3-$len); $i++ ){
                $idManip = '0'.$idManip;
            }
        } else {
            $idManip = substr($id, -3);
        }
        
        $Code = $RawCode.$idManip;

        return $Code;
    }
}
