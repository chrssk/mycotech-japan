<?php

namespace App\Http\Controllers\Operator\Baglog;

use App\Http\Controllers\Controller;
use App\Models\Baglog\Baglog;
use App\Models\Baglog\UsedBaglog;
use Illuminate\Http\Request;

class BaglogLogic 
{
    public function InStockBaglog()
    {
        $Baglog = Baglog::select([
            'baglog.id',
            'baglog.BaglogCode',
            'baglog.ArrivalDate',
            'baglog.Quantity',
            'used_baglog.Total',
        ])
        ->leftJoin('used_baglog', 'baglog.id', 'used_baglog.BaglogID')
        ->get();

        $BaglogInStock = array();
        $i = 0;
        foreach($Baglog->groupBy('BaglogCode') as $key => $item){
            $BaglogInStock[$i]['BaglogCode'] =  $key;
            $BaglogInStock[$i]['id'] = $Baglog->where('BaglogCode', $key)->first()->id;
            $BaglogInStock[$i]['ArrivalDate'] = $Baglog->where('BaglogCode', $key)->first()->ArrivalDate;
            $UsedTotal =  $item->sum('Total');
            $Quantity = $Baglog->where('BaglogCode', $key)->first()->Quantity;
            $BaglogInStock[$i]['InStock'] =  $Quantity - $UsedTotal ;
            $i++;
        }
        return $BaglogInStock;
    }

    public function InStockBaglogPerCode($BaglogID, $Quantity){
        $Baglog = UsedBaglog::select([
            'used_baglog.BaglogID',
            'used_baglog.Total',
        ])
        ->where('BaglogID',$BaglogID)
        ->get();

        $InStock = $Quantity - $Baglog->sum('Total');

        return $InStock;

    }

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
        
        $BaglogCode = $RawCode.$idManip;

        return $BaglogCode;
    }
}
