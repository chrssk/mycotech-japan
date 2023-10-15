<?php

namespace App\Models\PostTreatment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTreatment extends Model
{
    use HasFactory;
    protected $table = 'post_treatment';

    protected $fillable = [
        'StartDate',
        'Reject',
        'FinishGood',
        'Notes',
    ];

    public function details()
    {
        return $this->hasMany(PostTreatmentDetails::class, 'PostTreatmentID');
    }
}
