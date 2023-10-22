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

class MyleaLogic
{
    public function FilteredData($data, $request){
        if($request['TotalTrayNumber'] != ''){
            $data = $data->where('TotalTray', $request['TotalTrayOperator'], $request['TotalTrayNumber']);
        }
        if($request['UnderIncubationNumber'] != ''){
            $data = $data->where('InStock', $request['UnderIncubationOperator'], $request['UnderIncubationNumber']);
        }
        if($request['ContaminationNumber'] != ''){
            $data = $data->where('TotalContamination', $request['ContaminationOperator'], $request['ContaminationNumber']);
        }
        if($request['HarvestNumber'] != ''){
            $data = $data->where('TotalHarvest', $request['HarvestOperator'], $request['HarvestNumber']);
        }
        if($request['RemainingHarvestNumber'] != ''){
            $data = $data->where('RemainingHarvest', $request['RemainingHarvestOperator'], $request['RemainingHarvestNumber']);
        }

        return $data;
    }
}
?>