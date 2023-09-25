<?php

namespace App\Http\Controllers\Operator\Baglog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Baglog\Baglog;

class BaglogController extends Controller
{
    public function BaglogInputForm()
    {
        return view('Operator.Baglog.InputForm');
    }

    public function BaglogSubmit(Request $request){
        $date = date_create($request['ArrivalDate']);
        $BaglogCode = "BLJP".date_format($date, "ymd");
        $id = Baglog::create([
            'BaglogCode' => $BaglogCode, 
            'ArrivalDate'=>$request['ArrivalDate'],
            'Quantity' => $request['Quantity'],
            'Notes' => $request['Notes']
        ])->id;

        $len = strlen($id);
        if ($len < 3){
            $idManip = $id;
            for($i = 0; $i < (3-$len); $i++ ){
                $idManip = '0'.$idManip;
            }
        } else {
            $idManip = substr($id, -3);
        }
        
        $BaglogCode = $BaglogCode.$idManip;
        $Status= Baglog::where('id','=',$id)->update([
            'BaglogCode' => $BaglogCode,
        ]);

        if($Status){
            $Message = 'Data submitted';
        } else {
            $Message = 'Data submission unsuccessful';
        }

        return redirect(route('BaglogInputForm'))->with('StatusSubmit', $Message);
    }

    public function BaglogMonitoring()
    {
        $Data = Baglog::paginate(2);
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
