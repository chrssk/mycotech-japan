<?php

namespace App\Models\Mylea;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyleaContamination extends Model
{
    use HasFactory;
    protected $table = 'mylea_contamination';

    protected $fillable = [
        'MyleaID',
        'BaglogID',
        'ContaminationDate',   
        'Notes', 
        'Total', 
    ];
}
