<?php

namespace App\Http\Controllers\Operator\Baglog;

use App\Http\Controllers\Controller;
use App\Models\Baglog\Baglog;
use Illuminate\Http\Request;

class MyleaController extends Controller
{
    public function MyleaProductionForm()
    {
        $Baglog = Baglog::select([
            'baglog.BaglogCode',
            'baglog.ArrivalDate',
            'baglog.Quantity',
            'used_baglog.Total',
        ])
        ->leftJoin('used_baglog', 'baglog.id', 'used_baglog.BaglogID')
        //->groupBy('baglog.BaglogCode')
        ->get();
        //return view('Operator.Mylea.ProductionForm');
        $BaglogInStock = array();
        $i = 0;
        foreach($Baglog->groupBy('BaglogCode') as $key => $item){
            $BaglogInStock[$i]['BaglogCode'] =  $key;
            $BaglogInStock[$i]['UsedTotal'] =  $item->sum('Total');
            $BaglogInStock[$i]['Quantity'] = $Baglog->where('BaglogCode', $key)->first()->Quantity;
            $i++;
        }
        return response($BaglogInStock);
    }
}
