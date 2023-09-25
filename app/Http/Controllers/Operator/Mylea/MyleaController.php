<?php

namespace App\Http\Controllers\Operator\Mylea;

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
        ->get();

        $BaglogInStock = array();
        $i = 0;
        foreach($Baglog->groupBy('BaglogCode') as $key => $item){
            $BaglogInStock[$i]['BaglogCode'] =  $key;
            $UsedBaglog =  $item->sum('Total');
            $Quantity = $Baglog->where('BaglogCode', $key)->first()->Quantity;
            $BaglogInStock[$i]['InStock'] = $Quantity - $UsedBaglog;
            $i++;
        }
        return view('Operator.Mylea.ProductionForm', ['BaglogData' => $BaglogInStock,]);
    }
}
