<?php

namespace App\Models\PostTreatment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use MyleaHarvest;

class PostTreatmentDetails extends Model
{
    use HasFactory;
    protected $table = 'post_treatment_details';

    protected $fillable = [
        'PostTreatmentID',
        'HarvestID',
        'Total',
    ];

    public function postTreatment()
    {
        return $this->belongsTo(PostTreatmentDetails::class);
    }

    public function harvest()
    {
        return $this->belongsTo(MyleaHarvest::class);
    }
}
