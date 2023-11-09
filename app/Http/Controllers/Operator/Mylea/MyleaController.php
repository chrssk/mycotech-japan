<?php

namespace App\Http\Controllers\Operator\Mylea;

use App\Http\Controllers\Controller;
use App\Models\Baglog\Baglog;
use App\Models\Mylea\MyleaProduction;
use App\Models\Mylea\MyleaHarvest;
use App\Http\Controllers\Operator\CommonLogic;
use App\Models\Baglog\UsedBaglog;
use Illuminate\Http\Request;
use App\Http\Controllers\Operator\Baglog\BaglogLogic;
use App\Models\Mylea\FinishGood;
use App\Models\Mylea\MyleaContamination;
use App\Models\PostTreatment\PostTreatment;
use PostTreatmentDetails;
use Carbon\Carbon;

class MyleaController extends Controller
{   
    public function MyleaDashboard(){
        $date = Carbon::now();
        $date->toDateString();
        $Data = MyleaProduction::orderBy('ProductionDate', 'desc')->whereYear('ProductionDate', $date)->get();
        foreach($Data as $item){
            $item['TotalContamination'] = MyleaContamination::where('mylea_contamination.MyleaID',$item['id'])->get()->sum('Total');
            $item['TotalHarvest']= MyleaHarvest::where('mylea_harvest.MyleaID',$item['id'])->get()->sum('Total');
            $item['ProductionDate'] = substr($item['ProductionDate'], 5, 2);
        }

        $FinishGood = PostTreatment::select([
            'FinishGood'
        ])
        ->selectRaw('MONTH(StartDate) as date')
        ->orderBy('StartDate', 'desc')->whereYear('StartDate', $date)->get();

        return view('Operator.Mylea.Dashboard', [
            'Data' => $Data,
            'FinishGood' => $FinishGood,
        ]);
    }
    public function MyleaMonitoring(Request $request)
    {
        if($request['InitialDate'] !='' && $request['EndDate'] != ''){
            $Date1 = date('Y-m-d', strtotime($request['InitialDate']));
            $Date2 = date('Y-m-d', strtotime($request['EndDate']));
            $Data = MyleaProduction::orderBy('ProductionDate', 'desc')->whereBetween('ProductionDate', [$Date1, $Date2])->paginate(10);
        } else {
            $Data = MyleaProduction::orderBy('ProductionDate', 'desc')->paginate(10);
        }


        foreach ($Data as $data) {

            $data['TotalContamination'] = MyleaContamination::join('used_baglog', function ($join) {
                $join->on('mylea_contamination.MyleaID', '=', 'used_baglog.MyleaID')
                    ->on('mylea_contamination.BaglogID', '=', 'used_baglog.BaglogID');
            })
            ->where('mylea_contamination.MyleaID',$data['id'])
            ->sum('mylea_contamination.Total');

            $data['TotalHarvest'] = MyleaHarvest::join('used_baglog', function ($join) {
                $join->on('mylea_harvest.MyleaID', '=', 'used_baglog.MyleaID')
                    ->on('mylea_harvest.BaglogID', '=', 'used_baglog.BaglogID');
            })
            ->where('mylea_harvest.MyleaID',$data['id'])
            ->sum('mylea_harvest.Total');

            $data['UsedHarvest'] = MyleaHarvest::join('used_baglog', function ($join) {
                $join->on('mylea_harvest.MyleaID', '=', 'used_baglog.MyleaID')
                    ->on('mylea_harvest.BaglogID', '=', 'used_baglog.BaglogID');
            })
            ->where('mylea_harvest.MyleaID',$data['id'])
            ->join('post_treatment_details', 'mylea_harvest.id', '=', 'post_treatment_details.HarvestID')
            ->sum('post_treatment_details.Total');

            $data['RemainingHarvest'] = $data['TotalHarvest'] - $data['UsedHarvest'];

            $data['InStock'] = $data['TotalTray'] - ($data['TotalContamination'] + $data['TotalHarvest']);
        }

        $MyleaLogic = new MyleaLogic();
        $Data = $MyleaLogic->FilteredData($Data, $request);

        $TotalFinishGood = PostTreatment::all()->sum('FinishGood');


        return view('Operator.Mylea.Monitoring', [
            'Data' => $Data,
            'TotalFinishGood' => $TotalFinishGood
        ]);
    }

    public function MyleaProductionForm()
    {
        $BaglogInStock = new BaglogLogic;
        $BaglogInStock = $BaglogInStock->InStockBaglog();
        return view('Operator.Mylea.ProductionForm', ['BaglogData' => $BaglogInStock,]);
    }

