<?php

namespace App\Http\Controllers\Operator\FinishGood;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Operator\CommonLogic;
use App\Models\Mylea\FinishGood;
use App\Models\Mylea\MyleaHarvest;
use App\Models\Mylea\MyleaProduction;
use Illuminate\Http\Request;

class FinishGoodController extends Controller
{
    public function FinishGoodForm($id)
    {
        $MyleaID = MyleaHarvest::select([
            'MyleaID',
        ])->where('id', $id)->first();
        $MyleaID = $MyleaID->MyleaID;
        return view('Operator.FinishGood.FinishGoodForm', [
            'HarvestID' => $id,
            'MyleaID' => $MyleaID
        ]);
    }

    public function FinishGoodSubmit(Request $request)
    {
        try {
            $date = date_create($request['FinishGoodDate']);
            $RawCode = "FG".date_format($date, "ymd");
    
            $id = FinishGood::create([
                'FinishGoodCode' => $RawCode,
                'FinishGoodDate' => $request['FinishGoodDate'],
                'HarvestID' => $request['HarvestID'],
                'Total' => $request['Total'],
            ])->id;
    
            $FinishGoodCode = new CommonLogic();
            $FinishGoodCode = $FinishGoodCode->ManipCode($id, $RawCode);
    
            FinishGood::where('id', $id)->update([
                'FinishGoodCode' => $FinishGoodCode,
            ]);

            $MyleaID = MyleaHarvest::where('id', $request['HarvestID'])->first();
    
            return redirect(route('MyleaHarvestData', ['id'=>$MyleaID->MyleaID]))->with('Success', 'Data submitted!');
        } catch (\Exception $e) {
            return redirect(route('MyleaHarvestData', ['id'=>$MyleaID->MyleaID]))->with('Error', 'Message : ' . $e->getMessage());
        }
      
    }

    public function FinishGoodData($id)
    {
        $FinishGoodData = FinishGood::where('HarvestID', $id)->get();

        $MyleaID = MyleaHarvest::select([
            'MyleaID',
        ])->where('id', $id)->first();
        $MyleaID = $MyleaID->MyleaID;
        
        return view('Operator.FinishGood.FinishGoodDetails', [
            'Data' => $FinishGoodData,
            'HarvestID' => $id,
            'MyleaID' => $MyleaID
        ]);
    }

    public function FinishGoodDelete($id, $details)
    {
        try {
            FinishGood::where('id', $id)->delete();
            return redirect(route('FinishGoodData', ['id'=>$details]))->with('Success', 'Data deleted!');
        } catch (\Exception $e) {
            return redirect(route('FinishGoodData', ['id'=>$details]))->with('Error', 'Message : '. $e->getMessage());
        }

    }
}
