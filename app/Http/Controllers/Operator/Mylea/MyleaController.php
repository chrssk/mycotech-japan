<?php

namespace App\Http\Controllers\Operator\Mylea;

use App\Http\Controllers\Controller;
use App\Models\Baglog\Baglog;
use App\Models\Mylea\MyleaProduction;
use App\Http\Controllers\Operator\CommonLogic;
use App\Models\Baglog\UsedBaglog;
use Illuminate\Http\Request;
use App\Http\Controllers\Operator\Baglog\BaglogLogic;

class MyleaController extends Controller
{
    public function MyleaProductionForm()
    {
        $BaglogInStock = new BaglogLogic;
        $BaglogInStock = $BaglogInStock->InStockBaglog();
        return view('Operator.Mylea.ProductionForm', ['BaglogData' => $BaglogInStock,]);
    }

    public function MyleaProductionSubmit(Request $request)
    {
        $date = date_create($request['ArrivalDate']);
        $RawCode = "MYJT0".date_format($date, "ymd");

        $id = MyleaProduction::create([
            'MyleaCode' => $RawCode,
            'ProductionDate' => $request['ProductionDate'],
            'TotalTray' => $request['TotalTray'],
        ])->id;

        $MyleaCode = new CommonLogic();
        $MyleaCode = $MyleaCode->ManipCode($id, $RawCode);

        MyleaProduction::where('id', $id)->update([
            'MyleaCode' => $MyleaCode,
        ]);

        foreach($request['data'] as $item){
            UsedBaglog::create([
                'BaglogID' => $item['BaglogID'],
                'MyleaID' => $id,
                'Total' => $item['Quantity'],
            ]);
        }
        return redirect(route('MyleaProductionForm'))->with('StatusSubmit', 'Data submitted!');
    }
}
