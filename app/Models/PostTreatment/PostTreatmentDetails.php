<?php

namespace App\Models\PostTreatment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTreatmentDetails extends Model
{
    use HasFactory;
    protected $table = 'post_treatment_details';

    protected $fillable = [
        'PostTreatmentID',
        'HarvestID',
        'Total',
    ];
}