    public function MyleaProductionSubmit(Request $request)
    {
        try {
            $date = date_create($request['ProductionDate']);
            $RawCode = "MYJT0".date_format($date, "ymd");

            $cm = array_column($request['data'], 'BaglogID');
            if($cm != array_unique($cm)){
                return redirect(route('MyleaProductionForm'))->with('Error', 'Message : ' . "Duplicate Substrate Bag Values");
            }

            $id = MyleaProduction::create([
                'MyleaCode' => $RawCode,
                'ProductionDate' => $request['ProductionDate'],
                'TotalTray' => $request['TotalTray'],
            ])->id;
    
            // $MyleaCode = new CommonLogic();
            // $MyleaCode = $MyleaCode->ManipCode($id, $RawCode);
    
            // MyleaProduction::where('id', $id)->update([
            //     'MyleaCode' => $MyleaCode,
            // ]);
    
            foreach($request['data'] as $item){
                UsedBaglog::create([
                    'BaglogID' => $item['BaglogID'],
                    'MyleaID' => $id,
                    'Total' => $item['Quantity'],
                ]);
            }
            return redirect(route('MyleaProductionForm'))->with('Success', 'Data submitted!');
        } catch (\Exception $e) {
            return redirect(route('MyleaProductionForm'))->with('Error', 'Message : ' . $e->getMessage());
        }
      
    }

    public function MyleaProductionDetails($id)
    {
        $MyleaProductionDetails = MyleaProduction::where('id', $id)->first();
        $UsedBaglog = UsedBaglog::where('MyleaID', $id)->get();

        $BaglogInStock = new BaglogLogic;
        $BaglogInStock = $BaglogInStock->InStockBaglog();

        return view('Operator.Mylea.UpdateProductionForm', [
            'BaglogData' => $BaglogInStock,
            'Data' => $MyleaProductionDetails,
            'DataBaglog'=> $UsedBaglog
        ]);
    }

    public function MyleaProductionUpdate(Request $request)
    {
        try {
            $date = date_create($request['ProductionDate']);
            $RawCode = "MYJT0".date_format($date, "ymd");

            $cm = array_column($request['data'], 'BaglogID');
            if($cm != array_unique($cm)){
                return redirect()->back()->with('Error', 'Message : ' . "Duplicate Substrate Bag Values");
            }

            MyleaProduction::where('id', $request['id'])->update([
                'MyleaCode' => $RawCode,
                'ProductionDate' => $request['ProductionDate'],
                'TotalTray' => $request['TotalTray'],
            ]);
    

            UsedBaglog::where('MyleaID', $request['id'])->delete();
    
            foreach($request['data'] as $item){
                UsedBaglog::create([
                    'BaglogID' => $item['BaglogID'],
                    'MyleaID' => $request['id'],
                    'Total' => $item['Quantity'],
                ]);
            }
            return redirect(route('MyleaProductionDetails', ['id'=>$request['id']]))->with('Success', 'Data submitted!');
        } catch (\Exception $e) {
            return redirect(route('MyleaProductionDetails', ['id'=>$request['id']]))->with('Error', 'Message : ' . $e->getMessage());
        }
      
    }

    public function MyleaContaminationForm($id)
    {
        $MyleaDetails = MyleaProduction::where('id', $id)->first();

        // $BaglogInStock = new BaglogLogic;
        // $BaglogInStock = $BaglogInStock->InStockBaglog();

        $BaglogUsed = new BaglogLogic;
        $BaglogUsed = $BaglogUsed->UsedBaglogPerMyleaCode($id);
        return view('Operator.Mylea.ContaminationForm', [
            // 'BaglogData' => $BaglogInStock,
            'MyleaDetails' => $MyleaDetails,
            'BaglogData2' => $BaglogUsed,
        ]);
    }

    public function MyleaContaminationSubmit(Request $request)
    {
        try {
            $request->validate([
                'ContaminationDate'=> 'Required',
            ]);
            
            foreach($request['data'] as $item){
                MyleaContamination::create([
                    'MyleaID' => $request['MyleaID'],
                    'BaglogID' => $item['BaglogID'],
                    'Total' => $item['Quantity'],
                    'Notes' => $item['Notes'],
                    'ContaminationDate' => $request['ContaminationDate'],
                ]);
            }

            return redirect(route('MyleaMonitoring'))->with('Success', 'Add Contamination Data Success!');
        } catch (\Exception $e) {
            return redirect(route('MyleaMonitoring'))->with('Error', 'Message : '. $e->getMessage());
        }
       
    }

    public function MyleaContaminationUpdate(Request $request)
    {
        try {
            $request->validate([
                'ContaminationDate'=> 'Required',
                'BaglogID'=> 'Required',
            ]);
            

            MyleaContamination::where('id', $request['id'])->update([
                'BaglogID'=> $request['BaglogID'],
                'ContaminationDate'=> $request['ContaminationDate'],
                'Notes'=> $request['Notes'],
                'Total'=> $request['Total']
            ]);

            return redirect(route('MyleaMonitoring'))->with('Success', 'Update Contamination Data Success!');
        } catch (\Exception $e) {
            return redirect(route('MyleaMonitoring'))->with('Error', 'Message : '. $e->getMessage());
        }
       
    }

