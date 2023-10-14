<?php

namespace App\Http\Controllers\Operator\PostTreatment;

use App\Http\Controllers\Controller;
use App\Models\Mylea\MyleaHarvest;
use App\Models\PostTreatment\PostTreatment;
use App\Models\PostTreatment\PostTreatmentDetails;
use Illuminate\Http\Request;

class PostTreatmentController extends Controller
{
    public function PostTreatmentForm (){
        // $MyleaHarvestData = MyleaHarvest::all();
        $MyleaHarvestData = MyleaHarvest::join('used_baglog', function ($join) {
            $join->on('mylea_harvest.MyleaID', '=', 'used_baglog.MyleaID')
                ->on('mylea_harvest.BaglogID', '=', 'used_baglog.BaglogID');
        })
        ->join('mylea_production', 'mylea_production.id', '=', 'mylea_harvest.MyleaID')
        ->select(
            'mylea_harvest.Total as TotalHarvest',
            'mylea_harvest.*', 
            'mylea_production.MyleaCode'
        )
        ->get();

        foreach($MyleaHarvestData as $data) {
            $data['UsedHarvest'] = PostTreatmentDetails::where('HarvestID', $data['id'])->sum('Total');
            $data['TotalHarvest'] =  $data['TotalHarvest'] - $data['UsedHarvest'] ;
        }



        return view('Operator.PostTreatment.PostTreatmentForm', [
            'Data' => $MyleaHarvestData,
        ]);
    }

    public function PostTreatmentSubmit(Request $request)
    {
        try {

            $id = PostTreatment::create([
                'StartDate' => $request['StartDate'],
            ])->id;
    
    
            foreach($request['data'] as $item){
                PostTreatmentDetails::create([
                    'PostTreatmentID' => $id,
                    'HarvestID' => $item['HarvestID'],
                    'Total' => $item['Total'],
                ]);
            }
            return redirect(route('PostTreatmentForm'))->with('Success', 'Data submitted!');
        } catch (\Exception $e) {

            PostTreatment::where('id', $id)->delete();

            return redirect(route('PostTreatmentForm'))->with('Error', 'Message : ' . $e->getMessage());
        }
      
    }
}
