<?php

namespace App\Models\Mylea;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mylea\FinishGood;
use App\Models\PostTreatment\PostTreatmentDetails;


class MyleaHarvest extends Model
{
    use HasFactory;
    protected $table = 'mylea_harvest';

    protected $fillable = [
        'MyleaID',
        'BaglogID',
        'HarvestDate',   
        'Total', 
        'Notes', 
    ];

    public function postTreatmenUsage()
    {
        return $this->hasMany(PostTreatmentDetails::class, 'HarvestID');
    }

}