    public function MyleaContaminationData($id)
    {
        $MyleaDetails = MyleaProduction::where('id', $id)->first();

        $MyleaContaminationData = MyleaContamination::select('mylea_contamination.*', 'baglog.BaglogCode')
        ->join('used_baglog', function ($join) {
            $join->on('mylea_contamination.MyleaID', '=', 'used_baglog.MyleaID')
                ->on('mylea_contamination.BaglogID', '=', 'used_baglog.BaglogID');
        })
        ->join('baglog', 'mylea_contamination.BaglogID', '=', 'baglog.id')
        ->where('mylea_contamination.MyleaID',$id)
        ->get();

        $UsedBaglogOption = UsedBaglog::join('baglog', 'baglog.id', '=', 'used_baglog.BaglogID')
        ->where('used_baglog.MyleaID', $id)
        ->get();


        return view('Operator.Mylea.ContaminationDetails', [
            'Data'=>$MyleaContaminationData,
            'Details'=>$MyleaDetails,
            'UsedBaglog'=> $UsedBaglogOption
            
        ]);
    }

    public function MyleaContaminationDelete($id, $details)
    {
        try {
            MyleaContamination::where('id', $id)->delete();
            return redirect(route('MyleaContaminationData', ['id'=>$details]))->with('Success', 'Data deleted!');
        } catch (\Exception $e) {
            return redirect(route('MyleaContaminationData', ['id'=>$details]))->with('Error', 'Message : '. $e->getMessage());
        }

    }

    public function MyleaHarvestForm($id)
    {
        $MyleaDetails = MyleaProduction::where('id', $id)->first();

        // $BaglogInStock = new BaglogLogic;
        // $BaglogInStock = $BaglogInStock->InStockBaglog();

        $BaglogUsed = new BaglogLogic;
        $BaglogUsed = $BaglogUsed->UsedBaglogPerMyleaCode($id);
        return view('Operator.Mylea.HarvestForm', [
            // 'BaglogData' => $BaglogInStock,
            'MyleaDetails' => $MyleaDetails,
            'BaglogData2' => $BaglogUsed,
        ]);
    }

    public function MyleaHarvestSubmit(Request $request)
    {
        try {
            $request->validate([
                'HarvestDate'=> 'Required',
            ]);
            
            foreach($request['data'] as $item){
              MyleaHarvest::create([
                    'MyleaID' => $request['MyleaID'],
                    'BaglogID' => $item['BaglogID'],
                    'Total' => $item['Quantity'],
                    'Notes' => $item['Notes'],
                    'HarvestDate' => $request['HarvestDate'],
                ]);
            }

            return redirect(route('MyleaMonitoring'))->with('Success', 'Add Harvest Data Success!');
        } catch (\Exception $e) {
            return redirect(route('MyleaMonitoring'))->with('Error', 'Message : '. $e->getMessage());
        }
       
    }

    public function MyleaHarvestUpdate(Request $request)
    {
        try {
            $request->validate([
                'HarvestDate'=> 'Required',
                'BaglogID'=> 'Required',
            ]);
            

            MyleaHarvest::where('id', $request['id'])->update([
                'BaglogID'=> $request['BaglogID'],
                'HarvestDate'=> $request['HarvestDate'],
                'Notes'=> $request['Notes'],
                'Total'=> $request['Total']
            ]);

            return redirect(route('MyleaMonitoring'))->with('Success', 'Update Harvest Data Success!');
        } catch (\Exception $e) {
            return redirect(route('MyleaMonitoring'))->with('Error', 'Message : '. $e->getMessage());
        }
       
    }

    public function MyleaHarvestData($id)
    {
        $MyleaDetails = MyleaProduction::where('id', $id)->first();

        $MyleaHarvestData = MyleaHarvest::select('mylea_harvest.*', 'baglog.BaglogCode')
        ->join('used_baglog', function ($join) {
            $join->on('mylea_harvest.MyleaID', '=', 'used_baglog.MyleaID')
                ->on('mylea_harvest.BaglogID', '=', 'used_baglog.BaglogID');
        })
        ->join('baglog', 'mylea_harvest.BaglogID', '=', 'baglog.id')
        ->where('mylea_harvest.MyleaID',$id)
        ->get();

        $UsedBaglogOption = UsedBaglog::join('baglog', 'baglog.id', '=', 'used_baglog.BaglogID')
        ->where('used_baglog.MyleaID', $id)
        ->get();

        return view('Operator.Mylea.HarvestDetails', [
            'Data'=>$MyleaHarvestData,
            'Details'=>$MyleaDetails,
            'UsedBaglog'=> $UsedBaglogOption,
        ]);
    }

    public function MyleaHarvestDelete($id, $details)
    {
        try {
            MyleaHarvest::where('id', $id)->delete();
            return redirect(route('MyleaHarvestData', ['id'=>$details]))->with('Success', 'Data deleted!');
        } catch (\Exception $e) {
            return redirect(route('MyleaHarvestData', ['id'=>$details]))->with('Error', 'Message : '. $e->getMessage());
        }

    }
}
