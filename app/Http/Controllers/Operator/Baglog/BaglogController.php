<?php

namespace App\Http\Controllers\Operator\Baglog;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Operator\CommonLogic;
use Illuminate\Http\Request;
use App\Models\Baglog\Baglog;
use App\Models\Baglog\UsedBaglog;
use App\Models\Mylea\MyleaProduction;
use App;

class BaglogController extends Controller
{
    public function BaglogInputForm()
    {
        return view('Operator.Baglog.InputForm');
    }

    public function BaglogSubmit(Request $request){
        try {

            $date = date_create($request['ArrivalDate']);
            $RawCode = "BLJP".date_format($date, "ymd");

            Baglog::create([
                'BaglogCode' => $RawCode, 
                'ArrivalDate'=>$request['ArrivalDate'],
                'Quantity' => $request['Quantity'],
                'Notes' => $request['Notes']
            ]);
            
            return redirect(route('BaglogInputForm'))->with('StatusSubmit', 'Data submitted');

        } catch (\Exception $e) {
            return redirect(route('BaglogInputForm'))->with('StatusSubmit', 'Data submission unsuccessfull ' . $e->getMessage() );
        }
     

        // $id = Baglog::create([
        //     'BaglogCode' => $RawCode, 
        //     'ArrivalDate'=>$request['ArrivalDate'],
        //     'Quantity' => $request['Quantity'],
        //     'Notes' => $request['Notes']
        // ])->id;

        // $BaglogCode = new CommonLogic();
        // $BaglogCode = $BaglogCode->ManipCode($id, $RawCode);

        // $Status= Baglog::where('id','=',$id)->update([
        //     'BaglogCode' => $BaglogCode,
        // ]);

        // if($Status){
        //     $Message = 'Data submitted';
        // } else {
        //     $Message = 'Data submission unsuccessful';
        // }

        // return redirect(route('BaglogInputForm'))->with('StatusSubmit', $Message);
    }

    public function BaglogMonitoring()
    {
        $Data = Baglog::paginate(10);

        foreach ($Data as $data) {
            $data['Mylea'] = UsedBaglog::where('BaglogID', $data['id'])
            ->leftJoin('mylea_production', 'used_baglog.MyleaID', 'mylea_production.id')
            ->get();
            $InStock = new BaglogLogic();
            $InStock = $InStock->InStockBaglogPerCode($data['id'], $data['Quantity']);
            $data['InStock'] = $InStock;
        }
        return view('Operator.Baglog.Monitoring', [
            'Data'=>$Data,
        ]);
    }

    public function BaglogMonitoringUpdate(Request $request)
    {
        Baglog::where('id', $request['id'])->update([
            'ArrivalDate'=>$request['ArrivalDate'],
            'Quantity' => $request['Quantity'],
            'Notes' => $request['Notes']
        ]);
        return redirect(route('BaglogMonitoring'))->with('StatusUpdate', 'Data updated!');
    }

    public function BaglogMonitoringDelete($id)
    {
        Baglog::where('id', $id)->delete();
        return redirect(route('BaglogMonitoring'))->with('StatusDeleted', 'Data deleted!');
    }
}
